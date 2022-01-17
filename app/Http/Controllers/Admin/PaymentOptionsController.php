<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentOption;
use App\Exports\PaymentOptionExport;
use App\Imports\PaymentOptionImport;
use Maatwebsite\Excel\Facades\Excel;

class PaymentOptionsController extends Controller
{
  
    public function index()
    {
        return view('admin.payment.options.index');
    } 

    public function getpaymentOptionsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;

        $paymentOption_obj = new PaymentOption();

        $paymentOptions_count = $paymentOption_obj->count();
        $paymentOptions = $paymentOption_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();
        
        return response()->json([
            'paymentOptions' => $paymentOptions,
            'paymentOptions_count' => $paymentOptions_count
        ]); 
    }


    public function filterpaymentOptions(Request $request){

        $rows_numbers = $request->rows_numbers; 

        $paymentOption_obj = PaymentOption::where('deleted_at',null);

        $paymentOptions_count = $paymentOption_obj->count();
        $paymentOptions = $paymentOption_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();
   
        return response()->json([
            'paymentOptions' => $paymentOptions,
            'paymentOptions_count' => $paymentOptions_count
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
        PaymentOption::where('id',$id)->delete();
        $message = 'paymentOption hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new PaymentOptionExport, 'payment_options.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new PaymentOptionImport,request()->file('file'));
           
        return redirect()->back();
    }
}
