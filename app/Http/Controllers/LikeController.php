<?php

namespace App\Http\Controllers;

use App\Like;

class LikeController extends Controller
{
    public function store()
    {
        auth()->user()->SetLike(
            new Like( request(['comment_id']) )
        );
    }

    public function destroy($id){
        auth()->user()->DeleteLike($id);
    }

}
