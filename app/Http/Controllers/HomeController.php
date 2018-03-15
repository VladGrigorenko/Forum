<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = Thread::orderBy('created_at','desc')->paginate(10);
        return view('home',compact('threads'));
    }
}
