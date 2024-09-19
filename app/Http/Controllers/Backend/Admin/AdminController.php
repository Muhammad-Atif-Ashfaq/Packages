<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class AdminController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
            $user = Auth::user();
            return redirect()->route('admin.dashboard');
        }
        return back()->with('error', 'Login Credentioal is Invalid');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.loginPage')->with('success','Logout successfully');
    }

    public function dashboard()
    {
        return view('backend.admin.dashboard');
    }

    public function profile()
    {
        return view('backend.admin.profile');
    }

    
    public function update_profile(Request $request)
    {
        $request->validate([
            'password'=>'nullable|min:8'
        ]);
        $user = User::find(auth()->user()->id);
    
        $data = [
            'name' => $request->input('name', $user->name),
        ];
    
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
    
        $user->update($data);
    
        if ($user) {
            return redirect()->back()->with('success', 'Profile Updated');
        } else {
            return redirect()->back()->with('error', 'Profile Update Failed');
        }
    }
}