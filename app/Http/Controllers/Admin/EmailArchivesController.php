<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailArchive;
use App\Exports\EmailArchivesExport;
use App\Imports\EmailArchivesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class EmailArchivesController extends Controller
{
    
    public function index(){
        return view('admin.general.emails_archives.index');
    } 

    public function getEmailsAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;

        $email_obj = new EmailArchive();
        $emails_count = $email_obj->count();
        $emails = $email_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'emails' => $emails,
            'pagination' => (string) $emails->links('pagination::bootstrap-4'),
            'emails_count' => $emails_count
        ]); 
    }

    public function filterEmails(Request $request){
        $rows_numbers = $request->rows_numbers; 
        $email = $request->email;
        $subject = $request->subject;
        
        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        if($email && $subject){
            $email_obj = EmailArchive::where('sent_to', 'like' , '%'. $email . '%')
            ->where('subject', 'like', '%'. $subject . '%');
        }else if($email){
            $email_obj = EmailArchive::where('sent_to', 'like' , '%'. $email . '%');
        }else if($subject){
            $email_obj = EmailArchive::where('subject', 'like', '%'. $subject . '%');
        }else $email_obj = new EmailArchive();

        $emails_count = $email_obj->count();
        $emails = $email_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
   
        return response()->json([
            'emails' => $emails,
            'pagination' => (string) $emails->links('pagination::bootstrap-4'),
            'emails_count' => $emails_count
        ]);
    } 

    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        $email = EmailArchive::findOrFail($id);
        return view('admin.general.emails_archives.show', compact(['email']));
    }

    public function edit($id){
        $email = EmailArchive::findOrFail($id);
        return view('admin.general.emails_archives.edit', compact(['email']));
    }

    public function update(Request $request, $id){
        //
    }
   
    public function destroy($id){
        EmailArchive::where('id',$id)->delete();
        $message = 'email hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    }

    // to handel emails table actions
    public function actions(Request $request){
        if($request->has('delete_selected_btn')){
            foreach($request->email_id as $id){
                EmailArchive::where('id',$id)->delete();
            }
            $message = 'emails hass been Archived successfully';
            session()->flash('success', 'true');
            session()->flash('feedback_title', 'Success');
            session()->flash('feedback', $message);
            return redirect()->back();
        }
    }

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new EmailArchivesExport, 'emails.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new EmailArchivesImport,request()->file('file')); 
        return redirect()->back();
    }
}
