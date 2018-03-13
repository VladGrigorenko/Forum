<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store()
    {
        auth()->user()->SetLike(
            new Like( request(['comment_id']) )
        );
    }

    public function delete($id){
        auth()->user()->DeleteLike($id);
    }

}
