<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StatesRequest;
use App\Models\State;
use App\Models\Country;
use App\Exports\StateExport;
use App\Imports\StateImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class StatesController extends Controller
{
  
    public function index(){
        $countries = Country::all();
        return view('admin.states.index', compact(['countries']));
    } 

    public function getstatesAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $state_obj = new State();

        $states_count = $state_obj->count();
        $states = $state_obj->with('country')->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'states' => $states,
            'pagination' => (string) $states->links('pagination::bootstrap-4'),
            'states_count' => $states_count
        ]); 
    }


    public function filterstates(Request $request){
        $rows_numbers = $request->rows_numbers; 
        $state_name = $request->state_name;
        $state_countries = $request->state_countries;
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $state_obj = State::where('deleted_at',null);
        if($state_name){
            $state_obj->where('en_name', 'like', '%'. $state_name .'%')
            ->orWhere('ar_name', 'like', '%'. $state_name .'%');
        }

        if($state_countries){
            $state_obj->whereIn('sub_of', $state_countries);
        }

        $states_count = $state_obj->count();
        $states = $state_obj->with('country')->orderBy('id','desc')
        ->paginate($rows_numbers);
   
        return response()->json([
            'states' => $states,
            'pagination' => (string) $states->links('pagination::bootstrap-4'),
            'states_count' => $states_count
        ]);
    }

  
    public function create(){
        $countries = Country::all();
        return view('admin.states.create', compact(['countries']));
    }

  
    public function store(StatesRequest $request){
        $state = new State();
        $state->capital = $request->capital;
        $state->sub_of = $request->sub_of;
        $state->ar_name = $request->ar_name;
        $state->en_name = $request->en_name;
        $state->tr_name = $request->tr_name;
        $state->ru_name = $request->ru_name;
        $state->save();

        $message = 'States hass been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }
   
    public function show($id){
        $state = State::find($id);
        return view('admin.states.show', compact(['state']));
    }

    public function edit($id){
        $state = State::find($id);
        $countries = Country::all();
        return view('admin.states.edit', compact(['state','countries']));
    }

    public function update(Request $request){
        $state = State::find($request->state_id);
        $state->capital = $request->capital;
        $state->sub_of = $request->sub_of;
        $state->ar_name = $request->ar_name;
        $state->en_name = $request->en_name;
        $state->tr_name = $request->tr_name;
        $state->ru_name = $request->ru_name;
        $state->save();

        $message = 'States hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function destroy($id){
        State::where('id',$id)->delete();
        $message = 'States hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel actions in states table
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->state_id as $id){
                State::where('id',$id)->delete();
            }
            $message = 'States hass been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new StateExport, 'states.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new StateImport,request()->file('file'));
        return redirect()->back();
    }
}
