<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateThread;
use App\Models\Thread;

class ThreadController extends Controller
{

    public function create()
    {
        return view('threads.create');
    }

    public function update(ValidateThread $request, Thread $thread)
    {
        $thread->UpdateThread($request['body']);
    }

    public function store(ValidateThread $request)
    {
        auth()->user()->publish(
            new Thread($request->only('title', 'body'))
        );
        return redirect()->home();
    }

    public function index(Thread $thread)
    {
        return view('threads.show', compact(['thread']));
    }

    public function show(Thread $thread)
    {
        return $thread;
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();

        return redirect()->home();
    }
}
