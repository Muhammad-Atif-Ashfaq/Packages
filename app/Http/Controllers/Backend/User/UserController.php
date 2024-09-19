<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $model;
    public function __construct() {

        $this->model = new User;
    }

    public function index()
    {

        if(Auth::check())
        {
            return redirect()->route('user.dashboard');
        }
        return view('backend.user.auth.login');
    }

    public function singUpPage()
    {
        return view('backend.user.auth.signup');
    }

    public function referRegister($id)
    {
        $id = base64_decode($id);
        return view('backend.user.auth.signup',compact('id'));
    }

    public function singUp(Request $request)
    {
        $referral=$request->input('referral_id');
        $request->validate([
            'name' => ['required'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','min:8'],
        ]);

        $data=User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
            'role'=>'user',
            'referred_by'=>$referral ?? null,

        ]);

        return redirect()->route('user.loginPage')->with('success','Registered successfully');

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
            $user = Auth::user();
            return redirect()->route('user.dashboard');
        }
        return back()->with('error', 'Email or Password do not match');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success','Logout successfully');
    }


    public function dashboard()
    {
        $userId=Auth::user()->id;
        $data['referrals']=User::where('referred_by',$userId)->count();
        return view('backend.user.dashboard',compact('data'));
    }

    public function users()
    {
        $users = $this->model::where('id', '!=', 1)->get();
        return view('backend.admin.users.list', compact('users'));
    }

    public function destroy(Request $request)
    {
        $user = $this->model::findOrFail($request['id']);
        if($user)
        {
            $user->delete();
            return redirect()->back()->with('success','User deleted successfully');
        }else
        {
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function profile()
    {
        return view('backend.user.profile');
    }

    public function update_profile(Request $request)
    {
        $request->validate(['password'=>'nullable|min:8']);
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
    
    public function searchUsers(Request $request)
    {
        $searchTerm = $request->input('term');

        $users = User::where('id', '!=', 1) 
                    ->where(function ($query) use ($searchTerm) {
                        $query->where('name', 'like', "%$searchTerm%")
                            ->orWhere('email', 'like', "%$searchTerm%");
                    })
                    ->get();

        $usersWithReferrels = $users->map(function ($user) {
            $user->total_referrels = totalUserReferrels($user->id);
            return $user;
        });

        return response()->json($usersWithReferrels);
    }
}