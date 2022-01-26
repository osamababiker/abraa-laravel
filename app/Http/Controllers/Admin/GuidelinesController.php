<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guideline;
use App\Models\GuidelineType;
use App\Http\Requests\GuidelinesRequest;
use Illuminate\Pagination\Paginator;

class GuidelinesController extends Controller
{
    
    public function index(){
        return view('admin.guidelines.index');
    } 

    public function getGuidelinesAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $guideline_obj = new Guideline();

        $guidelines_count = $guideline_obj->count();
        $guidelines = $guideline_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'guidelines' => $guidelines,
            'pagination' => (string) $guidelines->links('pagination::bootstrap-4'),
            'guidelines_count' => $guidelines_count
        ]); 
    }

    public function filterGuidelines(Request $request){
        $rows_numbers = $request->rows_numbers; 
        $title = $request->title;
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        
        if($title){
            $guideline_obj = Guideline::where('en_title', 'like', '%'. $title . '%')
            ->orWhere('ar_title', 'like', '%'. $title . '%');
        }else $guideline_obj = new Guideline();

        $guidelines_count = $guideline_obj->count();
        $guidelines = $guideline_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
   
        return response()->json([
            'guidelines' => $guidelines,
            'pagination' => (string) $guidelines->links('pagination::bootstrap-4'),
            'guidelines_count' => $guidelines_count
        ]);
    }

    public function create(){
        $guideline_types = GuidelineType::all();
        return view('admin.guidelines.create', compact(['guideline_types']));
    }

    public function store(GuidelinesRequest $request){
        $guideline_obj = new Guideline();
        $guideline_obj->guideline_type = $request->guideline_type;
        $guideline_obj->en_title = $request->en_title;
        $guideline_obj->ar_title = $request->ar_title;
        $guideline_obj->cn_title = $request->cn_title;
        $guideline_obj->ru_title = $request->ru_title;
        $guideline_obj->tr_title = $request->tr_title;
        $guideline_obj->pr_title = $request->pr_title;
        $guideline_obj->en_content = $request->en_content;
        $guideline_obj->ar_content = $request->ar_content;
        $guideline_obj->cn_content = $request->cn_content;
        $guideline_obj->ru_content = $request->ru_content;
        $guideline_obj->tr_content = $request->tr_content;
        $guideline_obj->pr_content = $request->pr_content;
        $guideline_obj->active = $request->active;
        $guideline_obj->added_by = Auth::user()->id;
        $guideline_obj->date_added = date('Y-m-d H:i:s');
        $guideline_obj->save();

        $message = 'Guide line hass been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Added successfull');
        session()->flash('feedback', $message);
        return response()->json([
            'data' => $guideline_obj
        ], 200);

    }
    
    public function show($id){
        $guideline = Guideline::findOrFail($id);
        return view('admin.guidelines.show', compact(['guideline']));
    }
    
    // to get editor values 
    public function getEditorData(Request $request){
        $guideline = Guideline::findOrFail($request->guideline_id);
        return response()->json([
            'ar_content' => $guideline->ar_content,
            'en_content' => $guideline->en_content,
            'cn_content' => $guideline->cn_content,
            'ru_content' => $guideline->ru_content,
            'tr_content' => $guideline->tr_content,
            'pr_content' => $guideline->pr_content,
        ]);
    }

    public function edit($id){
        $guideline = Guideline::findOrFail($id);
        $guideline_types = GuidelineType::all();
        return view('admin.guidelines.edit', compact(['guideline','guideline_types']));
    }
   
    public function update(GuidelinesRequest $request){
        $guideline_obj = Guideline::findOrFail($request->guideline_id);
        $guideline_obj->guideline_type = $request->guideline_type;
        $guideline_obj->en_title = $request->en_title;
        $guideline_obj->ar_title = $request->ar_title;
        $guideline_obj->cn_title = $request->cn_title;
        $guideline_obj->ru_title = $request->ru_title;
        $guideline_obj->tr_title = $request->tr_title;
        $guideline_obj->pr_title = $request->pr_title;
        $guideline_obj->en_content = $request->en_content;
        $guideline_obj->ar_content = $request->ar_content;
        $guideline_obj->cn_content = $request->cn_content;
        $guideline_obj->ru_content = $request->ru_content;
        $guideline_obj->tr_content = $request->tr_content;
        $guideline_obj->pr_content = $request->pr_content;
        $guideline_obj->active = $request->active;
        $guideline_obj->updated_by = Auth::user()->id;
        $guideline_obj->date_updated = date('Y-m-d H:i:s');
        $guideline_obj->save();

        $message = 'Guide line hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Updated successfull');
        session()->flash('feedback', $message);
        return response()->json([
            'data' => $guideline_obj
        ], 200);
    }
    
    public function destroy($id){
        Guideline::where('id',$id)->delete();
        $message = 'Guide Line hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel Guideline table actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->guideline_id as $id){
                Guideline::where('id',$id)->delete();
            }
            $message = 'Guideline hass been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }
}
