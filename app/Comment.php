<?php

namespace App;

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

    public function ChangeComment($body){

        $this->body = $body;

        $this->save();
    }


}
