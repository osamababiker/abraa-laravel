<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rfq;
use App\Models\Country;
use App\Exports\ClosedRfqsExport;
use App\Imports\ClosedRfqsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class ClosedRfqsController extends Controller
{

    public function index(){
        $countries = Country::all();
        return view('admin.rfqs.closed_buying_requets.index', compact(['countries'])); 
    } 

    // to get closed rfqs as json
    public function getClosedRfqsAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;

        $buying_request_obj = Rfq::where('status', '>', 2);
        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj
        ->with('category')->with('country')->with('buyer')
        ->with('approved_by_admin')->with('item')
        ->orderBy('id','desc')->paginate($rows_numbers);

        return response()->json([
            'buying_requests' => $buying_requests,
            'pagination' => (string) $buying_requests->links('pagination::bootstrap-4'),
            'buying_requests_count' => $buying_requests_count
        ]); 
    }

    // to filter closed rfqs 
    public function filterClosedRfqs(Request $request){
        $product_name = $request->product_name;
        $buyer_name = $request->buyer_name;
        $countries = $request->countries;
        $rows_numbers = $request->rows_numbers; 
        
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $buying_request_obj =  Rfq::where('status', '>', 2)
        ->select('buying_requests.*')
        ->leftJoin('users', function($join){
            $join->on('users.id', '=', 'buying_requests.buyer_id');
        });

        if($product_name){
            $buying_request_obj->where('buying_requests.product_name','like', '%' . $product_name . '%');
        }

        if($buyer_name){
            $buying_request_obj->where('users.full_name', 'like', '%'. $buyer_name . '%');
        }

        if($countries){
            $buying_request_obj->whereIn('buying_requests.country_code', $countries)
                ->orWhereIn('users.country', $countries);
        }

        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj
            ->with('category')->with('country')->with('buyer')
            ->with('approved_by_admin')->with('item')
            ->orderBy('buying_requests.id','desc')->paginate($rows_numbers);

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
        $rfq = Rfq::findOrFail($id);
        return view('admin.rfqs.closed_buying_requets.show', compact(['rfq']));
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

    public function destroy($id){
        Rfq::where('id',$id)->delete();
        $message = 'abandoned Buying request hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() {
        return Excel::download(new ClosedRfqsExport, 'abandoned_rfqs.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new ClosedRfqsImport,request()->file('file'));
        return redirect()->back();
    }
}
