<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded=[
        'id','created_at','updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
	public function usersReport()
	{
		return $this->belongsToMany(User::class,'post_user_report','post_id')->withPivot('status');
	}
	public function isUserReport($user)
	{
		return $this->usersReport()->where('user_id',$user->id)->exists();
	}
	public function usersLike()
	{
		return $this->belongsToMany(User::class,'post_user_like','post_id');
	}
	public function isUserLike($user)
	{
		return $this->usersLike()->where('user_id',$user->id)->exists();
	}
	public function usersDislike()
	{
		return $this->belongsToMany(User::class,'post_user_dislike','post_id');
	}
	public function isUserDislike($user)
	{
		return $this->usersDislike()->where('user_id',$user->id)->exists();
	}
	public function usersSave()
	{
		return $this->belongsToMany(User::class,'post_user_save','post_id');
	}
	public function isUserSave($user)
	{
		return $this->usersSave()->where('user_id',$user->id)->exists();
	}
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
