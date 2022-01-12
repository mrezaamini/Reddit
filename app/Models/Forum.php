<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;
    protected $guarded=[
        'id','created_at','updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function joinedUsers()
    {
        return $this->belongsToMany(User::class,'forum_user_join','forum_id');
    }
    public function isUserJoined($user)
    {
        return $this->joinedUsers()->where('user_id',$user->id)->exists();
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function admins()
    {
        return $this->belongsToMany(User::class,'forum_user_admin','forum_id');
    }
    public function isUserIsAdmin($user)
    {
        return $this->admins()->where('user_id',$user->id)->exists();
    }
}
