<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipper;
use App\Models\Country;
use App\Exports\ShippersExport;
use App\Imports\ShippersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;


class ShippersController extends Controller
{
    
    public function index(){
        $countries = Country::all();
        return view('admin.shippers.index', compact(['countries']));
    }

    // to get shippers as json
    public function getShippersAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $shipper_obj = Shipper::where('member_type',4)
            ->where('user_type',0);

        $shippers_count = $shipper_obj->count();
        $shippers = $shipper_obj->with('shipper_country')
            ->orderBy('id','desc')->paginate($rows_numbers);

        return response()->json([
            'shippers' => $shippers,
            'pagination' => (string) $shippers->links('pagination::bootstrap-4'),
            'shippers_count' => $shippers_count
        ]);
    }

    // to filter shippers
    public function filterShippers(Request $request){
        $shipper_name = $request->shipper_name;
        $countries = $request->countries;
        $rows_numbers = $request->rows_numbers; 

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $shipper_obj = Shipper::where('member_type',4)
            ->where('user_type',0);

        if($shipper_name){
            $shipper_obj->where('full_name','like', '%' . $shipper_name . '%'); 
        }

        if($countries){
            $shipper_obj->whereIn('country', $countries);
        }

        $shippers_count = $shipper_obj->count();
        $shippers = $shipper_obj->with('shipper_country')
            ->orderBy('id','desc')->paginate($rows_numbers);
        
        return response()->json([
            'shippers' => $shippers,
            'pagination' => (string) $shippers->links('pagination::bootstrap-4'),
            'shippers_count' => $shippers_count
        ]);
    }


    public function create(){
        //
    }

 
    public function store(Request $request){
        //
    }

  
    public function show($id){
        $shipper = Shipper::findOrFail($id);
        return view('admin.shippers.show', compact(['shipper']));
    }

    public function edit($id){
        //
    }

  
    public function update(Request $request, $id){
        //
    }

 
    public function destroy($id){
        Shipper::where('id',$id)->delete();
        $message = 'Shipper hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel table actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            $shipper_id = $request->shipper_id;
            if($request->all_colums){
                Shipper::delete();
            }
            elseif($shipper_id){
                foreach($shipper_id as $id){
                    Shipper::where('id',$id)->delete();
                }
            }
            $message = 'Shippers has been archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new ShippersExport, 'shippers.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new ShippersImport,request()->file('file'));
        return redirect()->back();
    }
}
