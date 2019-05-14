<?php

namespace weloveso\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Status extends Model
{

	protected $table = 'statuses';

	protected $fillable = [
		'body',
		'image',
		'hashtag',
		'isHot'
	];

	public function user(){
		return $this->belongsTo('weloveso\Models\User', 'user_id');
	}

	public function scopeNotReply($query){
		return $query->whereNull('parent_id');
	}

	public function replies(){
		return $this->hasMany('weloveso\Models\Status', 'parent_id');
	}
	public function getImage(){
		return $this->image;
	}
	public function getHashtag(){
		return $this->hashtag;
	}
	public function isHot(){
		return $this->isHot;
	}
	public function likes(){
		return $this->morphMany('weloveso\Models\Like', 'Likeable');
	}
}
