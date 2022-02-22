<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Country; 
use App\Models\State; 
use App\Exports\BuyersExport;
use App\Imports\BuyersImport;
use App\Http\Requests\BuyersRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;
use App\Http\Traits\RandomStringTrait; 

class BuyersController extends Controller
{
    use RandomStringTrait;

    public function index(){ 
        $countries = Country::all();
        return view('admin.buyers.index',compact(['countries']));
    } 

    public function getBuyersAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $buyers_object = Buyer::whereIn('member_type',[2,3])
            ->where('user_type',0);

        $buyers = $buyers_object->orderBy('id','desc')
            ->with('buyer_country')->paginate($rows_numbers);
        $buyers_count = $buyers_object->count();
        
        return response()->json([
            'buyers' => $buyers,
            'pagination' => (string) $buyers->links('pagination::bootstrap-4'),
            'buyers_count' => $buyers_count
        ]);
    }

    public function filterBuyers(Request $request){
        $countries = $request->countries;
        $keywords = $request->keywords;
        $rows_numbers = $request->rows_numbers; 
        $buyer_name = $request->buyer_name;
        $date_range = $request->date_range;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $buyers_object = Buyer::whereIn('member_type',[2,3])
            ->where('user_type',0);

        if($buyer_name){
            $buyers_object->where('full_name', 'like', '%'. $buyer_name. '%');
        }

        if($countries){
            $buyers_object->whereIn('country', $countries);
        }
        
        if($keywords){
            foreach($keywords as $word){
                $buyers_object->where('interested_keywords','like', '%' . $word . '%');
            }
        }

        if($date_range){
            $date_range = explode(' - ', $date_range);
            $buyers_object->whereBetween('date_added', $date_range);
        }
            
        $buyers_count = $buyers_object->count();
        $buyers = $buyers_object->orderBy('id','desc')->with('buyer_country')
        ->paginate($rows_numbers);
        
        return response()->json([
            'buyers' => $buyers,
            'pagination' => (string) $buyers->links('pagination::bootstrap-4'),
            'buyers_count' => $buyers_count
        ]);
    }

    // to get cites by country for create page 
    public function getCites($country_id){
        $states_html = '';
        $states = State::where('sub_of', $country_id)->get();
        foreach($states as $state) {
            $states_html .= "<option value='$state->id'>$state->en_name</option>";
        }
        return response()->json([
            'state_html' => $states_html
        ]);
    }

    public function create(){
        $countries = Country::all();
        return view('admin.buyers.create', compact(['countries']));
    }

    public function store(BuyersRequest $request){
        $buyer = new Buyer();
        $salt = $this->getRandomString(3);
        $password = md5($request->password . $salt);
        $interested_keywords = '';
        $country = Country::find($request->country)->co_code;
        foreach($request->interested_keywords as $keywords){
            $interested_keywords .= $keywords . ',';
        }
        $buyer->full_name = $request->full_name;
        $buyer->email = $request->email;
        $buyer->password = $password;
        $buyer->country = $country;
        $buyer->city = $request->city;
        $buyer->phone = $request->phone;
        $buyer->company = $request->company;
        $buyer->interested_keywords = $interested_keywords;
        $buyer->verified = $request->verified;
        $buyer->active = $request->active;
        $buyer->is_login = 0;
        $buyer->member_type = 2;
        $buyer->is_organic = 0;
        $buyer->save();

        $message = 'Buyer hass been Saved successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function show(Buyer $buyer){
        //
    }

    public function edit(Buyer $buyer){
        //
    }

    public function update(Request $request, Buyer $buyer){
        //
    }

  
    public function destroy($id){
        Buyer::where('id',$id)->delete();
        $message = 'Buyer hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }


    // to handel table actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){ 
            $buyer_id = $request->buyer_id;
            if($request->all_colums){
                Buyer::delete();
            }
            elseif($buyer_id){
                foreach($buyer_id as $id){
                    Buyer::where('id',$id)->delete();
                }
            }
            $message = 'Buyers has been archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new BuyersExport, 'buyers.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new BuyersImport,request()->file('file'));
        return redirect()->back();
    }
}
