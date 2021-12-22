<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use App\Exports\HomeSliderExport;
use App\Imports\HomeSliderImport;
use Maatwebsite\Excel\Facades\Excel;

class HomeSlidersController extends Controller
{
   
    public function index()
    {
        return view('admin.home.sliders.index'); 
    }


    public function getSlidersAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $sliders_obj = HomeSlider::where('status',1);

        $sliders_count = $sliders_obj->count();
        $sliders = $sliders_obj->limit($rows_numbers)
            ->with('language')->with('user')->orderBy('id','desc')->get();
        
        return response()->json([
            'sliders' => $sliders,
            'sliders_count' => $sliders_count
        ]);
    } 

    public function filterSliders(Request $request){
        
        $slider_title = $request->slider_title;
        $rows_numbers = $request->rows_numbers; 

        $sliders_obj = HomeSlider::where('status',1);
        
        if($slider_title){
            $sliders_obj->where('title','like', '%' . $slider_title . '%'); 
        }
            
        $sliders_count = $sliders_obj->count();
        $sliders = $sliders_obj->limit($rows_numbers)
            ->with('language')->with('user')->orderBy('id','desc')->get();

        
        return response()->json([
            'sliders' => $sliders,
            'sliders_count' => $sliders_count
        ]);
    }

    public function create()
    {
        return view('admin.home.sliders.create');
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
        HomeSlider::where('id',$id)->delete();
        $message = 'Slider hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new HomeSliderExport, 'sliders.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new HomeSliderImport,request()->file('file'));
           
        return redirect()->back();
    }
}
