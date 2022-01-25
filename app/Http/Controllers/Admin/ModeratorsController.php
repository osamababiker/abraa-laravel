<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Country;
use App\Exports\ModeratorsExport;
use App\Imports\ModeratorsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class ModeratorsController extends Controller
{
    
    public function index(){
        $moderators = Member::all();
        $countries = Country::all();
        return view('admin.moderators.index',compact(['moderators','countries']));
    }

    public function getModeratorsAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $moderator_obj = Member::where('user_type', 1)
        ->with('member_country');

        $moderators_count = $moderator_obj->count();
        $moderators = $moderator_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'moderators' => $moderators,
            'pagination' => (string) $moderators->links('pagination::bootstrap-4'),
            'moderators_count' => $moderators_count
        ]); 
    }

    public function filterModerators(Request $request){

        $moderator_name = $request->moderator_name;
        $countries = $request->countries;
        $rows_numbers = $request->rows_numbers; 

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $moderator_obj = Member::where('user_type', 1)
        ->with('member_country');

        if($moderator_name){
            $moderator_obj->where('full_name','like', '%' . $moderator_name . '%')
            ->orWhere('username', 'like', '%'. $moderator_name . '%');
        }

        if($countries){
            $moderator_obj->whereIn('country', $countries);
        }
 
        $moderators_count = $moderator_obj->count();
        $moderators = $moderator_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
   
        return response()->json([
            'moderators' => $moderators,
            'pagination' => (string) $moderators->links('pagination::bootstrap-4'),
            'moderators_count' => $moderators_count
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
        Member::where('id',$id)->delete();
        $message = 'moderator hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new ModeratorsExport, 'moderators.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new ModeratorsImport,request()->file('file'));
           
        return redirect()->back();
    }
}
