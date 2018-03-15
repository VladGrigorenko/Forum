<?php

namespace App;

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

    public function getAll(){
        return $this->orderBy('created_at','desc')->get();
    }
}
