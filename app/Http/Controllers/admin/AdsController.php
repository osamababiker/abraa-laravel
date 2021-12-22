<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Ads;
use App\Models\AdsCategory;
use App\Exports\AdsExport;
use App\Imports\AdsImport;
use Maatwebsite\Excel\Facades\Excel;

class AdsController extends Controller
{
    
    public function index()
    {
        $adsCategories = AdsCategory::all();
        return view('admin.home.ads.index', compact(['adsCategories'])); 
    }


    public function getadsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $ads_obj = Ads::where('active',1);

        $ads_count = $ads_obj->count();
        $ads = $ads_obj->limit($rows_numbers)
            ->with('category')->with('language')->orderBy('id','desc')->get();
        
        return response()->json([
            'ads' => $ads,
            'ads_count' => $ads_count
        ]);
    } 

    public function filterads(Request $request){
        
        $ads_name = $request->ads_name;
        $filter_by_category = $request->filter_by_category;
        $rows_numbers = $request->rows_numbers; 

        $ads_obj = Ads::leftJoin('ads_cat', 'ads_cat.id', '=', 'ads.sub_of')
            ->where('ads.active',1);
        
        if($ads_name){
            $ads_obj->where('ads.name','like', '%' . $ads_name . '%'); 
        }

        if($filter_by_category){
            foreach($filter_by_category as $category){
                $ads_obj->where('ads_cat.id', $category);
            }
        }
            
        $ads_count = $ads_obj->count();
        $ads = $ads_obj->limit($rows_numbers)
            ->with('category')->with('language')->orderBy('ads.id','desc')->get();

        
        return response()->json([
            'ads' => $ads,
            'ads_count' => $ads_count
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
        Ads::where('id',$id)->delete();
        $message = 'Category hass been deleted successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new AdsExport, 'ads.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new AdsImport,request()->file('file'));
           
        return redirect()->back();
    }
}
