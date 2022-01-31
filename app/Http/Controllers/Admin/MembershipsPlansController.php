<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use App\Models\Country;
use App\Http\Requests\MembershipPlansRequest;
use App\Exports\MembershipPlanExport;
use App\Imports\MembershipPlanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class MembershipsPlansController extends Controller
{
   
    public function index() {
        return view('admin.memberships.plans.index'); 
    } 

    public function getMembershipsPlansAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $plan_obj = new MembershipPlan();

        $membershipsPlans_count = $plan_obj->count();
        $membershipsPlans = $plan_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'membershipsPlans' => $membershipsPlans,
            'pagination' => (string) $membershipsPlans->links('pagination::bootstrap-4'),
            'membershipsPlans_count' => $membershipsPlans_count
        ]); 
    }

    public function filterMembershipsPlans(Request $request){
        $memberships_plan_name = $request->memberships_plan_name;
        $rows_numbers = $request->rows_numbers; 

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $plan_obj =  MembershipPlan::where('deleted_at',null);
        if($memberships_plan_name){
            $plan_obj->where('name','like', '%' . $memberships_plan_name . '%');
        }
            
        $membershipsPlans_count = $plan_obj->count();
        $membershipsPlans = $plan_obj->orderBy('id','desc')
        ->paginate($rows_numbers);

        return response()->json([
            'membershipsPlans' => $membershipsPlans,
            'pagination' => (string) $membershipsPlans->links('pagination::bootstrap-4'),
            'membershipsPlans_count' => $membershipsPlans_count
        ]);
    }

  
    public function create(){
        $countries = Country::all();
        return view('admin.memberships.plans.create',compact(['countries']));
    }

    public function store(MembershipPlansRequest $request){
        $plan_obj = new MembershipPlan();
        $plan_obj->code = $request->code;
        $plan_obj->name = $request->name;
        $plan_obj->short_description = $request->short_description;
        $plan_obj->package_price = $request->package_price;
        $plan_obj->duration = $request->duration;
        $plan_obj->sales = $request->sales;
        $plan_obj->created_on = date('Y-m-d H:i:s');
        $plan_obj->country_code = $request->country_code;
        $plan_obj->save();

        $message = 'Plan has been successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Added successfully');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function show($id){
        $plan = MembershipPlan::findOrFail($id);
        return view('admin.memberships.plans.show',compact(['plan']));
    }

    public function edit($id){
        $plan = MembershipPlan::findOrFail($id);
        $countries = Country::all();
        return view('admin.memberships.plans.edit',compact(['plan','countries']));
    }

    public function update(MembershipPlansRequest $request){
        $plan_obj = MembershipPlan::findOrFail($request->plan_id);
        $plan_obj->code = $request->code;
        $plan_obj->name = $request->name;
        $plan_obj->short_description = $request->short_description;
        $plan_obj->package_price = $request->package_price;
        $plan_obj->duration = $request->duration;
        $plan_obj->sales = $request->sales;
        $plan_obj->modified_on = date('Y-m-d H:i:s');
        $plan_obj->country_code = $request->country_code;
        $plan_obj->save();

        $message = 'Plan has been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Updated successfully');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function destroy($id){
        MembershipPlan::where('id',$id)->delete();
        $message = 'Plan hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

     // to handel plans table actions
     public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->plan_id as $id){
                MembershipPlan::where('id',$id)->delete();
            }
            $message = 'paln hass been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }
    
    // import & export to excel
    public function exportExcel() {
        return Excel::download(new MembershipPlanExport, 'membershipsPlans.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new MembershipPlanImport,request()->file('file'));
        return redirect()->back();
    }
}
