<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Backend\News;
use App\Backend\Event;
use App\Library;

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
        $student = $this->studentCount();
        $teacher = $this->teacherCount();
        $news = $this->newsCount();
        $events = $this->eventsCount();
        $new_students = $this->newStudents();
        $new_books = $this->recentBooks();
        return view('dashboard',compact('student', 'teacher', 'news','events','new_students', 'new_books'));
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

    public function studentCount()
    {
        $student = User::whereHas("roles", function($q){ $q->where("name", "Student"); })->count();
        return $student;
    }
    
    public function teacherCount()
    {
        $teacher = User::whereHas("roles", function($q){ $q->where("name", "Student"); })->count();
        return $teacher;
    }

    public function newsCount()
    {
        $news = News::all()->count();
        return $news;
    }
    
    public function eventsCount()
    {
        $events = Event::all()->count();
        return $events;
    }

    public function newStudents()
    {
        $new_student = User::whereHas("roles", function($q){ $q->where("name", "Student"); })->orderBy('created_at','desc')->paginate(8);
        return $new_student;
    }

    public function recentBooks()
    {
        $recent_books = Library::orderBy('created_at','desc')->paginate(8);
        return $recent_books;
    }

}
