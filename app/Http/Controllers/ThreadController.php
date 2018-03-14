<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Comment;
use Illuminate\Http\Request;

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

    public function update(Request $request){

        if(auth()->check() && auth()->user()->id == $request['user_id']) {

            $thread = Thread::where('id', '=', $request['id'])->first();

            $this->validate(request(), [
                'body' => 'required',
            ]);

            $thread->title = $request['title'];
            $thread->body = $request['body'];
            $thread->save();

            return $request->all();
        }
        return 'bad';
    }

    public function store(){

        $this->validate(request(), [
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        auth()->user()->publish(
            new Thread(request(['title','body']))
        );

        return redirect()->home();
    }

    public function index(Thread $thread){
        $comments = $this->comment->GetAllComment($thread->id);

        return view('threads.show', compact(['thread', 'comments']));
    }


    //методы ниже переместить
    public function getThread($id){
        $thread = Thread::where('id', '=', $id)->first();

        return $thread;
    }

    public function deleteThread($id){

        auth()->user()->DeleteThread($id);
        return redirect()->home();
    }
}
