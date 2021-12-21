<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Country; 
use App\Exports\BuyersExport;
use App\Imports\BuyersImport;
use Maatwebsite\Excel\Facades\Excel;

class BuyersController extends Controller
{
    
    public function index()
    { 
        $countries = Country::all();
        return view('admin.buyers.index',compact(['countries']));
    }


    public function getBuyersAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;

        $buyers_object = Buyer::whereIn('member_type',[2,3])
            ->where('user_type',0);

        $buyers = $buyers_object->orderBy('id','desc')
            ->with('buyer_country')->limit($rows_numbers)->get();
        $buyers_count = $buyers_object->count();
        
        return response()->json([
            'buyers' => $buyers,
            'buyers_count' => $buyers_count
        ]);
    }

    public function filterBuyers(Request $request){

        $countries = $request->countries;
        $keywords = $request->keywords;
        $rows_numbers = $request->rows_numbers; 
        $buyer_name = $request->buyer_name;

        $buyers_object = Buyer::whereIn('member_type',[2,3])
            ->where('user_type',0);

        if($buyer_name){
            $buyers_object->where('full_name', $buyer_name);
        }

        if($countries){
            $buyers_object->whereIn('country', $countries);
        }
        
        if($keywords){
            foreach($keywords as $word){
                $buyers_object->where('interested_keywords','like', '%' . $word . '%');
            }
        }

            
        $buyers_count = $buyers_object->count();
        $buyers = $buyers_object->limit($rows_numbers)
            ->orderBy('id','desc')->with('buyer_country')->get();
        
        
        return response()->json([
            'buyers' => $buyers,
            'buyers_count' => $buyers_count
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

    // to handel some sort of actions , like delete multiple ,
    //  or send email , sms to multiple 
    public function actions(Request $request)
    {

        $buyer_id = $request->buyer_id;
        if($request->all_colums){
            dd($request->all_colums);
        }
        elseif($buyer_id){
            foreach($buyer_id as $id){
                Buyer::where('id',$id)->delete();
            }
        }
        
    }


    public function show(Buyer $buyer)
    {
        //
    }

    public function edit(Buyer $buyer)
    {
        //
    }

    public function update(Request $request, Buyer $buyer)
    {
        //
    }

  
    public function destroy(Buyer $buyer)
    {
        //
    }

    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new BuyersExport, 'stores.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new BuyersImport,request()->file('file'));
           
        return redirect()->back();
    }
}
