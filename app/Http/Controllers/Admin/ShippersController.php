<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipper;
use App\Models\Country;
use App\Models\State;
use App\Exports\ShippersExport;
use App\Imports\ShippersImport;
use App\Http\Requests\ShippersRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\RandomStringTrait; 
use Illuminate\Pagination\Paginator;

class ShippersController extends Controller
{
    use RandomStringTrait;

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
        $date_range = $request->date_range;
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

        
        if($date_range){
            $date_range = explode(' - ', $date_range);
            $shipper_obj->whereBetween('date_added', $date_range);
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

    // to get cites by country for create page 
    public function getCites($country_code){
        $states_html = '';
        $country = Country::where('co_code',$country_code)->first();
        $states = State::where('sub_of', $country->id)->get();
        $phone_code = $country->ph_code;
        foreach($states as $state) {
            $states_html .= "<option value='$state->id'>$state->en_name</option>";
        }
        return response()->json([
            'state_html' => $states_html,
            'phone_code' => $phone_code
        ]);
    }

    public function create(){
        $countries = Country::all();
        return view('admin.shippers.create', compact(['countries']));
    }

 
    public function store(ShippersRequest $request){
        $shipper = new Shipper();

        $salt = $this->getRandomString(3);
        $password = md5($request->password . $salt);
        $member_type = 4;
        $user_type = 0;

        $shipper->full_name = $request->full_name;
        $shipper->email = $request->email;
        $shipper->phone = $request->phone;
        $shipper->country = $request->country;
        $shipper->city = $request->city;
        $shipper->verified = $request->verified;
        $shipper->password = $password;
        $shipper->member_type = $member_type;
        $shipper->user_type = $user_type;
        $shipper->is_login = 0;
        $shipper->added_by = Auth::user()->id;
        $shipper->save();

        $message = 'Shipping Company hass Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

  
    public function show($id){
        $shipper = Shipper::findOrFail($id);
        return view('admin.shippers.show', compact(['shipper']));
    }

    public function edit($id){
        $shipper = Shipper::findOrFail($id);
        $countries = Country::all();
        return view('admin.shippers.edit', compact(['shipper','countries']));
    }

  
    public function update(Request $request){
        $shipper = Shipper::find($request->shipper_id);
        if($request->password){
            $salt = $this->getRandomString(3);
            $password = md5($request->password . $salt);
        }else $password = $shipper->password;

        $shipper->full_name = $request->full_name;
        $shipper->email = $request->email;
        $shipper->phone = $request->phone;
        $shipper->country = $request->country;
        $shipper->city = $request->city;
        $shipper->verified = $request->verified;
        $shipper->password = $password;
        $shipper->save();

        $message = 'Shipping Company hass Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
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
