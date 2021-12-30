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
use App\Exports\BuyingRequestInvoicesExport;
use App\Imports\BuyingRequestInvoicesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\MailerTrait;

class GlobalRfqsController extends Controller
{   
    // so we can send emails useing PHPMailer
    use MailerTrait; 

    public function index() {
        $countries = Country::all();
        return view('admin.rfqs.global_buying_requets.index', compact(['countries'])); 
    }


    // to get global rfq as json
    public function getGlobalRfqsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $buying_request_status = $request->buying_request_status;

        $buying_request_obj = Rfq::where('item_id', 0)->where('status','>', 1);

        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj->limit($rows_numbers)
            ->with('category')->with('country')->with('buyer')->with('unit')->orderBy('id','desc')->get();

        
        return response()->json([
            'buying_requests' => $buying_requests,
            'buying_requests_count' => $buying_requests_count
        ]); 
    }


    // to filter Global rfq
    public function filterGlobalRfqs(Request $request){

        $product_name = $request->product_name;
        $shipping_country = $request->shipping_country;
        $rows_numbers = $request->rows_numbers; 
        $request_type = $request->request_type;
        $buying_request_status = $request->buying_request_status;
        
        $buying_request_obj =  Rfq::where('item_id', 0)->where('status','>', 1);        
        
        if($product_name){
            $buying_request_obj->where('product_name','like', '%' . $product_name . '%');
        }

        if($shipping_country){
            $buying_request_obj->whereIn('country_code', $shipping_country);
        }

        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj->limit($rows_numbers)
            ->with('category')->with('country')->with('buyer')
            ->with('unit')->orderBy('id','desc')->get();
   
        return response()->json([
            'buying_requests' => $buying_requests,
            'buying_requests_count' => $buying_requests_count
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
        $products = $request->products;
        $categories = $request->categories;
        $countries = $request->countries;
        $keywords = $request->keywords;

        $suppliers_obj = Supplier::with('supplier_country')
            ->leftJoin('items', 'users.id', '=', 'items.user_id')
            ->leftJoin('users_store', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0); 
        
        if($supplier_name){
            $suppliers_obj->where('users.full_name', 'like', '%'. $supplier_name . '%');
        }

        if($countries){
            $suppliers_obj->whereIn('users.country', $countries);
        }

        if($keywords){
            $suppliers_obj->where('users.interested_keywords', 'like', '%'. $keywords[0] .'%');
            for($i = 1; $i < count($keywords); $i++) {
               $suppliers_obj->orWhere('users.interested_keywords', 'like', '%'. $keywords[$i] .'%');      
            }
        }

        if($products){
            $suppliers_obj->where('items.meta_keyword', 'like', '%'. $products[0] .'%')
                ->orWhere('items.title', 'like', '%'. $products[0] .'%');
            for($i = 1; $i < count($products); $i++) {
               $suppliers_obj->orWhere('items.meta_keyword', 'like', '%'. $products[$i] .'%')
                    ->orWhere('items.title', 'like', '%'. $products[$i] . '%');      
            }
        }

        $suppliers = $suppliers_obj->orderBy('users.id','desc')->get();
   
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

        return redirect()->back();

        //send Email to omar first
        $omarQuote = array(
            'supplier_id' => '50920',
            'supplier_name' => 'Omar Al Hamra',
            'supplier_email' => 'omar@abraa.com'
        );
        //send Email to mohammad
        $mhdQuote = array(
            'supplier_id' => '99',
            'supplier_name' => 'Mohammad Al Hamra',
            'supplier_email' => 'sales@webselectronics.com'
        );


        
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
        BuyingRequestInvoice::where('id',$id)->delete();
        $message = 'Request hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new BuyingRequestInvoicesExport, 'stores.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new BuyingRequestInvoicesImport,request()->file('file'));
           
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
