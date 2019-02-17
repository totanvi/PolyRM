<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	protected $table = 'rm_city';
	protected $primaryKey = 'city_id';
    protected $fillable = [
		'city_id',
		'city_name',	
		'city_type',
    ];
	public function district()
    {
        return $this->hasMany('App\District');
    }
}
