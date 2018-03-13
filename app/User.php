<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function thread()
    {
        return $this->hasMany(Thread::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function subscriber()
    {
        return $this->hasMany(Subscriber::class);
    }

    public function like()
    {
        return $this->hasMany(Like::class);
    }

    public function publish(Thread $thread)
    {
        $this->thread()->save($thread);
    }

    public function Subscribe(Subscriber $subscriber){
        $this->subscriber()->save($subscriber);
    }

    public function PublishComment(Comment $comment)
    {
        $this->comment()->save($comment);
    }

    public function SetLike(Like $like)
    {
        $this->like()->save($like);
    }

    public function DeleteLike($id)
    {
        $this->like()->where('comment_id', '=', $id)->delete();
    }

    public function DeleteComment($id)
    {
        $this->DeleteLike($id);
        $this->comment()->where('id', '=', $id)->delete();
    }

    public function DeleteThread($id)
    {
        $comments = Comment::where('thread_id', '=', $id)->get();
        foreach ($comments as $comment){
            $this->DeleteComment($comment->id);
        }
        if(count(Subscriber::where('thread_id', '=', $id)->get())){
            $this->DeleteSub($id);
        }
        $this->thread()->where('id', '=', $id)->delete();
    }

    public function DeleteSub($thread_id){
        $id = $this->subscriber()->where('thread_id', '=', $thread_id)->get()->first()->id;

        $this->subscriber()->where('id', '=', $id)->delete();
    }

    public function ChangePassword($password)
    {
        $this->password = Hash::make($password);
        $this->save();
    }

    public function SetAvatar($avatar_name){
        $this->avatar = $avatar_name;
        $this->save();
    }


}
