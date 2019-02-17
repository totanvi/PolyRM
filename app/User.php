<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'rm_users';
	protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'fullname', 'email', 'username', 'password', 'phone', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
	];
	
	public function property()
    {
        return $this->hasMany('App\Property', 'property_id');
	}
	
	public function comment()
    {
        return $this->hasMany('App\Comment', 'comment_id');
	}
	
	public function isAdmin()
	{
		return $this->role == 10; 
	}
}
