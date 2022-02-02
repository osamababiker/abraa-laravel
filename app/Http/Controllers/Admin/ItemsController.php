<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Country;
use App\Models\Unit;
use App\Models\State;
use App\Models\Currency;
use App\Models\PaymentOption;
use App\Exports\ItemsExport;
use App\Imports\ItemsImport;
use App\Http\Requests\ItemsRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\FilesUploadTrait;
use App\Http\Traits\ClearCacheTrait; 
use Illuminate\Pagination\Paginator;

class ItemsController extends Controller 
{
    use FilesUploadTrait, ClearCacheTrait;

    public function index(){
        $countries = Country::all();
        return view('admin.items.index', compact(['countries']));
    } 

    public function getItemsAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $item_obj = new Item(); 

        $items_count = $item_obj->count();
        $items = $item_obj->orderBy('id','DESC')->with('category')
            ->with('supplier')->paginate($rows_numbers);
        
        return response()->json([
            'items' => $items,
            'pagination' => (string) $items->links('pagination::bootstrap-4'),
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

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $item_obj = Item::with('category')
        ->leftJoin('users', function($join) {
            $join->on('users.id', '=', 'items.user_id');
        })
        ->select('items.*');
        
        // filter by item status
        if($items_status == 'active'){
            $item_obj = $item_obj->where('items.status', 1);  
        } 
        elseif($items_status == 'pending'){
            $item_obj = $item_obj->where('items.status', 0)
                ->where('items.rejected', 0);
        }
        elseif($items_status == 'rejected'){
            $item_obj = $item_obj->where('items.status', 0)
                ->where('items.rejected',1);
        }
        elseif($items_status == 'home'){
            $item_obj = $item_obj->where('items.show_homepage',1);
        }
        elseif($items_status == 'featured'){
            $item_obj = $item_obj->where('items.featured',1);
        }
        elseif($items_status == 'no_image'){
            $item_obj = $item_obj->whereNotExists(function($query) {
                $query->select(DB::raw(1))
                ->from('items_files')
                ->whereRaw('items.id = items_files.sub_of');
            });
        }

        // filter by store status
        if($store_status == 'active_stores'){
            $item_obj = $item_obj->leftJoin('users_store', function($join) {
                $join->on('users_store.sub_of', '=', 'users.id');
            })->where('users_store.trash', 0);
        } 
        elseif($store_status == 'pending_stores'){
            $item_obj = $item_obj->leftJoin('users_store', function($join) {
                $join->on('users_store.sub_of', '=', 'users.id');
            })->where('users_store.trash', 1);
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
        $items = $item_obj->orderBy('items.id','desc')
            ->paginate($rows_numbers);

        
        return response()->json([
            'items' => $items,
            'pagination' => (string) $items->links('pagination::bootstrap-4'),
            'items_count' => $items_count
        ]);
    }

    // to get suppliers for create items
    public function getSuppliersData(Request $request){
        $results = Supplier::where('full_name', 'like', '%'. $request->term . '%')
        ->get();
        $i = 0;
        foreach ($results as $r) {
            $suppliers[$i]['id'] = $r['id'];
            $suppliers[$i]['value'] = str_replace("&#39;s", " ", html_entity_decode($r['full_name']));
            $suppliers[$i]['label'] = str_replace("&#39;s", " ", html_entity_decode($r['full_name']));
            $i++;
        }
        echo json_encode($suppliers);
    }

    public function create(){
        $categories = Category::all();
        $countries = Country::all(); 
        $units = Unit::all();
        $states = State::all();
        $paymentOptions = PaymentOption::all();
        $currencies = Currency::all();
        return view('admin.items.create', compact(
            ['categories','units','states','countries','paymentOptions','currencies']
        ));
    }

   
    public function store(ItemsRequest $request){
        $meta_keyword = '';
        foreach($request->meta_keyword as $keyword){
            $meta_keyword .= $keyword . ',';
        }

        $lastId = Item::orderBy('id','DESC')->first()->id;
        $slug = substr($request->title,0, 6) . '-' . $lastId + 1;

        // to be changed latter 
        // to upload default image file
        $default_image = '';
        if($request->has('default_image')){
            $image = $request->file('default_image');
            $image_name = time().'.'.$image->extension();
            $temp_dir = $image->getPathName();
            $default_image = $this->upload_image($image_name, $temp_dir, 'files');
        }
        //uploads/product/682526/pout-case-foundation_58262.jpeg 

        $item = new Item();
        $item->title = $request->title;
        $item->user_id = $request->user_id;
        $item->sub_of = $request->sub_of;
        $item->unit = $request->unit;
        $item->details = $request->details;
        $item->price = $request->price;
        $item->old_price = $request->old_price;
        $item->youtube_video = $request->youtube_video;
        $item->deliver_per = $request->deliver_per;
        $item->item_type = $request->item_type;
        $item->quantity = $request->quantity;
        $item->manufacture_country = $request->manufacture_country;
        $item->active = $request->active;
        $item->status = $request->status;
        $item->rejected = $request->rejected;
        $item->is_sold = $request->is_sold;
        $item->featured = $request->featured;
        $item->accept_offers = $request->accept_offers;
        $item->accept_min_offer = $request->accept_min_offer;
        $item->sort_order = $request->sort_order;
        $item->part_number = $request->part_number;
        $item->meta_description = $request->meta_description;
        $item->meta_keyword = $meta_keyword;
        $item->phone_count = $request->phone_count;
        $item->email_count = $request->email_count;
        $item->chat_count = $request->chat_count;
        $item->min_order = $request->min_order;
        $item->payment_option_ids = $request->payment_option_ids;
        $item->rating = $request->rating;
        $item->currency = $request->currency;
        $item->approved = $request->approved;
        $item->is_bulk = $request->is_bulk;
        $item->is_global = $request->is_global;
        $item->is_customized = $request->is_customized;
        $item->is_shipping = $request->is_shipping;
        $item->default_image = $default_image;
        $item->save();

        $message = 'Item hass been Saved successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();

    }

    public function show($id){
        $item = Item::findOrFail($id);
        return view('admin.items.show', compact(['item']));
    }

    public function edit($id){
        $item = Item::find($id);
        $categories = Category::all();
        $countries = Country::all();
        $units = Unit::all();
        $states = State::all();
        $paymentOptions = PaymentOption::all();
        $currencies = Currency::all();
        return view('admin.items.edit', compact(
            ['item', 'categories', 'countries', 
            'units', 'states', 'paymentOptions', 'currencies']
        ));
    }

    public function update(ItemsRequest $request){
        $item = Item::findOrFail($request->item_id);

        $meta_keyword = '';
        foreach($request->meta_keyword as $keyword){
            $meta_keyword .= $keyword . ',';
        }
        // to upload default image
        $default_image = '';
        if($request->has('default_image')){
            $image = $request->file('default_image');
            $image_name = time().'.'.$image->extension();
            $temp_dir = $image->getPathName();
            $default_image = $this->upload_image($image_name, $temp_dir, 'files');
        }else $default_image = $item->default_image;

        $item->title = $request->title;
        $item->user_id = $request->user_id;
        $item->sub_of = $request->sub_of;
        $item->unit = $request->unit;
        $item->details = $request->details;
        $item->price = $request->price;
        $item->old_price = $request->old_price;
        $item->youtube_video = $request->youtube_video;
        $item->deliver_per = $request->deliver_per;
        $item->item_type = $request->item_type;
        $item->quantity = $request->quantity;
        $item->manufacture_country = $request->manufacture_country;
        $item->part_number = $request->part_number;
        $item->active = $request->active;
        $item->status = $request->status;
        $item->rejected = $request->rejected;
        $item->is_sold = $request->is_sold;
        $item->featured = $request->featured;
        $item->accept_offers = $request->accept_offers;
        $item->accept_min_offer = $request->accept_min_offer;
        $item->sort_order = $request->sort_order;
        $item->meta_keyword = $meta_keyword;
        $item->meta_description = $request->meta_description;
        $item->phone_count = $request->phone_count;
        $item->email_count = $request->email_count;
        $item->chat_count = $request->chat_count;
        $item->min_order = $request->min_order;
        $item->payment_option_ids = $request->payment_option_ids;
        $item->default_image = $default_image;
        $item->rating = $request->rating;
        $item->currency = $request->currency;
        $item->approved = $request->approved;
        $item->is_bulk = $request->is_bulk;
        $item->is_global = $request->is_global;
        $item->is_customized = $request->is_customized;
        $item->is_shipping = $request->is_shipping;
        $item->save();
        
        // to clear the cache on abraa.com
        $this->clearAbraaCache("items");

        $message = 'Item hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }   

   
    public function destroy($id){
        Item::where('id',$id)->delete();
        $message = 'Item hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }


    // to handel some sort of actions  
    public function actions(Request $request){
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
        // to make selected items featured
        if($request->has('feature_selected_btn')){
            foreach($request->item_id as $id){
                $item = Item::find($id);
                $item->status = 1;
                $item->rejected = 0;
                $item->approved = 1;
                $item->featured = 1;
                $item->save();
            }
            $message = 'Items hass been featured successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
        else
        // to make selected items unfeatured
        if($request->has('unfeature_selected_btn')){
            foreach($request->item_id as $id){
                $item = Item::find($id);
                $item->featured = 0;
                $item->save();
            }
            $message = 'Items hass been un featured successfully';
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

    
    // import & export to excel 
    public function exportExcel() {
        return Excel::download(new ItemsExport, 'items.xlsx'); 
    }
    
    public function importView(){
        return view('admin.items.import_csv');    
    }

    // to get suppliers and categories for import the items
    public function getData(Request $request){
        if($request->is_category){
            $results = Category::where('en_title', 'like', '%'. $request->term . '%')
            ->orWhere('ar_title', 'like', '%'. $request->term . '%')
            ->orWhere('ar_title', 'like', '%'. $request->term . '%')
            ->orWhere('cn_title', 'like', '%'. $request->term . '%')
            ->orWhere('ru_title', 'like', '%'. $request->term . '%')
            ->orWhere('tr_title', 'like', '%'. $request->term . '%')
            ->orWhere('pr_title', 'like', '%'. $request->term . '%')->get();
            $i = 0;
            foreach ($results as $r) {
                $categories[$i]['id'] = $r['id'];
                $categories[$i]['value'] = str_replace("&#39;s", " ", html_entity_decode($r['en_title']));
                $categories[$i]['label'] = str_replace("&#39;s", " ", html_entity_decode($r['en_title']));
                $i++;
            }
            echo json_encode($categories);
        }else 
        if($request->is_supplier){
            $results = Supplier::where('full_name', 'like', '%'. $request->term . '%')
            ->get();
            $i = 0;
            foreach ($results as $r) {
                $suppliers[$i]['id'] = $r['id'];
                $suppliers[$i]['value'] = str_replace("&#39;s", " ", html_entity_decode($r['full_name']));
                $suppliers[$i]['label'] = str_replace("&#39;s", " ", html_entity_decode($r['full_name']));
                $i++;
            }
            echo json_encode($suppliers);
        } 
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
