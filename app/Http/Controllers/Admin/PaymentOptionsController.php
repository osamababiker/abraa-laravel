<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentOption;
use App\Exports\PaymentOptionExport;
use App\Imports\PaymentOptionImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class PaymentOptionsController extends Controller
{
  
    public function index(){
        return view('admin.payment.options.index');
    } 

    public function getpaymentOptionsAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $paymentOption_obj = new PaymentOption();

        $paymentOptions_count = $paymentOption_obj->count();
        $paymentOptions = $paymentOption_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'paymentOptions' => $paymentOptions,
            'pagination' => (string) $paymentOptions->links('pagination::bootstrap-4'),
            'paymentOptions_count' => $paymentOptions_count
        ]); 
    }


    public function filterpaymentOptions(Request $request){
        $rows_numbers = $request->rows_numbers; 
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $paymentOption_obj = PaymentOption::where('deleted_at',null);
        $paymentOptions_count = $paymentOption_obj->count();
        $paymentOptions = $paymentOption_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
   
        return response()->json([
            'paymentOptions' => $paymentOptions,
            'pagination' => (string) $paymentOptions->links('pagination::bootstrap-4'),
            'paymentOptions_count' => $paymentOptions_count
        ]);
    }

   
    public function create(){
        //
    }

    public function store(Request $request){
        //
    }
   
    public function show($id){
        //
    }
   
    public function edit($id){
        //
    }
   
    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        PaymentOption::where('id',$id)->delete();
        $message = 'paymentOption hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new PaymentOptionExport, 'payment_options.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new PaymentOptionImport,request()->file('file'));
        return redirect()->back();
    }
}
