<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MembershipTransaction;
use App\Models\MembershipPlan;
use App\Exports\MembershipTransactionExport;
use App\Imports\MembershipTransactionImport;
use App\Http\Requests\MembershipTransactionsRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class MembershipsTransactionsController extends Controller
{

    public function index() {
        return view('admin.memberships.transactions.index'); 
    } 

    public function getMembershipsTransactionsAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $transaction_obj = new MembershipTransaction();

        $membershipsTransactions_count = $transaction_obj->count();
        $membershipsTransactions = $transaction_obj->with('user')->with('plan')
        ->orderBy('id','desc')->paginate($rows_numbers);
        
        return response()->json([
            'membershipsTransactions' => $membershipsTransactions,
            'pagination' => (string) $membershipsTransactions->links('pagination::bootstrap-4'),
            'membershipsTransactions_count' => $membershipsTransactions_count
        ]); 
    }

    public function filterMembershipsTransactions(Request $request){
        $subscription_status = $request->subscription_status;
        $payment_status = $request->payment_status;
        $rows_numbers = $request->rows_numbers; 

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $transaction_obj =  MembershipTransaction::where('deleted_at', null);
        if($subscription_status){
            $transaction_obj->where('subscription_status', $subscription_status );
        }

        if($payment_status){
            $transaction_obj->where('payment_status', $payment_status );
        }
            
        $membershipsTransactions_count = $transaction_obj->count();
        $membershipsTransactions = $transaction_obj->with('user')->with('plan')
        ->orderBy('id','desc')->paginate($rows_numbers);

        return response()->json([
            'membershipsTransactions' => $membershipsTransactions,
            'pagination' => (string) $membershipsTransactions->links('pagination::bootstrap-4'),
            'membershipsTransactions_count' => $membershipsTransactions_count
        ]);
    }

    // to search users for create page
    public function searchUsers(Request $request){
        $results = Member::where('full_name', 'like', '%'. $request->term . '%')->get();
            $i = 0;
            foreach ($results as $r) {
                $users[$i]['id'] = $r['id'];
                $users[$i]['value'] = str_replace("&#39;s", " ", html_entity_decode($r['full_name']));
                $users[$i]['label'] = str_replace("&#39;s", " ", html_entity_decode($r['full_name']));
                $i++;
            }
            echo json_encode($users);
    }

    public function create(){
        $plans = MembershipPlan::all();
        return view('admin.memberships.transactions.create',compact(['plans']));
    }

    public function store(MembershipTransactionsRequest $request){
        $transaction_obj = new MembershipTransaction();
        $transaction_obj->user_id = $request->user_id;
        $transaction_obj->plan_id = $request->plan_id;
        $transaction_obj->transaction_id = $request->transaction_id;
        $transaction_obj->lead_id = $request->lead_id;
        $transaction_obj->total_amount = $request->total_amount;
        $transaction_obj->payment_status = $request->payment_status;
        $transaction_obj->subscription_status = $request->subscription_status;
        $transaction_obj->start_date = $request->start_date;
        $transaction_obj->end_date = $request->end_date;
        $transaction_obj->payment_date = $request->payment_date;
        $transaction_obj->payment_link = $request->payment_link;
        $transaction_obj->is_receipt_uploaded = 0;
        $transaction_obj->save();

        $message = 'Transaction has been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Added successfully');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function show($id){
        $transaction = MembershipTransaction::findOrFail($id);
        return view('admin.memberships.transactions.show',compact(['transaction']));
    }

    public function edit($id){
        $transaction = MembershipTransaction::findOrFail($id);
        $plans = MembershipPlan::all();
        return view('admin.memberships.transactions.edit',compact(['transaction','plans']));
    }

    public function update(MembershipTransactionsRequest $request){
        $transaction_obj = MembershipTransaction::findOrFail($request->membership_transaction_id);
        $transaction_obj->user_id = $request->user_id;
        $transaction_obj->plan_id = $request->plan_id;
        $transaction_obj->transaction_id = $request->transaction_id;
        $transaction_obj->lead_id = $request->lead_id;
        $transaction_obj->total_amount = $request->total_amount;
        $transaction_obj->payment_status = $request->payment_status;
        $transaction_obj->subscription_status = $request->subscription_status;
        $transaction_obj->start_date = $request->start_date;
        $transaction_obj->end_date = $request->end_date;
        $transaction_obj->payment_date = $request->payment_date;
        $transaction_obj->payment_link = $request->payment_link;
        $transaction_obj->is_receipt_uploaded = 0;
        $transaction_obj->save();

        $message = 'Transaction has been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Updated successfully');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function destroy($id){
        MembershipTransaction::where('id',$id)->delete();
        $message = 'transaction hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel table actions 
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->transaction_id as $id){
                $transaction_obj = MembershipTransaction::find($id);
                $transaction_obj->delete();
                $message = 'Transaction has been deleted successfully';
                session()->flash('success', 'true');
                session()->flash('feedback_title', 'Success');
                session()->flash('feedback', $message);
                return redirect()->back();
            }
        }
    }

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new MembershipTransactionExport, 'membershipsTransactions.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new MembershipTransactionImport,request()->file('file'));
        return redirect()->back();
    }
}
