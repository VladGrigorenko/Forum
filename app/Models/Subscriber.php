<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscriber extends Model
{

    protected $fillable = [
        'thread_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function thread(){
        return $this->belongsTo(Thread::class);
    }

    public function SendEmail($thread_id){

        $subscribers = Subscriber::where('thread_id', '=', $thread_id)->get();
        $threads = Thread::where('id', '=', $thread_id)->get()->first();

        foreach ($subscribers as $subscriber) {
            $user = User::where('id', '=', $subscriber->user_id)->get()->first();
            Mail::send('mails.subscribe', ['user' => $user, 'thread' => $threads], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject('Hello!');
            });
        }
    }
}
