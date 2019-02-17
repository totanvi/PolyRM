<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'rm_property';
	protected $primaryKey = 'property_id';
    protected $fillable = [
		'property_id',
		'property_title',	
		'property_description',
		'property_location',
		'property_bedroom',	
		'property_bathroom',	
		'property_area',	
		'property_price',
		'property_image',
		'city_id',
		'district_id',
		'area_id',
		'price_id',
		'user_id',
    ];

	public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
	}
	public function image()
    {
        return $this->hasMany('App\PropertyImage', 'property_id');
	}
	public function comment()
    {
        return $this->hasMany('App\Comment', 'comment_id');
	}
	public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
	}
	public function district()
    {
        return $this->belongsTo('App\District', 'district_id');
	}
	public function ward()
    {
        return $this->belongsTo('App\Ward', 'ward_id');
	}
}
