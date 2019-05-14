<?php

namespace weloveso\Http\Controllers;


use Auth;
use weloveso\Models\Status;
use Illuminate\Support\Facades\Input;
/**

 * 
 */


class HomeController extends Controller
{
	
	public function homePage(){
		$value = Input::get('value');
		if(Auth::check() &&  ($value==null)){
			$statuses = Status::notReply()->where(function($query){
				return $query->where('user_id', Auth::user()->id)
							 ->orWhereIn('user_id', Auth::user()->friends()->pluck('id')
							);
			})
			->orderBy('created_at', 'desc')
			->paginate(10); 
			return view('timeline.index')
					->with('statuses', $statuses)
					->with('value',$value);
		}
		else if(Auth::check() && $value!=null){
			$statuses = Status::notReply()->where(function($query) use($value){
				return $query->where('user_id', Auth::user()->id)->where('hashtag',$value)
							 ->orwhereIn('user_id', Auth::user()->friends()->pluck('id'))->where('hashtag',$value);
			})
			->orderBy('created_at', 'desc')
			->paginate(10);
			return view('timeline.index')
					->with('statuses', $statuses)
					->with('value',$value);
		}
		
		return view('home');
	}
}