<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipTransaction;
use App\Exports\MembershipTransactionExport;
use App\Imports\MembershipTransactionImport;
use Maatwebsite\Excel\Facades\Excel;

class MembershipsTransactionsController extends Controller
{

    public function index() 
    {
        return view('admin.memberships.transactions.index'); 
    } 

    public function getMembershipsTransactionsAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $transaction_obj = new MembershipTransaction();

        $membershipsTransactions_count = $transaction_obj->count();
        $membershipsTransactions = $transaction_obj->limit($rows_numbers)
            ->with('user')->with('plan')->orderBy('id','desc')->get();
        
        return response()->json([
            'membershipsTransactions' => $membershipsTransactions,
            'membershipsTransactions_count' => $membershipsTransactions_count
        ]); 
    }

    public function filterMembershipsTransactions(Request $request){

        $subscription_status = $request->subscription_status;
        $payment_status = $request->payment_status;
        $rows_numbers = $request->rows_numbers; 

        $transaction_obj =  MembershipTransaction::where('deleted_at', null);

        if($subscription_status){
            $transaction_obj->where('subscription_status', $subscription_status );
        }

        if($payment_status){
            $transaction_obj->where('payment_status', $payment_status );
        }
            
        $membershipsTransactions_count = $transaction_obj->count();
        $membershipsTransactions = $transaction_obj->limit($rows_numbers)
            ->with('user')->with('plan')->orderBy('id','desc')->get();

   
        return response()->json([
            'membershipsTransactions' => $membershipsTransactions,
            'membershipsTransactions_count' => $membershipsTransactions_count
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
        MembershipTransaction::where('id',$id)->delete();
        $message = 'transaction hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new MembershipTransactionExport, 'membershipsTransactions.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new MembershipTransactionImport,request()->file('file'));
           
        return redirect()->back();
    }
}
