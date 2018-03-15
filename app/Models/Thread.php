<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected $fillable = [
        'title', 'body',
    ];

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subscriber()
    {
        return $this->hasMany(Subscriber::class);
    }

    public function UpdateThread($body){
        $this->body = $body;
        $this->save();
    }

    public function GetAll(){
        return $this->orderBy('created_at','desc')->paginate(10);
    }

    public function GetAllComments(){
        $comments = $this->comment()->orderBy('created_at', 'desc')->with('user', 'like')->get();
        return $comments;
    }
}
