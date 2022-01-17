<?php

namespace App\Http\Controllers\Admin;
use App;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

 

class AuthController extends Controller
{
    // to load register view
    public function showRegister(){
        return view('admin/auth/register');  
    }
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admin_users',
            'username' => 'required|max:15|unique:admin_users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'userlevel' => $request->user_level,
            'permissions' => json_encode([]),
        ]);
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        $message = "Please check your data and try again";
        session()->flash('error',$message);
        return redirect('register');
    }



    // login section
    public function showLogin(){
        return view('admin/auth/login');
    }

    public function login(Request $request){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        $message = "Please check your data and try again";
        session()->flash('error',$message);
        return redirect('login');
    }


    public function logout (Request $request) {
        Auth::logout();
        return redirect('login');
    }


}