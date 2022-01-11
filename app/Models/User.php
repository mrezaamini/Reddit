<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
	use HasFactory;
	use HasRoles;
	protected $guarded=[
		'id','created_at','updated_at'
	];

	public function forums()
    {
        return $this->hasMany(Forum::class);
    }
    public function joinedForums()
    {
        return $this->belongsToMany(Forum::class,'forum_user_join','user_id');
    }
    public function isJoinedForum($forum)
    {
        return $this->joinedForums()->where('forum_id',$forum->id)->exists();
    }
}
