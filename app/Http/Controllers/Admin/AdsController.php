<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Ads; 
use App\Models\Language;
use App\Http\Requests\AdsRequest;
use App\Models\AdsCategory;
use App\Exports\AdsExport;
use App\Imports\AdsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\FilesUploadTrait;

class AdsController extends Controller
{
    use FilesUploadTrait ;

    public function index(){
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
            ->select('ads.*')
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

    
    public function create(){
        $adsCategories = AdsCategory::all();
        $languages = Language::all();
        return view('admin.home.ads.create', compact(['adsCategories','languages']));
    }

    public function store(AdsRequest $request){
        $ads = new Ads();
        // to upload ads image
        $pic_url = '';
        if($request->has('pic_url')){
            $image = $request->file('pic_url');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $pic_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }
        $ads->name = $request->name;
        $ads->sub_of = $request->sub_of;
        $ads->ad_type = $request->ad_type;
        $ads->link = $request->link;
        $ads->ad_code = $request->ad_code;
        $ads->alt_txt = $request->alt_txt;
        $ads->start_on = $request->start_on;
        $ads->expire_on = $request->expire_on;
        $ads->lang = $request->lang;
        $ads->active = $request->active;
        $ads->pic_url = $pic_url;
        $ads->date_added = date('Y-m-d H:i:s');
        $ads->date_updated = date('Y-m-d H:i:s');
        $ads->added_by = Auth::user()->id;
        $ads->views = 0;
        $ads->clicks = 0;
        $ads->save();

        $message = 'Ads hass been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }


    public function show($id){
        $ads = Ads::find($id);
        return view('admin.home.ads.show', compact(['ads']));
    }

 
    public function edit($id){
        $ads = Ads::findOrFail($id);
        $adsCategories = AdsCategory::all();
        $languages = Language::all();
        return view('admin.home.ads.edit', compact(['ads','adsCategories','languages']));
    }

  
    public function update(Request $request){
        $ads = Ads::find($request->ads_id);
        // to upload ads image
        $pic_url = '';
        if($request->has('pic_url')){
            $image = $request->file('pic_url');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $pic_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }else{
            $pic_url = $ads->pic_url;
        }
        $ads->name = $request->name;
        $ads->sub_of = $request->sub_of;
        $ads->ad_type = $request->ad_type;
        $ads->link = $request->link;
        $ads->ad_code = $request->ad_code;
        $ads->alt_txt = $request->alt_txt;
        $ads->start_on = $request->start_on;
        $ads->expire_on = $request->expire_on;
        $ads->lang = $request->lang;
        $ads->active = $request->active;
        $ads->pic_url = $pic_url;
        $ads->date_updated = date('Y-m-d H:i:s');
        $ads->updated_by = Auth::user()->id;
        $ads->save();

        $message = 'Ads hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }
    
    
    public function destroy($id){
        Ads::where('id',$id)->delete();
        $message = 'Ads hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }


    // to handel ads table actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->ads_id as $id){
                Ads::where('id',$id)->delete();
            }
            $message = 'Ads hass been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }
    
    // import & export to excel
    public function exportExcel() {
        return Excel::download(new AdsExport, 'ads.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new AdsImport,request()->file('file'));
        return redirect()->back();
    }
}
