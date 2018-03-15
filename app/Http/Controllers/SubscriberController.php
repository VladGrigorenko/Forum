<?php

namespace App\Http\Controllers;

use App\Subscriber;
use App\Thread;

class SubscriberController extends Controller
{
    public function store($id){

        auth()->user()->Subscribe(
            new Subscriber(array('thread_id' => $id))
        );

        return  back();
    }

    public function destroy(Thread $thread){

        auth()->user()->DeleteSub($thread);

        return back();
    }
}
