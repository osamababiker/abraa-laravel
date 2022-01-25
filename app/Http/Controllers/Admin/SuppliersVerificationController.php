<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierVerification;
use App\Models\Supplier;
use App\Http\Requests\SuppliersVerificationRequest;
use App\Exports\SuppliersVerificationExport;
use App\Imports\SuppliersVerificationImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class SuppliersVerificationController extends Controller
{
   
    public function index(){
        return view('admin.general.suppliers_verification.index');
    } 

    public function getVerificationsAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;

        $verification_obj = new SupplierVerification();
        $verifications_count = $verification_obj->count();
        $verifications = $verification_obj->orderBy('id','desc')
        ->with('supplier')->paginate($rows_numbers);
        
        return response()->json([
            'verifications' => $verifications,
            'pagination' => (string) $verifications->links('pagination::bootstrap-4'),
            'verifications_count' => $verifications_count
        ]); 
    }

    public function filterVerifications(Request $request){
        $rows_numbers = $request->rows_numbers; 
        $supplier_name = $request->supplier;
        
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $verification_obj = SupplierVerification::leftJoin('users', function($join) {
            $join->on('users.id', '=', 'supplier_verification.user_id');
        })->select('supplier_verification.*');

        if($supplier_name){
            $verification_obj->where('users.full_name', 'like' , '%'. $supplier_name . '%');
        }

        $verifications_count = $verification_obj->count();
        $verifications = $verification_obj->orderBy('id','desc')
        ->with('supplier')->paginate($rows_numbers);
   
        return response()->json([
            'verifications' => $verifications,
            'pagination' => (string) $verifications->links('pagination::bootstrap-4'),
            'verifications_count' => $verifications_count
        ]);
    }

    // to get supplier details 
    public function getsupplierDetails(Request $request){
        $results = Supplier::whereIn('member_type',[1,3])
        ->where('full_name', 'like', '%'. $request->term . '%')->get();
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
        return view('admin.general.suppliers_verification.create');
    }

    public function store(SuppliersVerificationRequest $request){
        $verification_obj = new SupplierVerification();
        $verification_obj->user_id = $request->user_id;
        $verification_obj->document_uploaded = $request->document_uploaded;
        $verification_obj->about_company = $request->about_company;
        $verification_obj->youtube_link = $request->youtube_link;
        $verification_obj->paid = $request->paid;
        $verification_obj->date_time = date('Y-m-d H:i:s');
        $verification_obj->save();

        $message = 'Verification hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Updated Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }
 
    public function show($id){
        $verification = SupplierVerification::findOrFail($id);
        return view('admin.general.suppliers_verification.show', compact(['verification']));
    }

    public function edit($id){
        $verification = SupplierVerification::findOrFail($id);
        return view('admin.general.suppliers_verification.edit', compact(['verification']));
    }

    public function update(SuppliersVerificationRequest $request){
        $verification_obj = SupplierVerification::findOrFail($request->verification_id);
        $verification_obj->user_id = $request->user_id;
        $verification_obj->document_uploaded = $request->document_uploaded;
        $verification_obj->about_company = $request->about_company;
        $verification_obj->youtube_link = $request->youtube_link;
        $verification_obj->paid = $request->paid;
        $verification_obj->date_time = date('Y-m-d H:i:s');
        $verification_obj->save();

        $message = 'Verification hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Updated Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function destroy($id){
        SupplierVerification::where('id',$id)->delete();
        $message = 'verification hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel verification table actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->verification_id as $id){
                SupplierVerification::where('id',$id)->delete();
            }
            $message = 'verifications hass been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new SuppliersVerificationExport, 'verifications.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new SuppliersVerificationImport,request()->file('file')); 
        return redirect()->back();
    }
}
