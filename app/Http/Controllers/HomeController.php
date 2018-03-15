<?php

namespace App\Http\Controllers;

use App\Models\Thread;

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
        $threads = new Thread();
        $threads = $threads->GetAll();
        return view('home',compact('threads'));
    }
}
