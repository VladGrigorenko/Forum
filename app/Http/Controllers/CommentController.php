<?php


namespace App\Http\Controllers;

use App\Comment;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Thread;
use App\User;

class CommentController extends Controller
{

    public function index($id)
    {
        $comments  = Comment::where('thread_id', '=', $id)->orderBy('created_at', 'desc')->with('user','like')->get();

        return $comments;
    }
    public function store(){

        $this->validate(request(), [
            'body' => 'required|max:255',
        ]);

        auth()->user()->PublishComment(
            new Comment(request(['body','thread_id']))
        );

        $thread_id = request('thread_id');
        $subscrabirs = Subscriber::where('thread_id', '=', $thread_id)->get();
        $threads = Thread::where('id', '=', $thread_id)->get()->first();

        foreach ($subscrabirs as $subscrabir) {
            $user = User::where('id', '=', $subscrabir->user_id)->get()->first();
            Mail::send('mails.subscribe', ['user' => $user, 'thread' => $threads], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject('Hello!');
            });
        }
    }

    public function destroy($id){
        auth()->user()->DeleteComment($id);
    }

    public function update(Request $request){

        if(auth()->check() && auth()->user()->id == $request['user_id']) {

            $comment = Comment::where('id', '=', $request['id'])->first();

            $this->validate(request(), [
                'body' => 'required|max:255',
            ]);

            $comment->thread_id = $request['thread_id'];
            $comment->body = $request['body'];
            $comment->save();

            return $request->all();
        }
        return 'bad';

    }



}
