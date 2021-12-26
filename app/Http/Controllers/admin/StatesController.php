<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Country;
use App\Exports\StateExport;
use App\Imports\StateImport;
use Maatwebsite\Excel\Facades\Excel;

class StatesController extends Controller
{
  
    public function index()
    {
        $countries = Country::all();
        return view('admin.states.index', compact(['countries']));
    } 

    public function getstatesAsJson(Request $request)
    {
        $rows_numbers = $request->rows_numbers;

        $state_obj = new State();

        $states_count = $state_obj->count();
        $states = $state_obj->limit($rows_numbers)
            ->with('country')->orderBy('id','desc')->get();
        
        return response()->json([
            'states' => $states,
            'states_count' => $states_count
        ]); 
    }


    public function filterstates(Request $request)
    {
        $rows_numbers = $request->rows_numbers; 
        $state_name = $request->state_name;
        $state_countries = $request->state_countries;
        $state_obj = State::where('deleted_at',null);
        
        if($state_name){
            $state_obj->where('en_name', 'like', '%'. $state_name .'%')
                ->orWhere('ar_name', 'like', '%'. $state_name .'%');
        }

        if($state_countries){
            $state_obj->whereIn('sub_of', $state_countries);
        }

        $states_count = $state_obj->count();
        $states = $state_obj->limit($rows_numbers)
            ->with('country')->orderBy('id','desc')->get();
   
        return response()->json([
            'states' => $states,
            'states_count' => $states_count
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
        State::where('id',$id)->delete();
        $message = 'State hass been Archived successfully';
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // import & export to excel
    public function exportExcel() 
    {
        return Excel::download(new StateExport, 'states.xlsx'); 
    }
   
    public function importExcel() 
    {
        Excel::import(new StateImport,request()->file('file'));
           
        return redirect()->back();
    }
}
