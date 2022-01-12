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
        $store_status = $request->store_status;

        $item_obj = Item::with('category')
            ->select("items.*")
            ->leftJoin('users', function($join) {
                $join->on('users.id', '=', 'items.user_id');
            })
            ->leftJoin('users_store', function($join) {
                $join->on('users_store.sub_of', '=', 'users.id');
            });
        
        // filter by item status
        if($items_status == 'active'){
            $item_obj = $item_obj->where('items.status', 1)
                ->where('items.rejected', 0)
                ->where('items.approved', 1);
        } 
        elseif($items_status == 'pending'){
            $item_obj = $item_obj->where('items.status', 0)
                ->where('items.rejected', 0)
                ->where('items.approved', 0);
        }
        elseif($items_status == 'rejected'){
            $item_obj = $item_obj->where('items.rejected',1);
        }
        elseif($items_status == 'home'){
            $item_obj = $item_obj->where('items.show_homepage',1);
        }

        // filter by store status
        if($store_status == 'active_stores'){
            $item_obj = $item_obj->where('users_store.trash', 0);
        } 
        elseif($store_status == 'pending_stores'){
            $item_obj = $item_obj->where('users_store.trash', 1);
        }

       
        
        if($product_name){
            $item_obj->where('items.title','like', '%' . $product_name . '%'); 
        }

        if($manufacture_country){
            $item_obj->whereIn('items.manufacture_country', $manufacture_country);
        }
        
        if($meta_keyword){
            foreach($meta_keyword as $word){
                $item_obj->where('items.meta_keyword','like', '%' . $word . '%');
            }
        }
            
        $items_count = $item_obj->count();
        $items = $item_obj->limit($rows_numbers)
            ->orderBy('items.id','desc')->get();

        
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

    // to handel some sort of actions  
    public function actions(Request $request)
    {
        // to move selected Items to archived
        if($request->has('delete_selected_btn')){
            foreach($request->item_id as $id){
                $item = Item::find($id);
                $item->delete();
            }
            $message = 'Items hass been archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }else 
        // to approve selected Items 
        if($request->has('approve_selected_btn')){
            foreach($request->item_id as $id){
                $item = Item::find($id);
                $item->status = 1;
                $item->rejected = 0;
                $item->approved = 1;
                $item->save();
            }
            $message = 'Items hass been approved successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }else
        // to reject selectd items
        if($request->has('reject_selected_btn')){
            foreach($request->item_id as $id){
                $item = Item::find($id);
                $item->status = 0;
                $item->rejected = 1;
                $item->approved = 0;
                $item->save();
            }
            $message = 'Items hass been rejected successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
        else 
        // to approve single Item
        if($request->has('approve_single_item_btn')){
           $item = Item::find($request->item_id);
           $item->status = 1;
           $item->rejected = 0;
           $item->approved = 1;
           $item->save();
           
           $message = 'Item hass been approved successfully';
           session()->flash('success', 'true');
           session()->flash('feedback_title', 'Success');
           session()->flash('feedback', $message);
           return redirect()->back();
        }
        
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
