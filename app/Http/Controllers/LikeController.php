<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;

class LikeController extends Controller
{
    public function store()
    {
        auth()->user()->SetLike(
            new Like(request(['comment_id']))
        );
    }

    public function destroy(Comment $comment)
    {
        auth()->user()->DeleteLike($comment);
    }
}
