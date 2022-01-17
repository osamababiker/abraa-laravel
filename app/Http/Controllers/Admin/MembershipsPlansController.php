<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use App\Exports\MembershipPlanExport;
use App\Imports\MembershipPlanImport;
use Maatwebsite\Excel\Facades\Excel;


class MembershipsPlansController extends Controller
{
   
    public function index() 
    {
        return view('admin.memberships.plans.index'); 
    } 

    public function getMembershipsPlansAsJson(Request $request){

        $rows_numbers = $request->rows_numbers;
        $plan_obj = new MembershipPlan();

        $membershipsPlans_count = $plan_obj->count();
        $membershipsPlans = $plan_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();
        
        return response()->json([
            'membershipsPlans' => $membershipsPlans,
            'membershipsPlans_count' => $membershipsPlans_count
        ]); 
    }

    public function filterMembershipsPlans(Request $request){

        
        $memberships_plan_name = $request->memberships_plan_name;
        $rows_numbers = $request->rows_numbers; 

        $plan_obj =  MembershipPlan::where('deleted_at',null);

        if($memberships_plan_name){
            $plan_obj->where('name','like', '%' . $memberships_plan_name . '%');
        }
            
        $membershipsPlans_count = $plan_obj->count();
        $membershipsPlans = $plan_obj->limit($rows_numbers)
            ->orderBy('id','desc')->get();

   
        return response()->json([
            'membershipsPlans' => $membershipsPlans,
            'membershipsPlans_count' => $membershipsPlans_count
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
        MembershipPlan::where('id',$id)->delete();
        $message = 'Plan hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new MembershipPlanExport, 'membershipsPlans.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new MembershipPlanImport,request()->file('file'));
           
        return redirect()->back();
    }
}
