<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\AdsCategory;
use App\Models\Category;
use App\Exports\AdsCategoryExport; 
use App\Imports\AdsCategoryImport;
use Maatwebsite\Excel\Facades\Excel;

class AdsCategoriesController extends Controller
{
     
    public function index()
    {
        $categories = Category::all();
        return view('admin.home.adsCategories.index', compact(['categories'])); 
    }


    public function getadsCategoriesAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $adsCategories_obj = AdsCategory::where('active',1);

        $adsCategories_count = $adsCategories_obj->count();
        $adsCategories = $adsCategories_obj->limit($rows_numbers)
            ->with('category')->orderBy('id','desc')->get();
        
        return response()->json([
            'adsCategories' => $adsCategories,
            'adsCategories_count' => $adsCategories_count
        ]);
    } 

    public function filterAdsCategories(Request $request){
        
        $ads_category_name = $request->ads_category_name;
        $filter_by_category = $request->filter_by_category;
        $rows_numbers = $request->rows_numbers; 

        $adsCategories_obj = AdsCategory::leftJoin('items_cat', 'items_cat.id', '=', 'ads_cat.cat_id')
            ->where('ads_cat.active',1);
        
        if($ads_category_name){
            $adsCategories_obj->where('name','like', '%' . $ads_category_name . '%'); 
        }

        if($filter_by_category){
            foreach($filter_by_category as $category){
                $adsCategories_obj->where('items_cat.id', $category);
            }
        }
            
        $adsCategories_count = $adsCategories_obj->count();
        $adsCategories = $adsCategories_obj->limit($rows_numbers)
            ->with('category')->orderBy('items_cat.id','desc')->get();

        
        return response()->json([
            'adsCategories' => $adsCategories,
            'adsCategories_count' => $adsCategories_count
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
        AdsCategory::where('id',$id)->delete();
        $message = 'Category hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new AdsCategoryExport, 'adsCategories.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new AdsCategoryImport,request()->file('file'));
           
        return redirect()->back();
    }
}
