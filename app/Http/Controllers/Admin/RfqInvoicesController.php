<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RfqInvoice;
use App\Models\Country;
use App\Exports\RfqsInvoiceExport;
use App\Imports\RfqsInvoiceImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class RfqInvoicesController extends Controller
{

    public function index() {
        $countries = Country::all();
        return view('admin.rfqs.invoices.index', compact(['countries'])); 
    }

    public function getRfqInvoicesAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $buying_request_obj = new RfqInvoice();
      
        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj->with('buying_request')->with('supplier')->with('unit')
        ->orderBy('id','desc')->paginate($rows_numbers);

        return response()->json([
            'buying_requests' => $buying_requests,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
            'buying_requests_count' => $buying_requests_count
        ]); 
    }

    public function filterRfqInvoices(Request $request){
        $product_name = $request->product_name;
        $shipping_country = $request->shipping_country;
        $rows_numbers = $request->rows_numbers; 
        $request_type = $request->request_type;
        $buying_request_status = $request->buying_request_status;
        
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $buying_request_obj =  RfqInvoice::leftJoin('buying_requests', 'buying_requests.id', 'buying_request_invoices.buying_request_id');

        if($buying_request_status == 'approvel'){    
            $buying_request_obj = $buying_request_obj->where('buying_requests.status',2);
        }
        elseif($buying_request_status == 'completed'){
            $buying_request_obj = $buying_request_obj->where('buying_requests.status',3);
        }
        elseif($buying_request_status == 'canceled'){
            $buying_request_obj = $buying_request_obj->where('buying_requests.status',5);
        }
        elseif($buying_request_status == 'pending'){
            $buying_request_obj = $buying_request_obj
                ->where('buying_request_invoices.approved', '<>', 1);
        }
        
        if($product_name){
            $buying_request_obj->where('buying_requests.product_name','like', '%' . $product_name . '%');
        }

        if($request_type == 'global'){
            $buying_request_obj->where('buying_requests.item_id', 0);
        }

        if($shipping_country){
            $buying_request_obj->whereIn('buying_requests.country_code', $shipping_country);
        }

    
            
        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj
            ->with('buying_request')->with('supplier')
            ->with('unit')->orderBy('buying_request_invoices.id','desc')->paginate($rows_numbers);

   
        return response()->json([
            'buying_requests' => $buying_requests,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
            'buying_requests_count' => $buying_requests_count
        ]);
    }



    public function create(){
        //
    }


    public function show($id){
        //
    }

 
    public function edit($id){
        //
    }


    public function update(Request $request, $id){
        //
    }


    public function destroy($id){
        BuyingRequestInvoice::where('id',$id)->delete();
        $message = 'Buying request hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() {
        return Excel::download(new RfqsInvoiceExport, 'stores.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new RfqsInvoiceImport,request()->file('file'));
        return redirect()->back();
    }

     // Rfq Invoices actions
     public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->rfqs_id as $request_id){
                $rfq = BuyingRequestInvoice::find($request_id);
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
