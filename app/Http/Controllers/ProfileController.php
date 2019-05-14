<?php

namespace weloveso\Http\Controllers;

use Auth;
use weloveso\Models\User;
use Illuminate\Http\Request;
use weloveso\Models\Status;
/**
 *
 */
class ProfileController extends Controller
{

	public function getProfile($username){

		 $user = User::where('username', $username)->first();

		if(!$user){
			abort(404);
		}

		if(Auth::check()){
			$statuses = Status::notReply()->where(function($query) use($user){
				return $query->where('user_id', $user->id);
			})
			->orderBy('created_at', 'desc')
			->paginate(100);

			return view('profile.index')->with('user', $user)
					->with('statuses', $statuses);
		}
	}
	public function getIntro(){
		return view('profile.intro');
	}
	public function postIntro(Request $request){

		$this->validate($request,[
			'first' 								=> 'max:500',
			'first_image'							=>	'image',
		]);
			Auth::user()->update([
				'Introduce' => $request->input('first')
			]);
		if ($request->hasFile('first_image')) {
			$image = $request->file('first_image');
        	$name = time().'.'.$image->getClientOriginalExtension();
        	$destinationPath = public_path('user');
       	 	$image->move($destinationPath, $name);
			Auth::user()->update([
				'IntroImage' 	=>	"/public/user".'/'.$name,
			]);
		}
		$user = Auth::user()->username;
		return redirect()
		->route('profile.index',$user);

	}
	public function getEdit(){
		return view('profile.edit');
	}


	public function postEdit(Request $request){
		$this->validate($request,[
			'last_name'						=>	'max:255',
			'first_name'					=>	'max:255',
			// 'username'					=>	'unique:users|alpha_dash|max:20',
			'password'						=>	'confirmed|min:2',
			'password_confirmation'			=>	'sometimes|required_with:password',
			'company'						=>	'max:255',
			'location'						=>	'max:255',
			'avatar'						=>	'image',
			'cover'							=>	'image',
			// 'email'		=>	'unique:users|email|max:255',
		]);


		if($request->input('password') != Auth::user()->password){
			Auth::user()->update([
				'last_name' 	=>	$request->input('last_name'),
				'first_name' 	=>	$request->input('first_name'),
				'company' 	=>	$request->input('company'),
				'location' 	=>	$request->input('location'),
				'password' 	=>	bcrypt($request->input('password')),
				'password_confirmation' => bcrypt($request->input('password_confirmation')),
				// 'email' 	=>	$request->input('email'),
			]);
		}
		else{

			Auth::user()->update([
				'last_name' 	=>	$request->input('last_name'),
				'first_name' 	=>	$request->input('first_name'),
				'company' 	=>	$request->input('company'),
				'location' 	=>	$request->input('location'),

			]);
		};
		if ($request->hasFile('avatar')) {
			$image = $request->file('avatar');
        	$name = time().'.'.$image->getClientOriginalExtension();
        	$destinationPath = public_path('user');
       	 	$image->move($destinationPath, $name);
			Auth::user()->update([
				'avatar' 	=>	"/public/user".'/'.$name,
			]);
		}
		if ($request->hasFile('cover')) {

			$image = $request->file('cover');
        	$name = time().'.'.$image->getClientOriginalExtension();
        	$destinationPath = public_path('user');
       	 	$image->move($destinationPath, $name);
			Auth::user()->update([
				'cover' 	=>	"/public/user".'/'.$name,
			]);
		}
		return redirect()
			->route('profile.edit')
			->with('info', 'Thay đổi thông tin thành công');
	}



	public function getFriends($username){
		$user = User::where('username', $username)->first();

		if(!$user){
			abort(404);
		}

		return view('profile.friends')->with('user', $user);
	}
}
