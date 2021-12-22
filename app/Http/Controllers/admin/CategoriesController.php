<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Exports\CategoriesExport;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;


class CategoriesController extends Controller
{
    
    public function index()
    {
        $countries = Country::all();
        return view('admin.categories.index',compact(['countries']));
    } 

    public function getCategoriesAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;

        $category_obj = new Category();

        $categories_count = $category_obj->count();
        $categories = $category_obj->limit($rows_numbers)
            ->with('parent')->orderBy('id','desc')->get();
        
        return response()->json([
            'categories' => $categories,
            'categories_count' => $categories_count
        ]); 
    }

    public function filterCategories(Request $request){

        
        $category_title = $request->category_title;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword;


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
        $categories = $category_obj->limit($rows_numbers)
            ->with('parent')->orderBy('id','desc')->get();

   
        return response()->json([
            'categories' => $categories,
            'categories_count' => $categories_count
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
        Category::where('id',$id)->delete();
        $message = 'Category hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new CategoriesExport, 'stores.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new CategoriesImport,request()->file('file'));
           
        return redirect()->back();
    }

}
