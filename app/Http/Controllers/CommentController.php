<?php


namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\ValidateComment;
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

    public function store(ValidateComment $request){

        auth()->user()->PublishComment(
            new Comment($request->only('body','thread_id'))
        );

        $thread_id = $request['thread_id'];
        $subscribers = Subscriber::where('thread_id', '=', $thread_id)->get();
        $threads = Thread::where('id', '=', $thread_id)->get()->first();

        foreach ($subscribers as $subscriber) {
            $user = User::where('id', '=', $subscriber->user_id)->get()->first();
            Mail::send('mails.subscribe', ['user' => $user, 'thread' => $threads], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject('Hello!');
            });
        }
    }

    public function destroy(Comment $comment){
        $comment->delete();
    }

    public function update(ValidateComment $request, Comment $comment){

        $comment->thread_id = $request['thread_id'];
        $comment->body = $request['body'];
        $comment->save();
    }
}
