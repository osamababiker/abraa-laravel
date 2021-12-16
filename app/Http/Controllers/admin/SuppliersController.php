<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SuppliersController extends Controller
{
 
    public function index()
    {
        $suppliers = Supplier::whereIn('member_type',[1,3])
            ->where('user_type',0)->orderBy('id','desc')->paginate(10); 
            
        $suppliers_count = Supplier::whereIn('member_type',[1,3])
        ->where('user_type',0)->orderBy('id','desc')->count();

        return view('admin.suppliers.index', compact(['suppliers','suppliers_count']));
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

        $supplier_id = $request->supplier_id;
        if($request->all_colums){
            dd($request->all_colums);
        }
        elseif($supplier_id){
            foreach($supplier_id as $id){
                Supplier::where('id',$id)->delete();
            }
        }
        
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
        Supplier::where('id',$id)->delete();

        $message = 'Supplier hass been deleted successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
}
