<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rfq;
use App\Models\RfqFile;
use App\Models\Buyer;
use App\Models\Country;
use App\Models\AdminEmail;
use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\BuyingRequestStatus; 
use App\Exports\RfqsExport;
use App\Imports\RfqsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\MailerTrait; 
use Illuminate\Pagination\Paginator;

class ProductRfqsController extends Controller
{   
    // so we can send emails useing PHPMailer
    use MailerTrait; 

    public function index() {
        $countries = Country::all();
        return view('admin.rfqs.product_buying_requets.index', compact(['countries'])); 
    }


    // to get product rfq as json
    public function getProductRfqsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $buying_request_status = $request->buying_request_status;

        $buying_request_obj = Rfq::where('item_id','<>', 0)->where('status','>', 1);

        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj->with('category')->with('country')->with('buyer')->with('unit')
        ->orderBy('id','desc')->paginate($rows_numbers);
        
        $site_url = config('global.public_url');
        
        return response()->json([
            'buying_requests' => $buying_requests,
            'buying_requests_count' => $buying_requests_count,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
            'site_url' => $site_url
        ]); 
    }


    // to filter Product rfq
    public function filterProductRfqs(Request $request){

        $product_name = $request->product_name;
        $shipping_country = $request->shipping_country;
        $rows_numbers = $request->rows_numbers; 
        $request_type = $request->request_type;
        $buying_request_status = $request->buying_request_status;
        
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $buying_request_obj =  Rfq::where('item_id','<>', 0)->where('status','>', 1);        
        
        if($product_name){
            $buying_request_obj->where('product_name','like', '%' . $product_name . '%');
        }

        if($shipping_country){
            $buying_request_obj->whereIn('country_code', $shipping_country);
        }

        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj
            ->with('category')->with('country')->with('buyer')
            ->with('unit')->orderBy('id','desc')->paginate($rows_numbers);

        $site_url = config('global.public_url');
   
        return response()->json([
            'buying_requests' => $buying_requests,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
            'buying_requests_count' => $buying_requests_count,
            'site_url' => $site_url
        ]);
    }
   

    // to send rfq to suppliers 
    public function sendToSupploersPage($id){
        $rfq = Rfq::find($id);
        $countries = Country::all();
        return view('admin.rfqs.global_buying_requets.sendToSuppliers', compact(['rfq','countries']));
    }

    public function filterSuppliers(Request $request){
        
        $supplier_name = $request->supplier_name;
        $product_search = $request->product_search;
        $countries = $request->countries;
        $keywords = $request->keywords;

        $suppliers_obj = Supplier::whereIn('member_type',[1,3])
            ->where('user_type',0)->with('supplier_country')
            ->with('store'); 
        
        if($supplier_name){
            $suppliers_obj->where('full_name', 'like', '%'. $supplier_name . '%');
        }

        if($countries){
            $suppliers_obj->whereIn('country', $countries);
        }

        if($keywords){
            $suppliers_obj->where('interested_keywords', 'like', '%'. $keywords[0] .'%');
            for($i = 1; $i < count($keywords); $i++) {
               $suppliers_obj->orWhere('interested_keywords', 'like', '%'. $keywords[$i] .'%');      
            }
        }

        if($product_search){
            $suppliers_obj->leftJoin('items', function($join) {
                $join->on('users.id', '=', 'items.user_id');
                })
                ->where('items.title', 'like', '%'. $product_search .'%')
                ->orWhere('items.meta_keyword', 'like', '%'. $product_search .'%');
        }

        $suppliers = $suppliers_obj->get();

        return response()->json([
            'suppliers' => $suppliers,
        ]);

    }

    public function sendToSupploers(Request $request){

        $rfq = Rfq::find($request->rfq_id);
        $supplier_email = $request->supplier_email;
        $strmImages = "";
        $buying_request_images = RfqFile::where('sub_of', $request->rfq_id)->get();
        if (count($buying_request_images) > 0) {
            foreach ($buying_request_images as $buyimages) {
                if (exif_imagetype('../' . $buyimages['file_path'])) {
                    $strmImages .= '<img style="width: 220px; height: 220px; float: left" src="https://www.abraa.com/' . $buyimages['file_path'] . '" />';
                }

            }
        }

        foreach($supplier_email as $email){
            $supplier = Supplier::where('email',$email)->first();
            $email_content = $this->buy_request_email_format($supplier, $rfq, $strmImages);
            $email_templete = $this->getEmailTemplete($email_content);
            $subject = $rfq->product_name;
            $this->sendEmail($email_templete, $supplier->email, $subject);
        }
 
        $message = 'Message has been send successfuly';
        session()->flash('feedback',$message);
        return redirect()->back();
        
    }


    // to get suppliers details to approve
    public function getSuppliersDetails(Request $request){
        
        if($request->has('is_product')){
            $results = Item::where('title', 'like', '%'. $request->term . '%')
                ->orWhere('meta_keyword', 'like', '%'. $request->term . '%')->get();
            $i = 0;
            foreach ($results as $r) {
                $items[$i]['id'] = $r['id'];
                $items[$i]['value'] = str_replace("&#39;s", " ", html_entity_decode($r['title']));
                $items[$i]['label'] = str_replace("&#39;s", " ", html_entity_decode($r['title']));
                $i++;
            }
            echo json_encode($items);
        }
        
    }

    public function create()
    {
        //
    }

  
    public function buying_request(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

 
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id){
        Rfq::where('id',$id)->delete();
        $message = 'Request hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new RfqsExport, 'buying_requests.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new RfqsImport,request()->file('file'));
           
        return redirect()->back();
    }

    // Rfq actions ('delete(Archive) selected , approve selected')
    public function actions(Request $request)
    {
        // to delete (archived) selected
        if($request->has('delete_selected_btn')){
            foreach($request->rfqs_id as $request_id){
                $rfq = Rfq::find($request_id);
                $rfq->delete();
                $message = 'buying requests hass been deleted successfully';
                session()->flash('success', 'true');
                session()->flash('feedback_title', 'Success');
                session()->flash('feedback', $message);
                return redirect()->back();
            }
        }
    }


}
