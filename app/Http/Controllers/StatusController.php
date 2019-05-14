<?php

namespace weloveso\Http\Controllers;

use Auth;
use weloveso\Models\User;
use weloveso\Models\Status;
use Illuminate\Http\Request;
/**
 *
 */
class StatusController extends Controller
{

	public function postStatus(Request $request){
		$this->validate($request,[
			'status' => 'required|max:5000',
			'post_image' => 'image'

		]);


		if ($request->hasFile('post_image')) {
			$image = $request->file('post_image');
        	$name = time().'.'.$image->getClientOriginalExtension();
        	$destinationPath = public_path('user');
       	 	$image->move($destinationPath, $name);
			Auth::user()->statuses()->create([
				'body' => $request->input('status'),
				'hashtag' => $request->input('hashtag'),
				'image' 	=>	"/public/user".'/'.$name,
			]);
		}
		else{
			Auth::user()->statuses()->create([
				'body' => $request->input('status'),
				'hashtag' => $request->input('hashtag')
			]);
		}
		return redirect()
				->route('home');

	}

	public function postReply(Request $request, $statusId){
		$this->validate($request, [
			"reply-{$statusId}" => 'required|max:1000',
		], [
			'required' => '??'
		]);

		$status = Status::notReply()->find($statusId);

		if(!$status){
			return redirect()->route('home');
		}

		if(!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id){
			return redirect()->route('home');
		}

		$reply = Status::create([
			'body' => $request->input("reply-{$statusId}"),
		])->user()->associate(Auth::user());

		$status->replies()->save($reply);

		return redirect()->back();
	}

	public function getLike($statusId)
	{
			$status = Status::find($statusId);

			if (!$status) {
				return redirect()->route('home');
			}

			if (!Auth::user()->isFriendsWith($status->user)) {
				return redirect()->route('home');
			}

			if(Auth::user()->hasLikedStatus($status)) {
				return redirect()->back();
			}

			$like = $status->likes()->create([]);
			Auth::user()->likes()->save($like);

			return redirect()->back();
	}
}
