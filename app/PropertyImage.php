<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
	protected $table = 'rm_property_image';
	protected $primaryKey = 'image_id';
    protected $fillable = [
        'image_id', 'property_id', 'image_path', 'image_title', 'image_alt'
	];
	public $timestamps = false;

	public function property()
    {
        return $this->belongsTo('App\Property');
	}
	
}
