<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateThread;
use App\Thread;
use App\Comment;

class ThreadController extends Controller
{
    protected $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function create(){
        return view('threads.create');
    }

    public function update(ValidateThread $request){


        $thread = Thread::where('id', '=', $request['id'])->first();

        $thread->title = $request['title'];
        $thread->body = $request['body'];
        $thread->save();

    }

    public function store(ValidateThread $request){


        auth()->user()->publish(
            new Thread($request->only('title','body'))
        );
        return redirect()->home();
    }

    public function index(Thread $thread){
        $comments = $this->comment->GetAllComment($thread->id);

        return view('threads.show', compact(['thread', 'comments']));
    }


    public function show($id){
        $thread = Thread::where('id', '=', $id)->first();

        return $thread;
    }

    public function destroy($id){

        auth()->user()->DeleteThread($id);
        return redirect()->home();
    }
}
