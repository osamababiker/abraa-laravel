<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\HomeBanner;
use App\Exports\HomeBannerExport;
use App\Imports\HomeBannerImport;
use Maatwebsite\Excel\Facades\Excel;

class HomeBannersController extends Controller
{
    public function index()
    {
        return view('admin.home.banners.index'); 
    }


    public function getbannersAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $banners_obj = HomeBanner::where('status',1);

        $banners_count = $banners_obj->count();
        $banners = $banners_obj->limit($rows_numbers)
            ->with('language')->with('user')->orderBy('id','desc')->get();
        
        return response()->json([
            'banners' => $banners,
            'banners_count' => $banners_count
        ]);
    } 

    public function filterbanners(Request $request){
        
        $banner_title = $request->banner_title;
        $rows_numbers = $request->rows_numbers; 

        $banners_obj = HomeBanner::where('status',1);
        
        if($banner_title){
            $banners_obj->where('title','like', '%' . $banner_title . '%'); 
        }
            
        $banners_count = $banners_obj->count();
        $banners = $banners_obj->limit($rows_numbers)
            ->with('language')->with('user')->orderBy('id','desc')->get();

        
        return response()->json([
            'banners' => $banners,
            'banners_count' => $banners_count
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
        HomeBanner::where('id',$id)->delete();
        $message = 'Banner hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new HomeBannerExport, 'banners.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new HomeBannerImport,request()->file('file'));
           
        return redirect()->back();
    }
}
