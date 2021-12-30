<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rfq;
use App\Models\Buyer;
use App\Models\Country;
use App\Models\AdminEmail;
use App\Models\Item;
use App\Models\Category;
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
        return view('admin.rfqs.buying_requets.index', compact(['countries'])); 
    }

    // to get pending rfq as json
    public function getRfqsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $buying_request_status = $request->buying_request_status;

        $buying_request_obj = Rfq::where('item_id', '<>', 0)->where('status', 1);

        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj->limit($rows_numbers)
            ->with('category')->with('country')->with('buyer')->with('unit')->orderBy('id','desc')->get();

        return response()->json([
            'buying_requests' => $buying_requests,
            'buying_requests_count' => $buying_requests_count
        ]); 
    }

    // to filter pending rfq
    public function filterRfqs(Request $request){

        $product_name = $request->product_name;
        $shipping_country = $request->shipping_country;
        $rows_numbers = $request->rows_numbers; 
        $request_type = $request->request_type;
        $buying_request_status = $request->buying_request_status;
        
        $buying_request_obj =  Rfq::where('item_id','<>', 0)->where('status', 1);        
        
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
                $rfq->approved_by = Auth::user()->id;
                $rfq->save();

                // to send email to user 
                $buyer_name = $rfq->buyer->full_name;
                $buyer_email = $rfq->buyer->email;
                $product_name = $rfq->product_name;
                $product_link = config('global.public_url') . 'new-dashboard-buyer/buying-requests/' . $rfq->id;
                $subject = AdminEmail::find(25)->subject;
                $email_content = $this->getApproveRfqMessage($buyer_name, $product_name, $product_link);
                $email_templete = $this->getEmailTemplete($email_content);
                $this->sendEmail($email_templete, $buyer_email, $subject);
                

                $message = 'buying requests hass been approved successfully';
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

    // to get suppliers details to approve
    public function getSuppliersDetails(Request $request){
        $results = Category::where('en_title', 'like', '%'. $request->term . '%')
            ->orWhere('ar_title', 'like', '%'. $request->term . '%')
            ->orWhere('ar_title', 'like', '%'. $request->term . '%')
            ->orWhere('cn_title', 'like', '%'. $request->term . '%')
            ->orWhere('ru_title', 'like', '%'. $request->term . '%')
            ->orWhere('tr_title', 'like', '%'. $request->term . '%')
            ->orWhere('pr_title', 'like', '%'. $request->term . '%')->get();
        $i = 0;
        foreach ($results as $r) {
            $categories[$i]['id'] = $r['id'];
            $categories[$i]['value'] = str_replace("&#39;s", " ", html_entity_decode($r['en_title']));
            $categories[$i]['label'] = str_replace("&#39;s", " ", html_entity_decode($r['en_title']));
            $i++;
        }
        echo json_encode($categories);
    }

    // to approve single rfq
    public function approve(Request $request){

        // to update rfq info
        $rfq = Rfq::find($request->rfq_id);
        $rfq->status = 2;
        $rfq->product_name = $request->rfq_name;
        $rfq->product_detail = $request->rfq_details;
        $rfq->category_id = $request->category_id;
        $rfq->save();

        // to update buyer info
        $buyer = Buyer::find($request->buyer_id);
        $buyer->full_name = $request->buyer_name;
        $buyer->phone = $request->buyer_phone;
        $buyer_keywords = '';
        foreach($request->buyer_keywords as $keyword){
            $buyer_keywords .= $keyword . ',' ;
        }
        $buyer->interested_keywords = $buyer_keywords;
        $buyer->save();

        // to send email to buyer 
        $buyer_name = $rfq->buyer->full_name;
        $buyer_email = $rfq->buyer->email;
        $product_name = $rfq->product_name;
        $product_link = config('global.public_url') . 'new-dashboard-buyer/buying-requests/' . $rfq->id;
        $subject = AdminEmail::find(25)->subject;
        $email_content = $this->getApproveRfqMessage($buyer_name, $product_name, $product_link);
        $email_templete = $this->getEmailTemplete($email_content);
        $this->sendEmail($email_templete, $buyer_email, $subject);

        $message = 'buying requests hass been approved successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
        
    }
}
