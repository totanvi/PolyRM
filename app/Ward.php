<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
	protected $table = 'rm_wards';
	protected $primaryKey = 'ward_id';
    protected $fillable = [
		'ward_id',
		'ward_name',	
		'ward_type',
		'district_id',
    ];

	public function district()
    {
        return $this->belongsTo('App\District');
	}
}
