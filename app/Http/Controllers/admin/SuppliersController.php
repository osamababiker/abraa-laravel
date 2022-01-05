<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Item;
use App\Models\Country;
use App\Exports\SuppliersExport;
use App\Imports\SuppliersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\MailerTrait;

class SuppliersController extends Controller
{

    use MailerTrait; 
 
    public function index(){
        $countries = Country::all();
        return view('admin.suppliers.index', compact(['countries']));
    } 

    public function getSuppliersAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;

        $suppliers_obj = Supplier::whereIn('member_type',[1,3])
            ->where('user_type',0)->orderBy('id','desc'); 
            
        $suppliers_count = $suppliers_obj->count();
        $suppliers = $suppliers_obj->limit($rows_numbers)->with('supplier_country')->get();
        
        return response()->json([
            'suppliers' => $suppliers,
            'suppliers_count' => $suppliers_count
        ]);
    }

    public function filterSuppliers(Request $request){

        $countries = $request->countries;
        $keywords = $request->keywords;
        $rows_numbers = $request->rows_numbers; 
        $supplier_type = $request->supplier_type;
        $product_title = $request->product_title;
        $supplier_name = $request->supplier_name;

        $suppliers_obj = Supplier::whereIn('member_type',[1,3])
            ->where('user_type',0); 

        if($supplier_name){
            $suppliers_obj->where('full_name', $supplier_name);
        }

        if($countries){
            $suppliers_obj->whereIn('country', $countries);
        }
        
        if($keywords){
            $suppliers_obj->where('interested_keywords', 'like', '%'. $keywords[0] .'%');
            for($i = 1; $i < count($keywords); $i++) {
               $suppliers_obj->orWhere('interested_keywords', 'like', '%'. $keywords[$i] .'%');      
            }
        }

        if($product_title){
            foreach($product_title as $title){
                $suppliers_obj->leftJoin('items', function($join) {
                    $join->on('users.id', '=', 'items.user_id');
                    })
                    ->where('title','like', '%' . $title . '%');
            }
        }
        
        if($supplier_type == 'organic'){
            $suppliers_obj->where('is_organic',1);
        }else if($supplier_type == 'no_keywords'){
            $suppliers_obj->where('interested_keywords','');
        }

        $suppliers_count = $suppliers_obj->count();
        $suppliers = $suppliers_obj->limit($rows_numbers)->with('supplier_country')->get();
        
        return response()->json([
            'suppliers' => $suppliers,
            'suppliers_count' => $suppliers_count
        ]);
    }

    /**********************************************/
    // to get supplier items
    public function supplierItems($supplier_id){

        $supplier = Supplier::find($supplier_id);
        $countries = Country::get();
        return view('admin.suppliers.items.index', compact(['supplier','countries']));
    }

    public function getSuppliersItemsAsJson(Request $request,$supplier_id){

        $rows_numbers = $request->rows_numbers; 
        $items_obj = Item::where('user_id', $supplier_id)
            ->leftJoin('users', 'users.id', '=', 'items.user_id')
            ->leftJoin('users_store', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0);

        $items = $items_obj->limit($rows_numbers)->get();
        $items_counter = $items_obj->count();
        return response()->json([
            'items' => $items,
            'items_counter' => $items_counter
        ]);
    }
 
    public function filterSuppliersItems(Request $request, $supplier_id){

        $product_name = $request->product_name;
        $manufacture_country = $request->manufacture_country;
        $rows_numbers = $request->rows_numbers; 
        $meta_keyword = $request->meta_keyword; 
        $items_status = $request->items_status;

        $item_obj = Item::where('user_id', $supplier_id)
            ->leftJoin('users', 'users.id', '=', 'items.user_id')
            ->leftJoin('users_store', 'users.id', '=', 'users_store.sub_of')
            ->where('users_store.trash',0)
            ->where('users_store.rejected',0);

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
            $item_obj = $item_obj->where('items.rejected',1);
        }
        else {
            $item_obj = $item_obj->where('items.active',1)
                ->where('items.status',1)
                ->where('items.rejected',0)
                ->where('items.approved',1); 
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
        $items = $item_obj->limit($rows_numbers)->with('category')
            ->orderBy('items.id','desc')->get();

        
        return response()->json([
            'items' => $items,
            'items_count' => $items_count
        ]);
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'business_name' => 'required',
            'business_keywords' => 'required',
            'primary_name' => 'required',
            'primary_m_phone' => 'required',
            'position' => 'required',
            'primary_whatsapp' => 'required',
        ]);

        $supplier = new Supplier();
    }   

    // to handel some sort of actions , like delete multiple ,
    //  or send email , sms to multiple 
    public function actions(Request $request)
    {
        if($request->has('delete_selected_btn')){
            $supplier_id = $request->supplier_id;
            if($request->all_colums){
                Supplier::delete();
            }
            elseif($supplier_id){
                foreach($supplier_id as $id){
                    Supplier::where('id',$id)->delete();
                }
            }
            $message = 'suppliers has been archived successfully';
            session()->flash('feedback', $message);
            return redirect()->back();
        }

        if($request->has('send_message_btn')){
            $suppliers_ids = $request->suppliers_ids;
            $subject = $request->subject;
            $message = $request->message;
            foreach($suppliers_ids as $supplier_id){
                $supplier = Supplier::find($supplier_id);
                $email_content = $this->send_custom_email_to_suppliers($supplier, $message);
                $email_templete = $this->getEmailTemplete($email_content);
                $this->sendEmail($email_templete, $supplier->email, $subject);
            }

            return response()->json([
                'message' => 'Email has been send successfuly'
            ],200);
        }
        
    }


 
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return view('admin.suppliers.show', compact(['supplier']));
    }

 
    public function edit($id){
        $supplier = Supplier::find($id);
        $countries = Country::all();
        return view('admin.suppliers.edit', compact(['supplier','countries']));
    }

   
    public function update(Request $request)
    {
        $supplier = Supplier::find($request->supplier_id);

        // to update primary contact info
        $interested_keywords = '';
        foreach($request->interested_keywords as $keywords){
            $interested_keywords .= ',' .$keywords;
        }
        $supplier->business_name = $request->business_name;
        $supplier->country = $request->country;
        $supplier->interested_keywords = $interested_keywords;
        $supplier->full_name = $request->primary_name;
        $supplier->email = $request->primary_email;
        $supplier->phone = $request->primary_m_phone;
        $supplier->primary_position = $request->primary_position;
        $supplier->primary_whatsapp = $request->primary_whatsapp;
        $supplier->primary_line_number = $request->primary_line_number;

        // to update secoundry contact info
        $supplier->secondary_contact_person = $request->secondary_name;
        $supplier->secondary_email = $request->secondary_email;
        $supplier->secondary_phone = $request->secondary_m_phone;
        $supplier->secondary_position = $request->secondary_position;
        $supplier->secondary_whatsapp = $request->secondary_whatsapp;
        $supplier->secondary_line_number = $request->secondary_line_number;

        $supplier->save();
        $message = "supplier has been updated successfully";
        session()->flash('feedback', $message);
        session()->flash('feedback_title', 'updated successfully');
        session()->flash('success', 'true');
        return redirect()->back();
    }

 
    public function destroy($id){
        Supplier::where('id',$id)->delete();
        $message = 'Supplier hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }


    // import & export to excel
    public function exportExcel() {
        return Excel::download(new SuppliersExport, 'suppliers.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new SuppliersImport,request()->file('file'));
           
        return redirect()->back();
    }

    
}
