<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
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
        //
    }

 
    public function edit($id){
        $supplier = Supplier::find($id);
        return view('admin.suppliers.edit', compact(['supplier']));
    }

   
    public function update(Request $request, $id)
    {
        //
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
