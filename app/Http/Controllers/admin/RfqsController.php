<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth; 
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rfq;
use App\Models\Country;
use App\Exports\RfqsExport;
use App\Imports\RfqsImport;
use Maatwebsite\Excel\Facades\Excel;

class RfqsController extends Controller
{

    public function index() 
    {
        $countries = Country::all();
        return view('admin.rfq.index', compact(['countries'])); 
    }

    public function getRfqsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $buying_requests_status = $request->buying_requests_status;

        $buying_request_obj = new Rfq();

     
        if($buying_requests_status == 'approvel'){    
            $buying_request_obj = $buying_request_obj->where('status',2);
        }
        elseif($buying_requests_status == 'completed'){
            $buying_request_obj = $buying_request_obj->where('status',3);
        }
        elseif($buying_requests_status == 'canceled'){
            $buying_request_obj = $buying_request_obj->where('status',5);
        }
        elseif($buying_requests_status == 'pending'){
            $buying_request_obj = $buying_request_obj->where('status',1);
        }
      

        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj->limit($rows_numbers)
            ->with('category')->with('unit')->orderBy('id','desc')->get();
        
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
        $buying_requests_status = $request->buying_requests_status;

        $buying_request_obj =  Rfq::where('deleted_at',null);


        if($buying_requests_status == 'approvel'){    
            $buying_request_obj = $buying_request_obj->where('status',2);
        }
        elseif($buying_requests_status == 'completed'){
            $buying_request_obj = $buying_request_obj->where('status',3);
        }
        elseif($buying_requests_status == 'canceled'){
            $buying_request_obj = $buying_request_obj->where('status',5);
        }
        elseif($buying_requests_status == 'pending'){
            $buying_request_obj = $buying_request_obj->where('status',1);
        }
        
        if($product_name){
            $buying_request_obj->where('product_name','like', '%' . $product_name . '%');
        }

        if($request_type == 'global'){
            $buying_request_obj->where('item_id', 0);
        }

        if($shipping_country){
            $buying_request_obj->whereIn('country_code', $shipping_country);
        }

    
            
        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj->limit($rows_numbers)
            ->with('category')->with('unit')
            ->orderBy('id','desc')->get();

   
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


    public function destroy($id)
    {
        //
    }

    
    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new RfqsExport, 'stores.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new RfqsImport,request()->file('file'));
           
        return redirect()->back();
    }
}
