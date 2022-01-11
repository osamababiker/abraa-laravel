<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Country;
use App\Exports\ItemsExport;
use App\Imports\ItemsImport;
use Maatwebsite\Excel\Facades\Excel;

class ItemsController extends Controller
{

    public function index()
    {
        $countries = Country::all();
        return view('admin.items.index', compact(['countries']));
    }

    public function getItemsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $items_status = $request->items_status;

        $item_obj = new Item();

        $items_count = $item_obj->count();
        $items = $item_obj->limit($rows_numbers)
            ->orderBy('id','DESC')->with('category')
            ->with('supplier')->get();
        
        return response()->json([
            'items' => $items,
            'items_count' => $items_count
        ]);
    }

    public function filterItems(Request $request){
        
        $product_name = $request->product_name;
        $manufacture_country = $request->manufacture_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword; 
        $items_status = $request->items_status;

        $item_obj = Item::with('category')->with('supplier');

        if($items_status == 'active'){
            $item_obj = $item_obj->where('status', 1)
                ->where('rejected', 0)
                ->where('approved', 1);
        } 
        elseif($items_status == 'pending'){
            $item_obj = $item_obj->where('status', 0)
                ->where('rejected', 0)
                ->where('approved', 0);
        }
        elseif($items_status == 'rejected'){
            $item_obj = $item_obj->where('rejected',1);
        }
        elseif($items_status == 'home'){
            $item_obj = $item_obj->where('show_homepage',1);
        }
       
        
        if($product_name){
            $item_obj->where('title','like', '%' . $product_name . '%'); 
        }

        if($manufacture_country){
            $item_obj->whereIn('manufacture_country', $manufacture_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $item_obj->where('meta_keyword','like', '%' . $word . '%');
            }
        }
            
        $items_count = $item_obj->count();
        $items = $item_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();

        
        return response()->json([
            'items' => $items,
            'items_count' => $items_count
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

    // to handel some sort of actions , like delete multiple 
    public function actions(Request $request)
    {
        $item_id = $request->item_id;
        if($request->all_colums){
            Item::delete();
        }
        elseif($item_id){
            foreach($item_id as $id){
                Item::where('id',$id)->delete();
            }
        }
        $message = 'Items hass been deleted successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
        
    }
   
    public function show($id)
    {
        dd($id);
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
        Item::where('id',$id)->delete();
        $message = 'Item hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel 
    public function exportExcel() {
        return Excel::download(new ItemsExport, 'stores.xlsx'); 
    }
    
    public function importView(){
        $suppliers = Supplier::whereIn('member_type',[1,3])
            ->where('user_type',0)->orderBy('id','desc')->get();
        $categories = Category::all();
        return view('admin.items.import_csv',compact(['suppliers','categories']));    
    }

    public function importExcel(Request $request) {

        $csv_file = $request->csv_file;
        $supplier = Supplier::find($request->supplier_id);
        $data['supplier_id'] = $supplier->id;
        $data['supplier_phone'] = $supplier->phone;
        $data['category_id'] = $request->category_id;
        Excel::import(new ItemsImport($data),$csv_file);
 
        $message = 'Items hass been imported successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }
}
