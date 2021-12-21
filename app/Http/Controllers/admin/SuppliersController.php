<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Country;
use App\Exports\SuppliersExport;
use App\Imports\SuppliersImport;
use Maatwebsite\Excel\Facades\Excel;

class SuppliersController extends Controller
{
 
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
        $level = $request->level;
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
            foreach($keywords as $word){
                $suppliers_obj->where('interested_keywords','like', '%' . $word . '%');
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
            
        $suppliers_count = $suppliers_obj->count();
        $suppliers = $suppliers_obj->limit($rows_numbers)->with('supplier_country')->get();
        
        return response()->json([
            'suppliers' => $suppliers,
            'suppliers_count' => $suppliers_count
        ]);
    }

    // to get all organic suppliers 
    public function organic_suppliers()
    {
        $suppliers = Supplier::whereIn('member_type',[1,3])
            ->where('user_type',0)->orderBy('id','desc')->where('is_organic',1)->paginate(10); 
            
        $suppliers_count = Supplier::whereIn('member_type',[1,3])
            ->where('user_type',0)->orderBy('id','desc')->where('is_organic',1)->count();

        return view('admin.suppliers.organic', compact(['suppliers','suppliers_count']));   
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
        $message = 'Supplier hass been deleted successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }


    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new SuppliersExport, 'suppliers.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new SuppliersImport,request()->file('file'));
           
        return redirect()->back();
    }

    
}
