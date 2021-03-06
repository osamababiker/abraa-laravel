<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use App\Models\Language;
use App\Http\Requests\SlidersRequest;
use App\Http\Traits\FilesUploadTrait; 
use App\Http\Traits\ClearCacheTrait; 
use App\Exports\HomeSliderExport;
use App\Imports\HomeSliderImport; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class HomeSlidersController extends Controller
{
    use FilesUploadTrait, ClearCacheTrait;

    public function index(){
        return view('admin.home.sliders.index'); 
    }

    public function getSlidersAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $sliders_obj = new HomeSlider();

        $sliders_count = $sliders_obj->count();
        $sliders = $sliders_obj->with('language')->with('user')
        ->orderBy('id','desc')->paginate($rows_numbers);
        
        return response()->json([
            'sliders' => $sliders,
            'pagination' => (string) $sliders->links('pagination::bootstrap-4'),
            'sliders_count' => $sliders_count
        ]);
    } 

    public function filterSliders(Request $request){
        $slider_title = $request->slider_title;
        $rows_numbers = $request->rows_numbers; 

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $sliders_obj = HomeSlider::with('language')->with('user');
        
        if($slider_title){
            $sliders_obj->where('title','like', '%' . $slider_title . '%'); 
        }
            
        $sliders_count = $sliders_obj->count();
        $sliders = $sliders_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'sliders' => $sliders,
            'pagination' => (string) $sliders->links('pagination::bootstrap-4'),
            'sliders_count' => $sliders_count
        ]);
    }

    public function create(){
        $languages = Language::all();
        return view('admin.home.sliders.create', compact(['languages']));
    }

    public function store(SlidersRequest $request){
        $slider = new HomeSlider();
        // to upload slider image
        $slider_url = '';
        if($request->has('slider')){
            $image = $request->file('slider');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $slider_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }
        
        $slider->title = $request->title;
        $slider->slider = $slider_url;
        $slider->link = $request->link;
        $slider->status = $request->status;
        $slider->region = $request->region;
        $slider->date_added = date('Y-m-d H:i:s');
        $slider->date_updated = date('Y-m-d H:i:s');  
        $slider->added_by = Auth::user()->id;
        $slider->save();
        
        // to clear the cache on abraa.com
        $this->clearAbraaCache("home_sliders");

        $message = 'Slider has been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }


    public function show($id){
        $slider = HomeSlider::findOrFail($id);
        return view('admin.home.sliders.show', compact(['slider']));
    }

    public function edit($id){
        $languages = Language::all();
        $slider = HomeSlider::findOrFail($id);
        return view('admin.home.sliders.edit', compact(['slider','languages']));
    }

    public function update(Request $request){
        $slider = HomeSlider::find($request->slider_id);
        // to upload slider image
        $slider_url = '';
        if($request->has('slider')){
            $image = $request->file('slider');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $slider_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }else {
            $slider_url = $slider->slider;
        }
        
        $slider->title = $request->title;
        $slider->slider = $slider_url;
        $slider->link = $request->link;
        $slider->status = $request->status;
        $slider->region = $request->region;
        $slider->save();

        // to clear the cache on abraa.com
        $this->clearAbraaCache("home_sliders");

        $message = 'Slider has been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function destroy($id){
        HomeSlider::where('id',$id)->delete();

        // to clear the cache on abraa.com
        $this->clearAbraaCache("home_sliders");

        $message = 'Slider has been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel home sliders actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->slider_id as $id){
                HomeSlider::where('id',$id)->delete();
            }
            // to clear the cache on abraa.com
            $this->clearAbraaCache("home_sliders");

            $message = 'Sliders has been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }

    
    // import & export to excel
    public function exportExcel() {
        return Excel::download(new HomeSliderExport, 'sliders.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new HomeSliderImport,request()->file('file'));
        return redirect()->back();
    }
}
