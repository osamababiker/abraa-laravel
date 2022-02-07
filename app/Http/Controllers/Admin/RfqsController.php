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
use App\Models\BuyingFrequency;
use App\Models\Unit;
use App\Exports\RfqsExport;
use App\Imports\RfqsImport;
use App\Http\Requests\BuyingRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\MailerTrait;
use App\Http\Traits\ClearCacheTrait; 
use Illuminate\Pagination\Paginator;

class RfqsController extends Controller
{   
    use MailerTrait, ClearCacheTrait; 

    public function index() {
        $countries = Country::all();
        return view('admin.rfqs.buying_requets.index', compact(['countries'])); 
    }

    // to get pending rfq as json
    public function getRfqsAsJson(Request $request){
 
        $rows_numbers = $request->rows_numbers;
        $buying_request_status = $request->buying_request_status; 

        $buying_request_obj = Rfq::where('status', 1);

        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj->with('category')->with('country')->with('buyer')->with('unit')
            ->orderBy('id','desc')->paginate($rows_numbers);

        return response()->json([
            'buying_requests' => $buying_requests,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
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
        
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $buying_request_obj =  Rfq::where('status', 1);        
        
        if($product_name){
            $buying_request_obj->where('product_name','like', '%' . $product_name . '%');
        }


        if($shipping_country){
            $buying_request_obj->whereIn('country_code', $shipping_country);
        }

            
        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj->with('category')
            ->with('country')->with('buyer')
            ->with('unit')->orderBy('id','desc')->paginate($rows_numbers);

   
        return response()->json([
            'buying_requests' => $buying_requests,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
            'buying_requests_count' => $buying_requests_count
        ]);
    }

    // to get products & buyers for create page
    public function getBuyerProductDetails(Request $request){
        if($request->is_buyer){
            $results = Buyer::whereIn('member_type',[2,3])
            ->where('user_type',0)
            ->where('full_name', 'like', '%'. $request->term . '%')->get();
            $i = 0;
            foreach ($results as $r) {
                $buyers[$i]['id'] = $r['id'];
                $buyers[$i]['value'] = str_replace("&#39;s", " ", html_entity_decode($r['full_name']));
                $buyers[$i]['label'] = str_replace("&#39;s", " ", html_entity_decode($r['full_name']));
                $i++;
            }
            echo json_encode($buyers);
        }else 
        if($request->is_product){
            $results = Item::where('title', 'like', '%'. $request->term . '%')
            ->get();
            $i = 0;
            foreach ($results as $r) {
                $products[$i]['id'] = $r['id'];
                $products[$i]['value'] = str_replace("&#39;s", " ", html_entity_decode($r['title']));
                $products[$i]['label'] = str_replace("&#39;s", " ", html_entity_decode($r['title']));
                $i++;
            }
            echo json_encode($products);
        }
    }

    public function create(){
        $units = Unit::all();
        $buying_frequencies = BuyingFrequency::all();
        return view('admin.rfqs.buying_requets.create', compact(['units','buying_frequencies']));
    }

    public function store(BuyingRequest $request){
        $rfq = new Rfq();
        $hash = md5(time() . rand(10000, 99999));
        $date_added = date('Y-m-d H:i:s');
        $added_by = Auth::user()->id;

        $rfq->buyer_id = $request->buyer_id;
        $rfq->item_id = $request->item_id;
        $rfq->product_name = $request->product_name;
        $rfq->product_detail = $request->product_detail;
        $rfq->quantity = $request->quantity;
        $rfq->unit_id = $request->unit_id;
        $rfq->buying_frequency_id = $request->buying_frequency_id;
        $rfq->reference_url = $request->reference_url;
        $rfq->target_price = $request->target_price;
        $rfq->validity = $request->validity;
        $rfq->hash = $hash;
        $rfq->date_added = $date_added;
        $rfq->added_by = $added_by;
        $rfq->country_code = 0;
        $rfq->save();

        $message = "Buying Request Has Been Added Successfully";
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Successfully Added');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function show($id){
        $rfq = Rfq::findOrFail($id);
        return view('admin.rfqs.buying_requets.show', compact(['rfq']));
    }

 
    public function edit($id){
        $rfq = Rfq::findOrFail($id);
        $units = Unit::all();
        $buying_frequencies = BuyingFrequency::all();
        return view('admin.rfqs.buying_requets.edit', compact(['rfq','units','buying_frequencies']));
    }


    public function update(BuyingRequest $request){
        $rfq = Rfq::find($request->rfq_id);
        $date_updated = date('Y-m-d H:i:s');
        $updated_by = Auth::user()->id;

        $rfq->buyer_id = $request->buyer_id;
        $rfq->item_id = $request->item_id;
        $rfq->product_name = $request->product_name;
        $rfq->product_detail = $request->product_detail;
        $rfq->quantity = $request->quantity;
        $rfq->unit_id = $request->unit_id;
        $rfq->buying_frequency_id = $request->buying_frequency_id;
        $rfq->reference_url = $request->reference_url;
        $rfq->target_price = $request->target_price;
        $rfq->validity = $request->validity;
        $rfq->date_updated = $date_updated;
        $rfq->updated_by = $updated_by;
        $rfq->save();

        $message = "Buying Request Has Been Updated Successfully";
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Successfully Updated');
        session()->flash('feedback', $message);
        return redirect()->back();
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
    public function exportExcel() {
        return Excel::download(new RfqsExport, 'stores.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new RfqsImport,request()->file('file'));
           
        return redirect()->back();
    }

    // Rfq actions ('delete(Archive) selected , approve selected')
    public function actions(Request $request){
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
            }

             // to clear the cache on abraa
             $this->clearAbraaCache("buying_requests");

             $message = 'buying requests hass been approved successfully';
             session()->flash('success', 'true');
             session()->flash('feedback_title', 'Success'); 
             session()->flash('feedback', $message);
             return redirect()->back();
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
        if($request->is_category){
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
        if($request->is_product){
            $results = Item::where('title', 'like', '%'. $request->term . '%')
            ->get();
            $i = 0;
            foreach ($results as $r) {
                $products[$i]['id'] = $r['id'];
                $products[$i]['value'] = str_replace("&#39;s", " ", html_entity_decode($r['title']));
                $products[$i]['label'] = str_replace("&#39;s", " ", html_entity_decode($r['title']));
                $i++;
            }
            echo json_encode($products);
        }
    } 

    // to approve single rfq
    public function approve(Request $request){
        // to update rfq info
        $rfq = Rfq::find($request->rfq_id);
        $rfq->status = 2;
        $rfq->product_name = $request->rfq_name;
        $rfq->product_detail = $request->rfq_details;
        $rfq->category_id = $request->category_id;
        $rfq->item_id = $request->product_id;
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

        // to clear the cache on abraa
        $this->clearAbraaCache("buying_requests");

        $message = 'buying requests hass been approved successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
        
    }


    // to approve product rfq
    public function approve_product(Request $request){
        $rfq = Rfq::find($request->rfq_id);
        $rfq->status = 2;
        $rfq->save();

        // to send email to buyer 
        $buyer_name = $rfq->buyer->full_name;
        $buyer_email = $rfq->buyer->email;
        $product_name = $rfq->product_name;
        $product_link = config('global.public_url') . 'new-dashboard-buyer/buying-requests/' . $rfq->id;
        $subject = AdminEmail::find(25)->subject;
        $email_content = $this->getApproveRfqMessage($buyer_name, $product_name, $product_link);
        $email_templete = $this->getEmailTemplete($email_content);
        $this->sendEmail($email_templete, $buyer_email, $subject);

        // to clear the cache on abraa
        $this->clearAbraaCache("buying_requests");

        $message = 'buying requests hass been approved successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return response()->json([
            'message' => $message
        ], 200);
    }
}
