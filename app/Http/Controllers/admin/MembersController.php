<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\UserActivity;
use App\Models\Country;
use App\Exports\MemberExport;
use App\Imports\MemberImport;
use Maatwebsite\Excel\Facades\Excel;

class MembersController extends Controller
{
    public function index() {
        $countries = Country::all();
        return view('admin.members.index', compact(['countries'])); 
    } 
    
    public function getMembersAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $member_obj = new UserActivity();

        $members_count = $member_obj->count();
        $members = $member_obj->limit($rows_numbers)
            ->orderBy('id','desc')->with('user_country')
            ->with('user')->get();
        
        return response()->json([
            'members' => $members,
            'members_count' => $members_count
        ]); 
    } 

    public function filterMembers(Request $request){
        $member_name = $request->member_name;
        $countries = $request->countries;
        $rows_numbers = $request->rows_numbers; 

        $member_obj =  UserActivity::leftJoin('users', 'users.id', 'user_activity.user_id');
       
        if($member_name){
            $member_obj->where('users.full_name','like', '%' . $member_name . '%');
        }
             
        if($countries){
            $member_obj->whereIn('users.country', $countries);
        }

        $members_count = $member_obj->count();
        $members = $member_obj->limit($rows_numbers)
            ->orderBy('user_activity.id','desc')->with('user_country')
            ->with('user')->get();

   
        return response()->json([
            'members' => $members,
            'members_count' => $members_count
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
        Member::where('id',$id)->delete();
        $message = 'Member hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    
    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new MemberExport, 'members.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new MemberImport,request()->file('file'));
           
        return redirect()->back();
    }
}
