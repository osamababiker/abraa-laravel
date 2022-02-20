<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pavillion;
use App\Http\Requests\PavillionRequest;
use App\Http\Traits\FilesUploadTrait; 
use Illuminate\Pagination\Paginator;

class PavillionsController extends Controller
{
   
    use FilesUploadTrait;

    public function index(){
        return view('admin.pavillions.index');
    }

    public function getPavillionsAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $pavillion_obj = new Pavillion();

        $pavillions_count = $pavillion_obj->count();
        $pavillions = $pavillion_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'pavillions' => $pavillions,
            'pagination' => (string) $pavillions->links('pagination::bootstrap-4'),
            'pavillions_count' => $pavillions_count
        ]); 
    }

    public function filterPavillions(Request $request){
        $rows_numbers = $request->rows_numbers; 
        $name = $request->name;

        $current_page = $request->current_page;
        Paginator::currentpageResolver(function () use ($current_page) {
            return $current_page;
        });
        
        if($name){
            $pavillion_obj = Pavillion::where('name', 'like', '%'. $name . '%');
        }else $pavillion_obj = new Pavillion();

        $pavillions_count = $pavillion_obj->count();
        $pavillions = $pavillion_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
   
        return response()->json([
            'pavillions' => $pavillions,
            'pagination' => (string) $pavillions->links('pagination::bootstrap-4'),
            'pavillions_count' => $pavillions_count
        ]);
    }

    public function create(){
        return view('admin.pavillions.create');
    }

    public function store(PavillionRequest $request){

        $name_array = explode(' ', $request->name);
        $slug = '' ;
        foreach($name_array as $name){
            $name = strtolower($name);
            $slug .=  $name . '-';
        }
        $slug = rtrim($slug, "- ");
 
        $logo_url = '';
        if($request->has('logo')){
            $image = $request->file('logo');
            $image_slug = preg_replace("{/}", "-", $request->name);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $logo_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }

        $main_banner_url = '';
        if($request->has('main_banner')){
            $image = $request->file('main_banner');
            $image_slug = preg_replace("{/}", "-", $request->name);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $main_banner_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }

        $right_banner_1_url = '';
        if($request->has('right_banner_1')){
            $image = $request->file('right_banner_1');
            $image_slug = preg_replace("{/}", "-", $request->name);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $right_banner_1_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }

        $right_banner_2_url = '';
        if($request->has('right_banner_2')){
            $image = $request->file('right_banner_2');
            $image_slug = preg_replace("{/}", "-", $request->name);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $right_banner_2_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }

        $left_banner_url = '';
        if($request->has('left_banner')){
            $image = $request->file('left_banner');
            $image_slug = preg_replace("{/}", "-", $request->name);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $left_banner_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }

        $pavillion = new Pavillion();
        $pavillion->name = $request->name;
        $pavillion->bio = $request->bio;
        $pavillion->slug = $slug;
        $pavillion->logo = $logo_url;
        $pavillion->main_banner = $main_banner_url;
        $pavillion->right_banner_1 = $right_banner_1_url;
        $pavillion->right_banner_2 = $right_banner_2_url;
        $pavillion->left_banner = $left_banner_url;
        $pavillion->save();

        $message = 'New Pavillion has been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Added successfull');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function show($id){
        $pavillion = Pavillion::findOrFail($id);
        return view('admin.pavillions.show', compact(['pavillion']));
    }

    public function edit($id){
        $pavillion = Pavillion::findOrFail($id);
        return view('admin.pavillions.edit', compact(['pavillion']));
    }

    
    public function update(Request $request){

        $pavillion = Pavillion::findOrFail($request->pavillion_id);
    
        if($request->has('logo')){
            $image = $request->file('logo');
            $image_slug = preg_replace("{/}", "-", $request->name);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $logo_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }else $logo_url = $pavillion->logo;

        if($request->has('main_banner')){
            $image = $request->file('main_banner');
            $image_slug = preg_replace("{/}", "-", $request->name);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $main_banner_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }else $main_banner_url = $pavillion->main_banner;

        if($request->has('right_banner_1')){
            $image = $request->file('right_banner_1');
            $image_slug = preg_replace("{/}", "-", $request->name);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $right_banner_1_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }else $right_banner_1_url = $pavillion->right_banner_1;

        if($request->has('right_banner_2')){
            $image = $request->file('right_banner_2');
            $image_slug = preg_replace("{/}", "-", $request->name);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $right_banner_2_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }else $right_banner_2_url = $pavillion->right_banner_2;

        if($request->has('left_banner')){
            $image = $request->file('left_banner');
            $image_slug = preg_replace("{/}", "-", $request->name);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $left_banner_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }else $left_banner_url = $pavillion->left_banner;

        $pavillion->name = $request->name;
        $pavillion->bio = $request->bio;
        $pavillion->logo = $logo_url;
        $pavillion->main_banner = $main_banner_url;
        $pavillion->right_banner_1 = $right_banner_1_url;
        $pavillion->right_banner_2 = $right_banner_2_url;
        $pavillion->left_banner = $left_banner_url;
        $pavillion->save();

        $message = 'Pavillion has been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Updated successfull');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function destroy($id){
        Pavillion::where('id',$id)->delete();
        $message = 'Pavillion hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived successfully');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel pavillions table actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->pavillion_id as $id){
                Pavillion::where('id',$id)->delete();
            }
            $message = 'Pavillion hass been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Archived successfully');
            session()->flash('feedback', $message);
            return redirect()->back();
        }   
    }
}
