<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'rm_area';
	protected $primaryKey = 'area_id';
    protected $fillable = [
		'area_id',
		'area_start',	
		'area_end',
		'area_type',
    ];

	public function property()
    {
        return $this->hasMany('App\Property');
	}
}
