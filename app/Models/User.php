<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
	use HasFactory;
	use HasRoles;

	protected $guarded = [
		'id', 'created_at', 'updated_at'
	];

	public function forums()
	{
		return $this->hasMany(Forum::class);
	}

	public function joinedForums()
	{
		return $this->belongsToMany(Forum::class, 'forum_user_join', 'user_id');
	}

	public function isJoinedForum($forum)
	{
		return $this->joinedForums()->where('forum_id', $forum->id)->exists();
	}

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function forumsPosts()
	{
		return $this->hasManyThrough(Post::class, Forum::class);
	}

	public function forumsAdmin()
	{
		return $this->belongsToMany(Forum::class, 'forum_user_admin', 'user_id');
	}

	public function isForumAdmin($forum)
	{
		return $this->forumsAdmin()->where('forum_id', $forum->id)->exists();
	}

	public function forumsBlock()
	{
		return $this->belongsToMany(Forum::class, 'forum_user_block', 'user_id');
	}

	public function isForumBlock($forum)
	{
		return $this->forumsBlock()->where('forum_id', $forum->id)->exists();
	}

	public function savedPosts()
	{
		return $this->belongsToMany(Post::class,'post_user_save','user_id');
	}
}
