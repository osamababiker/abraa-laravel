<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rfq;

class RfqsController extends Controller
{

    public function index() 
    {
        $buying_requests = Rfq::paginate(10);
        $buying_requests_count = Rfq::count();
        return view('admin.rfq.index', compact(['buying_requests','buying_requests_count'])); 
    }

    public function getRfqsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $buying_requests_status = $request->buying_requests_status;

        $buying_request_obj = Rfq::where('rejected',0);

        if($buying_requests_status == 'active'){
            // $buying_request_obj = 1;
        } 
        elseif($buying_requests_status == 'pending'){
            // $buying_request_obj = 1;
        }
        elseif($buying_requests_status == 'rejected'){
            // $buying_request_obj = 1;
        }
        elseif($buying_requests_status == 'bulk'){
            // $buying_request_obj = 1;
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
        
        $buying_request_name = $request->buying_request_name;
        $buying_request_country = $request->buying_request_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;
        $request_type = $request->request_type;
        $buying_requests_status = $request->buying_requests_status;

        $buying_request_obj = buying_request::where('rejected',0);

        if($buying_requests_status == 'active'){
            // $buying_request_obj = 1;
        }
        elseif($buying_requests_status == 'pending'){
           // $buying_request_obj = 1;
        }
        elseif($buying_requests_status == 'rejected'){
            // $buying_request_obj = 1;
        }
        elseif($buying_requests_status == 'home'){
            // $buying_request_obj = 1; 
        }
        
        if($buying_request_name){
            $buying_request_obj->where('name', $buying_request_name);
        }

        if($buying_request_country){
            $buying_request_obj->whereIn('country', $buying_request_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $buying_request_obj->where('meta_keywords','like', '%' . $word . '%');
            }
        }
            
        $buying_requests_count = $buying_request_obj->count();
        $buying_requests = $buying_request_obj->limit($rows_numbers)->with('user')
            ->orderBy('id','desc')->get();

   
        return response()->json([
            'buying_requests' => $buying_requests,
            'buying_requests_count' => $buying_requests_count
        ]);
    }

    public function pending_rfq()
    {
        $buying_requests = Rfq::where('item_id' , '<>', 0)
            ->where('status',1)->paginate(10);
        $buying_requests_count = Rfq::where('item_id' , '<>', 0)
            ->where('status',1)->count();
        return view('admin.rfq.pending', compact(['buying_requests','buying_requests_count']));
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
}
