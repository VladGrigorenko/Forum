<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body','thread_id'
    ];

    public function like(){
        return $this->hasMany(Like::class);
    }

    public function thread(){
        return $this->belongsTo(Thread::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function UpdateComment($thread_id, $body){
        $this->thread_id = $thread_id;
        $this->body = $body;
        $this->save();
    }
}
