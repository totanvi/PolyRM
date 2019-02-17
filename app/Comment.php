<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'rm_comment';
	protected $primaryKey = 'comment_id';
    protected $fillable = [
		'comment_id',
		'comment_content',	
		'approve',
		'user_id',
    ];

	public function property()
    {
        return $this->belongsTo('App\Property', 'property_id');
	}
	public function post()
    {
        return $this->belongsTo('App\Property', 'post_id');
	}
	public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
	}
}
