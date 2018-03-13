<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function create($id){

        auth()->user()->Subscribe(
            new Subscriber(array('thread_id' => $id))
        );

        return  back();
    }

    public function unsub($id){


        auth()->user()->DeleteSub($id);

        return back();
    }
}
