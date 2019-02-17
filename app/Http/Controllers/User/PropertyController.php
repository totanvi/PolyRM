<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\Property;
use App\District;
use App\PropertyImage;
use App\Price;
use App\Area;
use App\User;
use App\Comment;
use Validator;
use Auth;

class PropertyController extends Controller
{
    public function AddProperty(Request $request) {
		$city = City::all();
		return view('User.Property.create', compact('city'));
	}
	public function AddPropertyPost(Request $request)
    {
		$validator = Validator::make($request->all(), [
            'property_title' => 'required|max:255',
            'property_description' => 'required',
            'property_type' => 'required',
            'property_location' => 'required',
            'property_phone' => 'required',
            'property_city' => 'required',
            'property_district' => 'required',
            'property_bedroom' => 'required|numeric|max:100|min:1',
            'property_bathroom' => 'required|numeric|max:100|min:1',
            'property_area' => 'required|numeric|max:1000|min:1',
            'property_price' => 'required|numeric|min:1',
        ], [
			'required' => 'Trường này không được bỏ trống',
			'max' => 'Số quá lớn',
			'min' => 'Số không được nhỏ hơn 1',
		]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
		}
		$property = new Property;
		$property->user_id = Auth::user()->id;
		$property->property_title = $request->property_title;
		$property->property_description = $request->property_description;
		if($request->property_type == "0") {
			if(Auth::user()->role == 1 || Auth::user()->role == 10) {
				$property->property_type = 0;
			}else {
				return response()->json(['errors'=>'errors']);
			}
		}elseif($request->property_type == "1") {
			$property->property_type = 1;
		}else {
			return response()->json(['errors'=>'errors']);
		}
		$city = City::where('city_name', $request->property_city)->first();
		$property->city_id = $city->city_id;
		$property->district_id = $request->property_district;
		$property->property_location = $request->property_location;
		$property->property_bedroom = $request->property_bedroom;
		$property->property_bathroom = $request->property_bathroom;
		$property->property_phone = $request->property_phone;
		$property->property_area = $request->property_area;
		$property->property_price = $request->property_price;
		$area = Area::where('area_start', '<', $request->property_area)
					->where('area_end', '>', $request->property_area)
					->first();
		if($area) {
			$property->area_id = $area->area_type;
		}else $property->area_id = 0;
		$price = Price::where('price_start', '<', $request->property_price)
					->where('price_end', '>', $request->property_price)
					->first();
		if($price) {
			$property->price_id = $price->price_type;
		} else $property->price_id = 0;
		$property->property_image = 'image_default.jpg';
		$property->latitude = $request->latitude;
		$property->longitude = $request->longitude;
		$property->save();
		if($request->property_image) {
			foreach($request->property_image as $key => $images) {
				$image = new PropertyImage;
				$image->property_id = $property->property_id;
				$fileExtension = $images->getClientOriginalExtension(); // Lấy . của file
				$fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
				$uploadPath = public_path('/upload'); 
				$images->move($uploadPath, $fileName);
				$image->image_path = $fileName;
				$image->save();
				if($key == 0) {
					$getProperty = Property::find($property->property_id);
					$getProperty->property_image = $fileName;
					$getProperty->save();
				}
			}
		}else {
			$image = new PropertyImage;
			$image->property_id = $property->property_id;
			$image->image_path = 'image_default.jpg';
			$image->save();
		}
		return response()->json(['success'=>'Record is successfully added']);
	}
	public function RentMotel(Request $request) {
		$city = City::all();
		$district = District::all();
		$property = Property::select('property_title', 'property_price', 'property_location', 'latitude', 'longitude', 'property_image')
					->where('approve', 1)->limit(50)->get();;
		$listProperty = Property::where('approve', 1)->where('property_type', 0)->orderBy('property_id', 'desc')->paginate(10);
		if ($request->has('city')) {
			$listProperty = 
				Property::when(request('city'), function ($query) {
					$query->whereHas('city', function ($query) {
						$query->where('city_name', request('city'));
					});
				})->when(request('district'), function ($query) {
					$query->whereHas('district', function ($query) {
						$query->where('district_name',request('district'));
					});
				})->when(request('price'), function ($query) {
					$query->where('price_id',request('price'));
				})->when(request('area'), function ($query) {
					$query->where('area_id',request('area'));
				})->when(request('ward'), function ($query) {
					$query->where('property_location','like', '%'. request('ward') . '%');
				})->when(request('typeProperty'), function ($query) {
					$query->where('property_type',request('typeProperty'));
				})
				->where('approve', 1)->orderBy('property_id', 'desc')->paginate(10);
		}
		return view('User.rentmotel', compact('city', 'property', 'district', 'listProperty'));
	}
	public function MotelDetail(Request $request, $id) {
		$getProperty = Property::where('approve', 1)->findOrFail($id);
		$user = User::findOrFail($getProperty->user_id);
		$comment = Comment::whereHas('property.user', function($query) use($id) {
			$query->where('property_id', $id)->where('comment_type', 0);
		})->with('user')->where('approve', 1)->get();
		return view('User.moteldetail', compact('getProperty', 'user', 'comment'));
	}

