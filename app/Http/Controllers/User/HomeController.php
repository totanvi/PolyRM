<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City;
use App\District;
use App\Ward;
use App\Property;

class HomeController extends Controller
{
	public function Home() {
		$city = City::all();
		$property = Property::select('property_id', 'property_title', 'property_price', 'property_location', 'latitude', 'longitude', 'property_image')
		->where('property_type', 0)->where('approve', 1)->limit(50)->get();
		$slider = Property::where('property_type', 0)->orderBy('property_id', 'desc')->where('approve', 1)->limit(6)->get();
		return view('User.home', compact('city', 'property', 'slider'));
	}
	public function SelectSearch(Request $request) {
		if($request->city == 1) {
			$city = City::where('city_name', $request->city_name)->first();
			$district = District::where('city_id', $city->city_id)->orderBy('district_name','desc')->get();
			return response()->json(['district'=>$district]);
		}
		if($request->district == 1) {
			$district = District::where('district_name', $request->district_name)->first();
			$ward = Ward::where('district_id', $district->district_id)->orderBy('ward_name','desc')->get();
			return response()->json(['ward'=>$ward]);
		}
		return response()->json(['errors'=>'errors']);
	}

	public function Contact() {
		return view('user.contact');
	}
}
