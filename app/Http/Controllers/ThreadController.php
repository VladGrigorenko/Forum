<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateThread;
use App\Thread;
use App\Comment;

class ThreadController extends Controller
{
    public function __construct()
    {
    }

    public function create()
    {
        return view('threads.create');
    }

    public function update(ValidateThread $request, Thread $thread)
    {
        $thread->title = $request['title'];
        $thread->body = $request['body'];
        $thread->save();
    }

    public function store(ValidateThread $request)
    {
        auth()->user()->publish(
            new Thread($request->only('title', 'body'))
        );
        return redirect()->home();
    }

    public function show(Thread $thread)
    {
        return view('threads.show', compact(['thread']));
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();

        return redirect()->home();
    }
}
