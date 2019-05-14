<?php

namespace weloveso\Http\Controllers;

use Auth;
use weloveso\Models\User;
use weloveso\Models\ppMarkerMap;
use Illuminate\Http\Request;
/**
 * 
 */
class CompanyController extends Controller
{
	
	public function storeLocations(Request $request){
		$ppMarker = Auth::user()->getppMarker();

		return view('companies.map')
				->with('ppMarker', $ppMarker);
	}

	public function groupLocations(Request $request){
		return view('companies.createLocations');
	}
}
