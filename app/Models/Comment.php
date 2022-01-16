<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded=[
        'id','created_at','updated_at'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function reply()
    {
        return $this->hasOne(Comment::class,'comment_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function usersLike()
    {
        return $this->belongsToMany(User::class,'comment_user_like','comment_id');
    }
    public function isUserLike($user)
    {
        return $this->usersLike()->where('user_id',$user->id)->exists();
    }
    public function usersDislike()
    {
        return $this->belongsToMany(User::class,'comment_user_dislike','comment_id');
    }
    public function isUserDislike($user)
    {
        return $this->usersDislike()->where('user_id',$user->id)->exists();
    }
}
