<?php

namespace weloveso\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class ppMarkerMap extends Model
{
	
	protected $table = 'pp_marker';

	protected $fillable = [
		'body'
	];

	public function user(){
		return $this->belongsTo('weloveso\Models\User', 'user_id');
	}

	public function getppMarker(){
		$pp = ppMarkerMap::all();
		return $pp;
	}
}