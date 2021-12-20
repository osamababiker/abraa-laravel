<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipper;
use App\Models\Country;

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

        $shipper_obj = Shipper::where('status',1);

        $shippers_count = $shipper_obj->count();
        $shippers = $shipper_obj->limit($rows_numbers)
            ->with('user')->with('shipper_country')
            ->orderBy('id','desc')->get();
        
        return response()->json([
            'shippers' => $shippers,
            'shippers_count' => $shippers_count
        ]);
    }

    public function filterShippers(Request $request){
        
        $company_name = $request->company_name;
        $countries = $request->countries;
        $rows_numbers = $request->rows_numbers; 

        $shipper_obj = Shipper::where('status',1);

        if($company_name){
            $shipper_obj->where('company_name','like', '%' . $company_name . '%'); 
        }

        if($countries){
            $shipper_obj->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'shippers.sub_of');
            })->whereIn('users.country', $countries);
        }
        
            
        $shippers_count = $shipper_obj->count();
        $shippers = $shipper_obj->limit($rows_numbers)
            ->with('user')->with('shipper_country')
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
}
