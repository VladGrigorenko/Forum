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

    public function GetAllComment($id){
        $comments = Comment::orderBy('created_at','desc')->where('thread_id', '=',$id)->get();
        return $comments;
    }

    public function ChangeComment($body){

        $this->body = $body;

        $this->save();
    }


}
