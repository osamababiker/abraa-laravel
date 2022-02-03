<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemFile;
use App\Models\Item;
use App\Http\Requests\ItemsFilesRequest;
use App\Http\Traits\FilesUploadTrait; 
use App\Http\Traits\ClearCacheTrait; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class ItemsFilesController extends Controller
{
 
    use FilesUploadTrait, ClearCacheTrait;

    public function index(){
        return view('admin.items.files.index'); 
    }

    public function getItemsFilesAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $files_obj = new ItemFile();

        $files_count = $files_obj->count();
        $files = $files_obj->with('item')
        ->orderBy('id','desc')->paginate($rows_numbers);
        
        return response()->json([
            'files' => $files,
            'pagination' => (string) $files->links('pagination::bootstrap-4'),
            'files_count' => $files_count
        ]);
    }

    public function filterItemsFiles(Request $request){ 
        $item_title = $request->item_title;
        $rows_numbers = $request->rows_numbers; 

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $files_obj = ItemFile::with('item')
        ->leftJoin('items', function($join) {
            $join->on('items.id', '=', 'items_files.sub_of');
        })
        ->select('items_files.*');
        
        if($item_title){
            $files_obj->where('items.title','like', '%' . $item_title . '%'); 
        }
            
        $files_count = $files_obj->count();
        $files = $files_obj->orderBy('items_files.id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'files' => $files,
            'pagination' => (string) $files->links('pagination::bootstrap-4'),
            'files_count' => $files_count
        ]);
    }


    public function getItemsData(ItemsFilesRequest $request){
        $results = Item::where('title', 'like', '%'. $request->term . '%')
        ->get();
        $i = 0;
        foreach ($results as $r) {
            $items[$i]['id'] = $r['id'];
            $items[$i]['value'] = str_replace("&#39;s", " ", html_entity_decode($r['title']));
            $items[$i]['label'] = str_replace("&#39;s", " ", html_entity_decode($r['title']));
            $i++;
        }
        echo json_encode($items);
    }
   
    public function create(){
        return view('admin.items.files.create');
    }

    public function store(ItemsFilesRequest $request){
        $file = new ItemFile();
        // to upload file image
        $file_url = '';
        if($request->has('file')){
            $image = $request->file('file');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $file_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }
        
        $file->sub_of = $request->item_id;
        $file->main = $request->is_main;
        $file->file_url = $file_url;
        $file->save();
        
        // to clear the cache on abraa.com
        $this->clearAbraaCache("items_files");

        $message = 'file hass been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

  
    public function show($id){
        $file = ItemFile::findOrFail($id);
        return view('admin.items.files.show', compact(['file']));
    }

    public function edit($id){
        $file = ItemFile::findOrFail($id);
        return view('admin.items.files.edit', compact(['file']));
    }

    public function update(ItemsFilesRequest $request){
        $file = ItemFile::find($request->file_id);
        // to upload file image
        $file_url = '';
        if($request->has('file')){
            $image = $request->file('file');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $file_url = $this->upload_image($image_name, $temp_dir, 'files'); 
        }
        
        $file->sub_of = $request->item_id;
        $file->main = $request->is_main;
        $file->file_url = $file_url;
        $file->save();
        
        // to clear the cache on abraa.com
        $this->clearAbraaCache("items_files");

        $message = 'file hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function destroy($id){
        ItemFile::where('id',$id)->delete();

        // to clear the cache on abraa.com
        $this->clearAbraaCache("items_files");

        $message = 'file has been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel home files actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->file_id as $id){
                ItemFile::where('id',$id)->delete();
            } 
            // to clear the cache on abraa.com
            $this->clearAbraaCache("items_files");

            $message = 'files has been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }
}
