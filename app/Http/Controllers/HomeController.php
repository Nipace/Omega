<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }
    public function resetPassword()
    {
        return view('auth.resetpassword');
    }

    public function savePassword(Request $request)
    {
        $this->validate($request,[   
            "currentpassword"=>"required",
            "newpassword"=>"required",
           ]);
        if(Hash::check($request->currentpassword, auth()->user()->password))
        {
         $user = auth()->user();
         $user->password = Hash::make($request->newpassword);
         $user->is_password_reset = '1';
         $user->save();
         return redirect('/home');
    }
        else{
            return "vayena";
        }
       
    }
}
