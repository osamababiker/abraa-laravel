<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbandonedRfq;
use App\Models\Country;
use App\Exports\AbandonedRfqsExport;
use App\Imports\AbandonedRfqsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class AbandonedRfqsController extends Controller
{

    public function index(){
        $countries = Country::all();
        return view('admin.rfqs.abandoned_buying_requets.index', compact(['countries'])); 
    }

    // to get abandoned rfqs as json
    public function getAbandonedRfqsAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;

        $buying_request_obj = new AbandonedRfq();
        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj->with('buyer')->with('item')->with('unit')
        ->orderBy('id','desc')->paginate($rows_numbers);

        return response()->json([
            'buying_requests' => $buying_requests,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
            'buying_requests_count' => $buying_requests_count
        ]); 
    }

    // to filter abandoned rfqs 
    public function filterAbandonedRfqs(Request $request){

        $product_name = $request->product_name;
        $countries = $request->countries;
        $rows_numbers = $request->rows_numbers; 
        
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $buying_request_obj =  AbandonedRfq::leftJoin('abandoned_registerations', 'abandoned_registerations.id', 'abandoned_rfq.buyer_id');

        if($product_name){
            $buying_request_obj->where('abandoned_rfq.product_name','like', '%' . $product_name . '%');
        }

        if($countries){
            $buying_request_obj->whereIn('abandoned_registerations.country', $countries);
        }

        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj
            ->with('buyer')->with('item')
            ->with('unit')->orderBy('abandoned_rfq.id','desc')->paginate($rows_numbers);

        return response()->json([
            'buying_requests' => $buying_requests,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
            'buying_requests_count' => $buying_requests_count
        ]);
    }


    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        $rfq = AbandonedRfq::findOrFail($id);
        return view('admin.rfqs.abandoned_buying_requets.show', compact(['rfq']));
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    // Abandoned Rfq actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->rfqs_id as $request_id){
                $rfq = AbandonedRfq::find($request_id);
                $rfq->delete();
                $message = 'buying requests hass been deleted successfully';
                session()->flash('success', 'true');
                session()->flash('feedback_title', 'Success');
                session()->flash('feedback', $message);
                return redirect()->back();
            }
        }
    }

    public function destroy($id){
        AbandonedRfq::where('id',$id)->delete();
        $message = 'abandoned Buying request hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() {
        return Excel::download(new AbandonedRfqsExport, 'abandoned_rfqs.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new AbandonedRfqsImport,request()->file('file'));
        return redirect()->back();
    }
}
