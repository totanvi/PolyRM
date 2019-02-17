<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $table = 'rm_menu';
	protected $primaryKey = 'menu_id';
    protected $fillable = [
        'menu_id', 'menu_parent_id', 'order_by', 'title', 'url', 'role', 'is_show', 'css_class'
	];
	
	public static function Menu() {
		$menu = static::where('is_show', 1)->orderBy('order_by', 'asc')->get();
		return $menu;
	}
}
