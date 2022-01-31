<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Requests\PagesRequest;
use Illuminate\Pagination\Paginator;

class PagesController extends Controller
{ 
   
    public function index(){
        return view('admin.pages.index');
    } 

    public function getPagesAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $page_obj = new Page();

        $pages_count = $page_obj->count();
        $pages = $page_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'pages' => $pages,
            'pagination' => (string) $pages->links('pagination::bootstrap-4'),
            'pages_count' => $pages_count
        ]); 
    }

    public function filterPages(Request $request){
        $rows_numbers = $request->rows_numbers; 
        $title = $request->title;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        
        if($title){
            $page_obj = Page::where('ar_title', 'like', '%'. $title . '%')
            ->orWhere('en_title', 'like', '%'. $title . '%');
        }else $page_obj = new Page();

        $pages_count = $page_obj->count();
        $pages = $page_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
   
        return response()->json([
            'pages' => $pages,
            'pagination' => (string) $pages->links('pagination::bootstrap-4'),
            'pages_count' => $pages_count
        ]);
    }

    public function create(){
        return view('admin.pages.create');
    }
   
    public function store(PagesRequest $request){

        $page = new Page();
        $page->sub_of = $request->sub_of;
        $page->sort_id = $request->sort_id;
        $page->ar_title = $request->ar_title;
        $page->ar_content = $request->ar_content;
        $page->ar_visits = $request->ar_visits;
        $page->en_title = $request->en_title;
        $page->en_content = $request->en_content;
        $page->en_visits = $request->en_visits;
        $page->cn_title = $request->cn_title;
        $page->cn_content = $request->cn_content;
        $page->cn_visits = $request->cn_visits;
        $page->ru_title = $request->ru_title;
        $page->ru_content = $request->ru_content;
        $page->ru_visits = $request->ru_visits;
        $page->tr_title = $request->tr_title;
        $page->tr_content = $request->tr_content;
        $page->tr_visits = $request->tr_visits;
        $page->pr_title = $request->pr_title;
        $page->pr_content = $request->pr_content;
        $page->pr_visits = $request->pr_visits;
        $page->slug = $request->slug;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->meta_keyword = $request->meta_keyword;
        $page->save();

        $message = 'Article hass been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Added successfull');
        session()->flash('feedback', $message);
        return response()->json([
            'data' => $page
        ], 200);
    }

    public function show($id){
        $page = Page::findOrFail($id);
        return view('admin.pages.show', compact(['page']));
    }

    // to get editor values 
    public function getEditorData(Request $request){
        $page = Page::findOrFail($request->page_id);
        return response()->json([
            'ar_content' => $page->ar_content,
            'en_content' => $page->en_content,
            'cn_content' => $page->cn_content,
            'ru_content' => $page->ru_content,
            'tr_content' => $page->tr_content,
            'pr_content' => $page->pr_content,
        ]);
    }

    public function edit($id){
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact(['page']));
    }

    public function update(Request $request){
        $page = Page::findOrFail($request->page_id);
        $page->sub_of = $request->sub_of;
        $page->sort_id = $request->sort_id;
        $page->ar_title = $request->ar_title;
        $page->ar_content = $request->ar_content;
        $page->ar_visits = $request->ar_visits;
        $page->en_title = $request->en_title;
        $page->en_content = $request->en_content;
        $page->en_visits = $request->en_visits;
        $page->cn_title = $request->cn_title;
        $page->cn_content = $request->cn_content;
        $page->cn_visits = $request->cn_visits;
        $page->ru_title = $request->ru_title;
        $page->ru_content = $request->ru_content;
        $page->ru_visits = $request->ru_visits;
        $page->tr_title = $request->tr_title;
        $page->tr_content = $request->tr_content;
        $page->tr_visits = $request->tr_visits;
        $page->pr_title = $request->pr_title;
        $page->pr_content = $request->pr_content;
        $page->pr_visits = $request->pr_visits;
        $page->slug = $request->slug;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->meta_keyword = $request->meta_keyword;
        $page->save();

        $message = 'Article hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Updated successfull');
        session()->flash('feedback', $message);
        return response()->json([
            'data' => $page
        ], 200);
    }

    public function destroy($id){
        Page::where('id',$id)->delete();
        $message = 'Article hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived successfully');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel pages table actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->page_id as $id){
                Page::where('id',$id)->delete();
            }
            $message = 'Article hass been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Archived successfully');
            session()->flash('feedback', $message);
            return redirect()->back();
        }   
    }
}
