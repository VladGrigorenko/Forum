<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;

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
        $sub = new Subscriber();
        $sub->SendEmail($comment->thread_id);
        $this->comment()->save($comment);
    }

    public function SetLike(Like $like)
    {
        $this->like()->save($like);
    }

    public function DeleteLike($comment)
    {
        $this->like()->where('comment_id', '=', $comment->id)->delete();
    }

    public function DeleteSub($thread){
        $id = $this->subscriber()->where('thread_id', '=', $thread->id)->first()->id;
        $this->subscriber()->where('id', '=', $id)->delete();
    }

    public function ChangePassword($password)
    {
        $this->password = Hash::make($password);
        $this->save();
    }

    public function SetAvatar($avatar){
        $manager = new ImageManager();
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        $manager->make($avatar)->resize(300, 300)->save(public_path('/images/' . $filename));
        $this->avatar = $filename;
        $this->save();
    }
}
