<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuyerMessage;
use App\Exports\BuyerMessagesExport;
use App\Imports\BuyerMessagesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class BuyerMessagesController extends Controller
{
    
    public function index(){
        return view('admin.buyers.messages.index');
    }

    public function getBuyerMessagesAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $messages_object = new BuyerMessage();

        $messages = $messages_object->orderBy('id','desc')
            ->with('supplier')->with('buyer')->paginate($rows_numbers);
        $messages_count = $messages_object->count();
        
        return response()->json([
            'messages' => $messages,
            'pagination' => (string) $messages->links('pagination::bootstrap-4'),
            'messages_count' => $messages_count
        ]);
    }

    public function filterBuyerMessages(Request $request){
        $buyer_name = $request->buyer_name;
        $supplier_name = $request->supplier_name;
        $rows_numbers = $request->rows_numbers; 

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $messages_object = BuyerMessage::leftJoin('users', function($join){
            $join->on('users.id', '=', 'buyer_messages.supplier_id');
            $join->orOn('users.id', '=', 'buyer_messages.buyer_id');
        })
        ->select('buyer_messages.*');

        if($buyer_name){
            $messages_object->where('users.full_name', 'like', '%'. $buyer_name. '%');
        }

        if($supplier_name){
            $messages_object->where('users.full_name', 'like', '%'. $supplier_name. '%');
        }
            
        $messages_count = $messages_object->count();
        $messages = $messages_object->orderBy('id','desc')
        ->with('supplier')->with('buyer')
        ->paginate($rows_numbers);
        
        return response()->json([
            'messages' => $messages,
            'pagination' => (string) $messages->links('pagination::bootstrap-4'),
            'messages_count' => $messages_count
        ]);
    }

    
    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    
    public function show($id){
        $message = BuyerMessage::findOrFail($id);
        return view('admin.buyers.messages.show', compact(['message']));
    }


    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    
    public function destroy($id){
        BuyerMessage::where('id',$id)->delete();
        $message = 'Message hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel table actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            $message_id = $request->message_id;
            if($request->all_colums){
                BuyerMessage::delete();
            }
            elseif($message_id){
                foreach($message_id as $id){
                    BuyerMessage::where('id',$id)->delete();
                }
            }
            $message = 'Messages has been archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }
    
    // import & export to excel
    public function exportExcel() {
        return Excel::download(new BuyerMessagesExport, 'buyers_messages.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new BuyerMessagesImport,request()->file('file'));
        return redirect()->back();
    }
}
