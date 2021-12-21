<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipper;
use App\Models\Country;
use App\Exports\ShippersExport;
use App\Imports\ShippersImport;
use Maatwebsite\Excel\Facades\Excel;

class ShippersController extends Controller
{
    
    public function index()
    {
        $countries = Country::all();
        return view('admin.shippers.index', compact(['countries']));
    }

    public function getShippersAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $shippers_status = $request->shippers_status;

        $shipper_obj = Shipper::where('member_type',4)
            ->where('user_type',0);

        $shippers_count = $shipper_obj->count();
        $shippers = $shipper_obj->limit($rows_numbers)
            ->with('shipper_country')
            ->orderBy('id','desc')->get();

        
        return response()->json([
            'shippers' => $shippers,
            'shippers_count' => $shippers_count
        ]);
    }

    public function filterShippers(Request $request){
        
        $shipper_name = $request->shipper_name;
        $countries = $request->countries;
        $rows_numbers = $request->rows_numbers; 

        $shipper_obj = Shipper::where('member_type',4)
            ->where('user_type',0);

        if($shipper_name){
            $shipper_obj->where('full_name','like', '%' . $shipper_name . '%'); 
        }

        if($countries){
            $shipper_obj->whereIn('country', $countries);
        }
        
            
        $shippers_count = $shipper_obj->count();
        $shippers = $shipper_obj->limit($rows_numbers)
            ->with('shipper_country')
            ->orderBy('id','desc')->get();

        
        return response()->json([
            'shippers' => $shippers,
            'shippers_count' => $shippers_count
        ]);
    }


    public function create()
    {
        //
    }

 
    public function store(Request $request)
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

 
    public function destroy($id)
    {
        //
    }

    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new ShippersExport, 'shippers.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new ShippersImport,request()->file('file'));
           
        return redirect()->back();
    }
}
