<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rfq;
use App\Models\Country;
use App\Models\BuyingRequestStatus;
use App\Exports\BuyingRequestInvoicesExport;
use App\Imports\BuyingRequestInvoicesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\MailerTrait;

class RfqsController extends Controller
{   
    // so we can send emails useing PHPMailer
    use MailerTrait; 

    public function index() {
        $countries = Country::all();
        $buying_request_statuses = BuyingRequestStatus::all();
        return view('admin.rfqs.buying_requets.index', compact(['countries','buying_request_statuses'])); 
    }

    public function getRfqsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $buying_request_status = $request->buying_request_status;

        $buying_request_obj = new Rfq();

        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj->limit($rows_numbers)
            ->with('category')->with('country')->with('buyer')->with('unit')->orderBy('id','desc')->get();

        
        return response()->json([
            'buying_requests' => $buying_requests,
            'buying_requests_count' => $buying_requests_count
        ]); 
    }

    public function filterRfqs(Request $request){

        
        $product_name = $request->product_name;
        $shipping_country = $request->shipping_country;
        $rows_numbers = $request->rows_numbers; 
        $request_type = $request->request_type;
        $buying_request_status = $request->buying_request_status;
        
        $buying_request_obj =  Rfq::where('deleted_at',null);

        if($buying_request_status == 'pending'){
            $buying_request_obj = $buying_request_obj->where('status', 1);
        }
        elseif($buying_request_status == 'approvel'){    
            $buying_request_obj = $buying_request_obj->where('status',2);
        }
        elseif($buying_request_status == 'completed'){
            $buying_request_obj = $buying_request_obj->where('status',3);
        }
        elseif($buying_request_status == 'lost'){
            $buying_request_obj = $buying_request_obj->where('status',4);
        }
        elseif($buying_request_status == 'canceled'){
            $buying_request_obj = $buying_request_obj->where('status',5);
        }
        
        
        if($product_name){
            $buying_request_obj->where('product_name','like', '%' . $product_name . '%');
        }

        if($request_type == 'global'){
            $buying_request_obj->where('item_id', 0)->where('status','>', 0);
        }
        elseif($request_type == 'normal'){
            $buying_request_obj->where('item_id','>', 0);
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
        // to approve selected
        if($request->has('approve_selected_btn')){
            foreach($request->rfqs_id as $request_id){
                $rfq = Rfq::find($request_id);
                $rfq->status = 2;
                $rfq->save();
                $message = 'buying requests hass been approved successfully';
                
                // to send email to user 
                $buyer_name = $rfq->buyer->full_name;
                $buyer_email = $rfq->buyer->email;
                $subject = '';
                $message = '';
                $this->composeEmail();

                session()->flash('success', 'true');
                session()->flash('feedback_title', 'Success');
                session()->flash('feedback', $message);
                return redirect()->back();
            }
        }
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
