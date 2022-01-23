<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Shipper;
use App\Models\Country;
use App\Exports\ShippingExport;
use App\Imports\ShippingImport;
use App\Http\Requests\ShippingRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class ShippingController extends Controller
{
  
    public function index(){
        $countries = Country::all();
        return view('admin.shipping.index', compact(['countries']));
    }

    // get shipping companies as json
    public function getShippingAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $shipper_status = $request->shipper_status;

        $shipper_obj = Shipping::with('shipper')
        ->with('shipping_to_country')->with('shipping_from_country');

        $shippings_count = $shipper_obj->count();
        $shippings = $shipper_obj->orderBy('id','desc')
        ->paginate($rows_numbers);

        return response()->json([
            'shippings' => $shippings,
            'pagination' => (string) $shippings->links('pagination::bootstrap-4'),
            'shippings_count' => $shippings_count
        ]);
    }

    // to filter shipping companies
    public function filterShipping(Request $request){
        $shipper_name = $request->shipper_name;

        if($request->shipper_status){
            $shipper_status = (int) $request->shipper_status;
        }else $shipper_status = $request->shipper_status;

        $company_name = $request->company_name;
        $rows_numbers = $request->rows_numbers; 

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $shipper_obj = Shipping::leftJoin('users', function($join) {
            $join->on('users.id', '=', 'shippers.sub_of');
        })
        ->select('shippers.*');

        if($shipper_name){
            $shipper_obj->where('users.full_name','like', '%' . $shipper_name . '%'); 
        }

        if($company_name){
            $shipper_obj->where('shippers.company_name','like', '%' . $company_name . '%'); 
        }

        if($shipper_status){
            $shipper_obj->where('shippers.status', $shipper_status);
        }

        $shippings_count = $shipper_obj->count();
        $shippings = $shipper_obj->with('shipper')
            ->with('shipping_to_country')->with('shipping_from_country')
            ->orderBy('id','desc')->paginate($rows_numbers);
        
        return response()->json([
            'shippings' => $shippings,
            'pagination' => (string) $shippings->links('pagination::bootstrap-4'),
            'shippings_count' => $shippings_count
        ]);
    }

    public function create(){
        $shippers = Shipper::where('member_type',4)
        ->where('user_type',0)->get();
        $countries = Country::all();
        return view('admin.shipping.create', compact(['shippers','countries']));
    }

    public function store(ShippingRequest $request){
        $shipping_obj = new Shipping();
        $shipping_obj->sub_of = $request->sub_of;
        $shipping_obj->email = $request->email;
        $shipping_obj->phone_number = $request->phone_number;
        $shipping_obj->company_name = $request->company_name;
        $shipping_obj->shipping_from = $request->shipping_from;
        $shipping_obj->shipping_to = $request->shipping_to;
        $shipping_obj->shipping_methods = $request->shipping_methods;
        $shipping_obj->clearance = $request->clearance;
        $shipping_obj->doortodoor = $request->doortodoor;
        $shipping_obj->status = $request->status;
        $shipping_obj->save();

        $message = 'Shipping Company hass been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

   
    public function show($id){
        $shipper = Shipping::findOrFail($id);
        return view('admin.shipping.show', compact(['shipper']));
    }

    
    public function edit($id){
        //
    }

    public function update(Request $request){
        //
    }

    public function destroy($id){
        Shipping::where('id',$id)->delete();
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
                Shipping::delete();
            }
            elseif($shipper_id){
                foreach($shipper_id as $id){
                    Shipping::where('id',$id)->delete();
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
        return Excel::download(new ShippingExport, 'shippers.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new ShippingImport,request()->file('file'));
        return redirect()->back();
    }
}
