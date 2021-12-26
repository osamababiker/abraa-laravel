<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Exports\CountryExport;
use App\Imports\CountryImport;
use Maatwebsite\Excel\Facades\Excel;

class CountriesController extends Controller
{
    
    public function index()
    {
        return view('admin.countries.index');
    } 

    public function getCountriesAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;

        $country_obj = new Country();

        $countries_count = $country_obj->count();
        $countries = $country_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();
        
        return response()->json([
            'countries' => $countries,
            'countries_count' => $countries_count
        ]); 
    }


    public function filterCountries(Request $request){

        $rows_numbers = $request->rows_numbers; 
        $country_name = $request->country_name;
        $country_obj = Country::where('deleted_at',null);
        
        if($country_name){
            $country_obj->where('en_name', 'like', '%'. $country_name .'%')
                ->orWhere('ar_name', 'like', '%'. $country_name .'%');
        }
        $countries_count = $country_obj->count();
        $countries = $country_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();
   
        return response()->json([
            'countries' => $countries,
            'countries_count' => $countries_count
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

  
    public function destroy($id){
        Country::where('id',$id)->delete();
        $message = 'Country hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new CountryExport, 'countries.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new CountryImport,request()->file('file'));
           
        return redirect()->back();
    }
}
