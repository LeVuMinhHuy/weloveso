<?php

namespace weloveso\Http\Controllers;

use Auth;
use weloveso\Models\User;
use weloveso\Models\ppMarkerMap;
use Illuminate\Http\Request;
/**
 * 
 */
class ppMarkerController extends Controller
{
	
	public function getStory(Request $request){
		$this->validate($request,[ 
			'ppMarker' => 'required|max:5000',
		]);

		Auth::user()->ppMarker()->create([
			'body' => $request->input('story'),
		]);

		$ppMarker = ppMarkerMap()->getppMarker();

		return view('companies.createLocations')
				->with('ppMarker', $ppMarker);
				
	}

}