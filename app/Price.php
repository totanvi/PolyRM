<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'rm_price';
	protected $primaryKey = 'price_id';
    protected $fillable = [
		'price_id',
		'price_start',	
		'price_end',
		'price_type',
    ];

	public function property()
    {
        return $this->hasMany('App\Property');
	}
}
