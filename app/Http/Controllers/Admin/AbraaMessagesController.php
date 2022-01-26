<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\AbraaMessage;
use App\Http\Requests\AbraaMessagesRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;
use App\Http\Traits\MailerTrait;

class AbraaMessagesController extends Controller
{
    use MailerTrait; 

    public function index(){
        return view('admin.messages.abraa_messages.index');
    }

    public function getAbraaMessagesAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $message_obj = AbraaMessage::with('user')->with('sender');
   
        $messages_count = $message_obj->count();
        $messages = $message_obj->orderBy('id', 'DESC')->paginate($rows_numbers);

        return response()->json([
            'messages' => $messages,
            'pagination' => (string) $messages->links('pagination::bootstrap-4'),
            'messages_count' => $messages_count
        ]);
    }

    // to filter messages 
    public function filterAbraaMessages(Request $request){
        $username = $request->username;
        $subject = $request->subject;
        $rows_numbers = $request->rows_numbers;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $message_obj = AbraaMessage::leftJoin('users', function($join) {
            $join->on('users.id', '=', 'dlist_messages.user_id');
        })->select('dlist_messages.*');

        if($username){
            $message_obj->where('users.full_name', 'like', '%'. $username . '%');
        }

        if($subject){
            $message_obj->where('dlist_messagessubject', 'like', '%'. $subject . '%');
        }

        $messages_count = $message_obj->count();
        $messages = $message_obj->orderBy('dlist_messages.id', 'DESC')
        ->with('user')->with('sender')->paginate($rows_numbers);

        return response()->json([
            'messages' => $messages,
            'pagination' => (string) $messages->links('pagination::bootstrap-4'),
            'messages_count' => $messages_count
        ]);
    }
    
    // to get users for sending messages 
    public function filterUsersAsJson(Request $request){
        $supplier_name = $request->supplier_name;
        $buyer_name = $request->buyer_name;
        $keywords = $request->keywords;
        $rows_numbers = $request->rows_numbers;

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $user_obj = Member::with('member_country');
        if($supplier_name){
            $user_obj->where('full_name', 'like', '%'. $supplier_name . '%');
        }

        if($buyer_name){
            $user_obj->where('full_name', 'like', '%'. $buyer_name . '%');
        }

        if($keywords){
            foreach($keywords as $word){
                $user_obj->where('interested_keywords','like', '%' . $word . '%');
            }
        }

        $users_count = $user_obj->count();
        $users = $user_obj->orderBy('id', 'DESC')->paginate($rows_numbers);

        return response()->json([
            'users' => $users,
            'pagination' => (string) $users->links('pagination::bootstrap-4'),
            'users_count' => $users_count
        ]);
    }

    public function getEditor(){
        return view('admin.messages.abraa_messages.editor');
    }

    public function sendMessage(AbraaMessagesRequest $request){
        $subject = $request->subject;
        $message = $request->message;
        $user_email = $request->user_email;
       
        $email_templete = $this->getEmailTemplete($message);
        foreach($user_email as $email){ 
            $this->sendEmail($email_templete, $email, $subject);
        }
        return redirect()->back();
    }

    // to get users for create page
    public function searchUsers(Request $request){
        $results = Member::where('full_name', 'like', '%'. $request->term . '%')
        ->get();
        $i = 0;
        foreach ($results as $r) {
            $users[$i]['id'] = $r['id'];
            $users[$i]['value'] = str_replace("&#39;s", " ", html_entity_decode($r['email']));
            $users[$i]['label'] = str_replace("&#39;s", " ", html_entity_decode($r['email']));
            $i++;
        }
        echo json_encode($users);
    }

    public function create(){
        return view('admin.messages.abraa_messages.create');
    }

   
    public function store(AbraaMessagesRequest $request){
        $message = new AbraaMessage();
        $message->user_id = $request->user_id;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->datetime = date('Y-m-d H:i:s');
        $message->message_read = 0;
        $message->sent_by = Auth::user()->id;
        $message->save();
        // $email_templete = $this->getEmailTemplete($request->message);
        // $this->sendEmail($email_templete, $request->user_email, $$request->subject);
        $message = 'Message Has been Send successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Send Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

 
    public function show($id){
        $message = AbraaMessage::findOrFail($id);
        return view('admin.messages.abraa_messages.show', compact(['message']));
    }

    public function edit($id){
        $message = AbraaMessage::findOrFail($id);
        return view('admin.messages.abraa_messages.edit', compact(['message']));
    }

  
    public function update(Request $request){
        $message = AbraaMessage::findOrFail($request->message_id);
        $message->user_id = $request->user_id;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();

        $message = 'Message Has been Send successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Send Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    public function destroy($id){
        AbraaMessage::where('id',$id)->delete();
        $message = 'Message hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived successfully');
        session()->flash('feedback', $message);
        return redirect()->back();
    }
    
    // import & export to excel
    public function exportExcel() {
        return Excel::download(new AbraaMessageExport, 'messages.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new AbraaMessageImport,request()->file('file'));
        return redirect()->back();
    }
}
