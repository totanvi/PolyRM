<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
	protected $table = 'rm_district';
	protected $primaryKey = 'district_id';
    protected $fillable = [
		'district_id',
		'district_name',	
		'district_type',
		'city_id',
    ];

	public function city()
    {
        return $this->belongsTo('App\City');
	}
	public function ward()
    {
        return $this->hasMany('App\Ward');
	}
	public function property()
    {
        return $this->belongsToMany('App\Property');
    }
}
