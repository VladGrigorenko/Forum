<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\ValidateComment;
use App\Models\Thread;

class CommentController extends Controller
{
    public function index(Thread $thread)
    {
        $comments = $thread->GetAllComments();

        return $comments;
    }

    public function store(ValidateComment $request)
    {
        auth()->user()->PublishComment(
            new Comment($request->only('body', 'thread_id'))
        );
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
    }

    public function update(ValidateComment $request, Comment $comment)
    {
        $comment->UpdateComment($request['thread_id'], $request['body']);
    }
}
