<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\User;
use App\Models\UserLevel;
use App\Exports\AdminUserExport;
use App\Imports\AdminUserImport;
use App\Http\Requests\AdminUsersRequest;
use Maatwebsite\Excel\Facades\Excel; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller
{
    
    public function index(){
        $users = User::all();
        return view('admin.users.index',compact(['users']));
    }

    public function getUsersAsJson(Request $request){
        $rows_numbers = $request->rows_numbers;
        $user_obj = new User();

        $users_count = $user_obj->count();
        $users = $user_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
        
        return response()->json([
            'users' => $users,
            'pagination' => (string) $users->links('pagination::bootstrap-4'),
            'users_count' => $users_count
        ]); 
    }

    public function filterUsers(Request $request){
        $name = $request->name;
        $rows_numbers = $request->rows_numbers; 

        $currentPage = $request->current_page;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $user_obj = User::where('deleted_at',null);

        if($name){
            $user_obj->where('name','like', '%' . $name . '%')
                ->orWhere('username', 'like', '%'. $name . '%');
        }
 
        $users_count = $user_obj->count();
        $users = $user_obj->orderBy('id','desc')
        ->paginate($rows_numbers);
   
        return response()->json([
            'users' => $users,
            'pagination' => (string) $users->links('pagination::bootstrap-4'),
            'users_count' => $users_count
        ]);
    }

   
    public function create(){
        $users_level = UserLevel::get();
        return view('admin.users.create',compact(['users_level']));
    }

    
    public function store(AdminUsersRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->userlevel = $request->user_level;
        $user->permissions = json_encode([]);
        $user->save();

        $message = "Admin has been added successfully";
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Added Success');
        session()->flash('feedback', $message);
        return redirect()->back();

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
        User::where('id',$id)->delete();
        $message = 'user hass been Archived successfully';
        session()->flash('success', 'true');
        session()->flash('feedback_title', 'Archived Success');
        session()->flash('feedback', $message);
        return redirect()->back();
    } 

    // import & export to excel
    public function exportExcel() {
        return Excel::download(new AdminUserExport, 'users.xlsx'); 
    }
   
    public function importExcel() {
        Excel::import(new AdminUserImport,request()->file('file'));
        return redirect()->back();
    }

}