	public function AddComment(Request $request) {
		$validator = Validator::make($request->all(), [
            'comment_content' => 'required|max:500',
        ], [
			'required' => 'Trường này không được bỏ trống',
			'max' => 'Bình luận quá dài',
		]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
		}
		$comment = new Comment;
		$comment->comment_content = $request->comment_content;
		$comment->user_id = Auth::user()->id;
		$comment->property_id =  $request->property_id;
		$comment->save();
		return response()->json(['success'=>'Record is successfully added']);
	}

	public function EditProperty(Request $request, $id) {
		$city = City::all();
		$getProperty = Property::with('city', 'image')->findOrFail($id);
		$this->authorize('view', $getProperty);
		return view('User.Property.edit', compact('getProperty', 'city'));
	}

	public function EditPropertyPost(Request $request, $id) {
		$validator = Validator::make($request->all(), [
            'property_title' => 'required|max:255',
            'property_description' => 'required',
            'property_type' => 'required',
            'property_location' => 'required',
            'property_phone' => 'required',
            'property_city' => 'required',
            'property_district' => 'required',
            'property_bedroom' => 'required|numeric|max:100|min:1',
            'property_bathroom' => 'required|numeric|max:100|min:1',
            'property_area' => 'required|numeric|max:1000|min:1',
            'property_price' => 'required|numeric|min:1',
        ], [
			'required' => 'Trường này không được bỏ trống',
			'max' => 'Số quá lớn',
			'min' => 'Số không được nhỏ hơn 1',
		]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
		}
		$property = Property::find($id);
		$property->user_id = Auth::user()->id;
		$property->property_title = $request->property_title;
		$property->property_description = $request->property_description;
		if($request->property_type == "0") {
			if(Auth::user()->role == 1 || Auth::user()->role == 10) {
				$property->property_type = 0;
			}else {
				return response()->json(['errors'=>'errors']);
			}
		}elseif($request->property_type == "1") {
			$property->property_type = 1;
		}else {
			return response()->json(['errors'=>'errors']);
		}
		$city = City::where('city_name', $request->property_city)->first();
		$property->city_id = $city->city_id;
		$property->district_id = $request->property_district;
		$property->property_location = $request->property_location;
		$property->property_bedroom = $request->property_bedroom;
		$property->property_bathroom = $request->property_bathroom;
		$property->property_phone = $request->property_phone;
		$property->property_area = $request->property_area;
		$property->property_price = $request->property_price;
		$area = Area::where('area_start', '<', $request->property_area)
					->where('area_end', '>', $request->property_area)
					->first();
		if($area) {
			$property->area_id = $area->area_type;
		}else $property->area_id = 0;
		$price = Price::where('price_start', '<', $request->property_price)
					->where('price_end', '>', $request->property_price)
					->first();
		if($price) {
			$property->price_id = $price->price_type;
		} else $property->price_id = 0;
		$property->latitude = $request->latitude;
		$property->longitude = $request->longitude;
		$property->approve = 0;
		$property->save();
		if($request->property_image) {
			foreach($request->property_image as $key => $images) {
				$image = new PropertyImage;
				$image->property_id = $property->property_id;
				$fileExtension = $images->getClientOriginalExtension(); // Lấy . của file
				$fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
				$uploadPath = public_path('/upload'); 
				$images->move($uploadPath, $fileName);
				$image->image_path = $fileName;
				$image->save();
			}
		}
		if($request->image_delete_id) {
			foreach($request->image_delete_id as $key => $value) {
				$checkImage = Property::where('property_image', $request->image_delete_path[$key])->first();
				PropertyImage::find($value)->delete();
				if($checkImage) {
					$property = Property::find($checkImage->property_id);
					$property->property_image = 'image_default.jpg';
					$property->save();
				}
			}
		}
		return response()->json(['success'=>'Record is successfully added']);
	}

	public function DeletePropertyPost(Request $request, $id) {
		Property::find($id)->delete();
		PropertyImage::where('property_id', $id)->delete();
		return redirect()->route('ProfileList');
	}
}
