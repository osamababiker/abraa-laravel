<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePageBuyer;
use App\Http\Requests\HomePageBuyersRequest;
use App\Http\Traits\FilesUploadTrait;
use App\Exports\HomePageBuyerExport;
use App\Imports\HomePageBuyerImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class HomePageBuyersController extends Controller
{
  
    use FilesUploadTrait ;

    public function index(){
        return view('admin.home.buyers.index'); 
    }

    public function getHomeBuersAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $buyers_obj = new HomePageBuyer();

        $buyers_count = $buyers_obj->count();
        $buyers = $buyers_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'buyers' => $buyers,
            'pagination' => (string) $buyers->links('pagination::bootstrap-4'),
            'buyers_count' => $buyers_count
        ]);
    } 

    public function filterHomeBuyers(Request $request){
        $buyer_name = $request->buyer_name;
        $rows_numbers = $request->rows_numbers; 

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        
        if($buyer_name){
            $buyers_obj = HomePageBuyer::where('buyername','like', '%' . $buyer_name . '%'); 
        }else $buyers_obj = new HomePageBuyer();
            
        $buyers_count = $buyers_obj->count();
        $buyers = $buyers_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'buyers' => $buyers,
            'pagination' => (string) $buyers->links('pagination::bootstrap-4'),
            'buyers_count' => $buyers_count
        ]);
    }

    public function create(){
        return view('admin.home.buyers.create');
    }

    
    public function store(HomePageBuyersRequest $request){
        $buyer = new HomePageBuyer();
        // to upload buyer image
        $buyer_logo = '';
        if($request->has('buyer_logo')){
            $image = $request->file('buyer_logo');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $buyer_logo = $this->upload_image($image_name, $temp_dir, 'files'); 
        }
        
        $buyer->buyername = $request->buyername;
        $buyer->buyer_logo = $buyer_logo;
        $buyer->buyer_link = $request->buyer_link;
        $buyer->status = $request->status;
        $buyer->added_date = date('Y-m-d H:i:s');
        $buyer->added_by = Auth::user()->id;
        $buyer->save();

        $message = 'buyer hass been Added successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Added successfully');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

   
    public function show($id){
        $buyer = HomePageBuyer::findOrFail($id);
        return view('admin.home.buyers.show', compact(['buyer']));
    }

    public function edit($id){
        $buyer = HomePageBuyer::findOrFail($id);
        return view('admin.home.buyers.edit', compact(['buyer']));
    }

    public function update(Request $request){
        $buyer = HomePageBuyer::findOrFail($request->buyer_id);
        // to upload buyer image
        $buyer_logo = '';
        if($request->has('buyer_logo')){
            $image = $request->file('buyer_logo');
            $image_slug = preg_replace("{/}", "-", $request->link);
            $image_name = $image_slug . '.' . $image->extension();
            $temp_dir = $image->getPathName();
            $buyer_logo = $this->upload_image($image_name, $temp_dir, 'files'); 
        }else $buyer_logo = $buyer->buyer_logo;
        
        $buyer->buyername = $request->buyername;
        $buyer->buyer_logo = $buyer_logo;
        $buyer->buyer_link = $request->buyer_link;
        $buyer->status = $request->status;
        $buyer->added_date = date('Y-m-d H:i:s');
        $buyer->added_by = Auth::user()->id;
        $buyer->save();

        $message = 'buyer hass been Updated successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function destroy($id){
        HomePageBuyer::where('id',$id)->delete();
        $message = 'buyer hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel home buyers actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->buyer_id as $id){
                HomePageBuyer::where('id',$id)->delete();
            }
            $message = 'buyers hass been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }
    
    // import & export to excel
    public function exportExcel() {
        return Excel::download(new HomePageBuyerExport, 'buyers.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new HomePageBuyerImport,request()->file('file'));
        return redirect()->back();
    }
}
