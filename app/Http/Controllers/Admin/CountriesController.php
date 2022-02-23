<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CountriesRequest;
use App\Models\Country;
use App\Exports\CountryExport;
use App\Imports\CountryImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;


class CountriesController extends Controller
{
    
    public function index(){
        return view('admin.countries.index');
    } 

    public function getCountriesAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;

        $country_obj = new Country();
        $countries_count = $country_obj->count();
        $countries = $country_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'countries' => $countries,
            'pagination' => (string) $countries->links('pagination::bootstrap-4'),
            'countries_count' => $countries_count
        ]); 
    }


    public function filterCountries(Request $request){
        $rows_numbers = $request->rows_numbers; 
        $country_name = $request->country_name;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $country_obj = Country::where('deleted_at',null);
        if($country_name){
            $country_obj->where('en_name', 'like', '%'. $country_name .'%')
                ->orWhere('ar_name', 'like', '%'. $country_name .'%');
        }
        $countries_count = $country_obj->count();
        $countries = $country_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
   
        return response()->json([
            'countries' => $countries,
            'pagination' => (string) $countries->links('pagination::bootstrap-4'),
            'countries_count' => $countries_count
        ]);
    }

   
    public function create(){
        return view('admin.countries.create');
    }

    
    public function store(CountriesRequest $request){
        $country = new Country();
        $country->co_code = $request->co_code;
        $country->ph_code = $request->ph_code;
        $country->ar_name = $request->ar_name;
        $country->en_name = $request->en_name;
        $country->tr_name = $request->tr_name;
        $country->ru_name = $request->ru_name;
        $country->currency_code = $request->currency_code;
        $country->slug = strtolower($request->en_name);
        $country->save();

        $message = 'Country hass been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }
  
    public function show($id){
        $country = Country::find($id);
        return view('admin.countries.show', compact(['country']));
    }

    public function edit($id){
        $country = Country::find($id);
        return view('admin.countries.edit', compact(['country']));
    }

    public function update(Request $request){
        $country = Country::find($request->country_id);
        $country->co_code = $request->co_code;
        $country->ph_code = $request->ph_code;
        $country->ar_name = $request->ar_name;
        $country->en_name = $request->en_name;
        $country->tr_name = $request->tr_name;
        $country->ru_name = $request->ru_name;
        $country->currency_code = $request->currency_code;
        $country->save();

        $message = 'Country hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function destroy($id){
        Country::where('id',$id)->delete();
        $message = 'Country hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel countries table actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->country_id as $id){
                Country::where('id',$id)->delete();
            }
            $message = 'Countries has been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new CountryExport, 'countries.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new CountryImport,request()->file('file'));
        return redirect()->back();
    }
}
