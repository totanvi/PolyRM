<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = 'rm_post';
	protected $primaryKey = 'post_id';
    protected $fillable = [
		'user_id',
		'post_description',	
		'post_title',
		'post_content',
		'post_image',
		'slug',
		'created_at',
		'updated_at',
	];
	public function user()
    {
        return $this->belongsTo('App\User');
	}
	public function comment()
    {
        return $this->hasMany('App\Comment', 'comment_id');
	}
}
