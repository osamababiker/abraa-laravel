<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\HomeBanner;
use App\Models\Language;
use App\Exports\HomeBannerExport;
use App\Imports\HomeBannerImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\FilesUploadTrait;
use App\Http\Traits\ClearCacheTrait; 
use Illuminate\Pagination\Paginator;

class HomeBannersController extends Controller
{
    use FilesUploadTrait , ClearCacheTrait;
    
    public function index(){
        return view('admin.home.banners.index'); 
    }

    public function getbannersAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $banners_obj = HomeBanner::with('language')->with('user');

        $banners_count = $banners_obj->count();
        $banners = $banners_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'banners' => $banners,
            'pagination' => (string) $banners->links('pagination::bootstrap-4'),
            'banners_count' => $banners_count
        ]);
    } 

    public function filterbanners(Request $request){
        $banner_title = $request->banner_title;
        $rows_numbers = $request->rows_numbers; 

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $banners_obj = HomeBanner::with('language')->with('user');
        if($banner_title){
            $banners_obj->where('title','like', '%' . $banner_title . '%'); 
        }
            
        $banners_count = $banners_obj->count();
        $banners = $banners_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'banners' => $banners,
            'pagination' => (string) $banners->links('pagination::bootstrap-4'),
            'banners_count' => $banners_count
        ]);
    }


    public function create(){
        //
    }

    public function store(Request $request){
        //
    }
  
    public function show($id){
        //
    }

    public function edit($id){
        $banner = HomeBanner::find($id);
        $languages = Language::all();
        return view('admin.home.banners.edit', compact(['banner','languages']));
    }
   
    public function update(Request $request){
        $banner = HomeBanner::find($request->banner_id);
        // to upload slider image
        $banner_url = '';
        if($request->has('slider')){
            $image = $request->file('slider');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $banner_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }else {
            $banner_url = $banner->slider;
        }
        
        $banner->title = $request->title;
        $banner->slider = $banner_url;
        $banner->link = $request->link;
        $banner->status = $request->status;
        $banner->region = $request->region;
        $banner->date_updated = date('Y-m-d H:i:s');  
        $banner->save();

        // to clear the cache on abraa.com
        $this->clearAbraaCache("home_banners");

        $message = 'banner hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Updated Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

   
    public function destroy($id){
        HomeBanner::where('id',$id)->delete();

        // to clear the cache on abraa.com
        $this->clearAbraaCache("home_banners");

        $message = 'Banner hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel banners table actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->banner_id as $id){
                HomeBanner::where('id',$id)->delete();
            }
            // to clear the cache on abraa.com
            $this->clearAbraaCache("home_banners");

            $message = 'banners hass been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }
    
    // import & export to excel
    public function exportExcel() {
        return Excel::download(new HomeBannerExport, 'banners.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new HomeBannerImport,request()->file('file'));
        return redirect()->back();
    }
}
