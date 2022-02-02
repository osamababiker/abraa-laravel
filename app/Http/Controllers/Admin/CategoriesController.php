<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Http\Requests\CategoriesRequest;
use App\Exports\CategoriesExport;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;
use App\Http\Traits\FilesUploadTrait;


class CategoriesController extends Controller
{
    use FilesUploadTrait ; 

    public function index(){
        $countries = Country::all();
        return view('admin.categories.index',compact(['countries']));
    } 

    public function getCategoriesAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $category_obj = new Category();

        $categories_count = $category_obj->count();
        $categories = $category_obj->with('parent')->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'categories' => $categories,
            'pagination' => (string) $categories->links('pagination::bootstrap-4'),
            'categories_count' => $categories_count
        ]); 
    }

    public function filterCategories(Request $request){
        $category_title = $request->category_title;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $category_obj = Category::where('deleted_at',null);

        if($category_title){
            $category_obj->where('en_title','like', '%' . $category_title . '%')
                ->orWhere('ar_title','like', '%' . $category_title . '%')
                ->orWhere('cn_title','like', '%' . $category_title . '%')
                ->orWhere('ru_title','like', '%' . $category_title . '%')
                ->orWhere('tr_title','like', '%' . $category_title . '%')
                ->orWhere('pr_title','like', '%' . $category_title . '%');
        }

        if($meta_keyword){
            foreach($meta_keyword as $word){
                $category_obj->where('meta_keywords','like', '%' . $word . '%');
            }
        }
            
        $categories_count = $category_obj->count();
        $categories = $category_obj->with('parent')->orderBy('id','desc')
        ->paginate($rows_numbers);
   
        return response()->json([
            'categories' => $categories,
            'pagination' => (string) $categories->links('pagination::bootstrap-4'),
            'categories_count' => $categories_count
        ]);
    }


    public function create(){
        $categories = Category::all();
        return view('admin.categories.create', compact(['categories']));
    }


    public function store(CategoriesRequest $request){
        $category = new Category();

        $pic_url = '';
        if($request->has('pic_url')){
            $image = $request->file('pic_url');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $pic_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }

        $banner_url = '';
        if($request->has('banner_url')){
            $image = $request->file('banner_url');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $banner_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }

        $category->sub_of = $request->sub_of;
        $category->slug = $request->slug;
        $category->ar_title = $request->ar_title;
        $category->en_title = $request->en_title;
        $category->cn_title = $request->cn_title;
        $category->ru_title = $request->ru_title;
        $category->tr_title = $request->tr_title;
        $category->pr_title = $request->pr_title;
        $category->ar_description = $request->ar_description;
        $category->en_description = $request->en_description;
        $category->cn_description = $request->cn_description;
        $category->tr_description = $request->tr_description;
        $category->pr_description = $request->pr_description;
        $category->ru_description = $request->ru_description;
        $category->sort_id = $request->sort_id;
        $category->sort_order = $request->sort_order;
        $category->status = $request->status;
        $category->is_home_thumb = $request->is_home_thumb;
        $category->pic_url = $pic_url;
        $category->banner_url = $banner_url;
        $category->top_desc_id = $request->top_desc_id;
        $category->footer_desc_id = $request->footer_desc_id;
        $category->meta_title = $request->meta_title;
        $category->meta_keywords = $request->meta_keywords;
        $category->meta_description = $request->meta_description;
        $category->save();

        $message = 'Category hass been Saved successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function show($id){
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact(['category']));
    } 


    public function edit($id){
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view('admin.categories.edit', compact(['category','categories']));
    }


    public function update(CategoriesRequest $request){
        $category = Category::findOrFail($request->category_id);

        $pic_url = '';
        if($request->has('pic_url')){
            $image = $request->file('pic_url');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $pic_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }else $pic_url = $category->pic_url;

        $banner_url = '';
        if($request->has('banner_url')){
            $image = $request->file('banner_url');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $banner_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }else $banner_url = $category->banner_url;

        $category->sub_of = $request->sub_of;
        $category->slug = $request->slug;
        $category->ar_title = $request->ar_title;
        $category->en_title = $request->en_title;
        $category->cn_title = $request->cn_title;
        $category->ru_title = $request->ru_title;
        $category->tr_title = $request->tr_title;
        $category->pr_title = $request->pr_title;
        $category->ar_description = $request->ar_description;
        $category->en_description = $request->en_description;
        $category->cn_description = $request->cn_description;
        $category->tr_description = $request->tr_description;
        $category->pr_description = $request->pr_description;
        $category->ru_description = $request->ru_description;
        $category->sort_id = $request->sort_id;
        $category->sort_order = $request->sort_order;
        $category->status = $request->status;
        $category->is_home_thumb = $request->is_home_thumb;
        $category->pic_url = $pic_url;
        $category->banner_url = $banner_url;
        $category->top_desc_id = $request->top_desc_id;
        $category->footer_desc_id = $request->footer_desc_id;
        $category->meta_title = $request->meta_title;
        $category->meta_keywords = $request->meta_keywords;
        $category->meta_description = $request->meta_description;
        $category->save();

        $message = 'Category hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

 
    public function destroy($id){
        Category::where('id',$id)->delete();
        $message = 'Category hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new CategoriesExport, 'categories.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new CategoriesImport,request()->file('file'));
        return redirect()->back();
    }

}
