<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index()
    {
        $data=ContactUs::all();
        return view('backend.admin.contact-us.index',compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:225'],
            'email' => ['required','email'],
            'message'=>['required'],
        ]);

        $data=ContactUs::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'message'=>$request->input('message'),
        ]);

        return back()->with('success','Message send successfully');
    }

    public function destroy($id)
    {
        $data=ContactUs::findOrFail($id);
        $data->delete();
        return back()->with('success','Deleted successfully');

    }
    
}