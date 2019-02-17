<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Property;
use Datatables;
use Illuminate\Support\Str;

class FindPeopleController extends Controller
{
	public function index(Request $request) {
		return view('Admin.FindPeople.index');
	}

	public function Datatable(Request $request) {
		$property = Property::with('user')->where('property_type', 1)->orderBy('property_id', 'desc')->get();
		$array = [];
		foreach($property as $key => $value) {
			$array_tmp['stt'] = $key+1;
			$array_tmp['property_title'] = $value->property_title;
			$array_tmp['property_location'] = $value->property_location;
			$array_tmp['approve'] = $value->approve;
			$array_tmp['price'] = $value->property_price;
			if($value->approve == 1) {
				$array_tmp['status'] = 'Đã duyệt';
			}else $array_tmp['status'] = 'Chưa duyệt';
			$array_tmp['property_id'] = $value->property_id;
			array_push($array,$array_tmp);
		}
		return Datatables::of($array)
		->filter(function ($instance) use ($request) {
			if ($request->get('title')) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['property_title'], $request->get('title')) ? true : false;
				});
			}

			if ($request->get('location')) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['property_location'], $request->get('location')) ? true : false;
				});
			}

			if ($request->get('price')) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['price'], $request->get('price')) ? true : false;
				});
			}

			if ($request->get('status') || $request->get('status') == "0") {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['approve'], $request->get('status')) ? true : false;
				});
			}
		})
		->addColumn('action', function ($action) {
			$approve = null;
			if($action['status'] =='Chưa duyệt') {
				$approve = 'onclick="approve('.$action['property_id'].'); return false;"';
			}else {
				$approve ='disabled';
			}
			return '
			<a href="'.route('FindPeopleView', $action['property_id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Xem</a>
				<a href="#"'.$approve.' class="btn btn-xs btn-primary approveBtn"><i class="glyphicon glyphicon-check"></i> Duyệt</a>
				<a href="#" onclick="deleteProperty('.$action['property_id'].'); return false" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Xóa</a>		
			';
		})
		->make(true);
	}

	public function View(Request $request, $id) {
		$property = Property::with('city', 'image', 'district', 'user')->findOrFail($id);
		return view('Admin.FindPeople.view', compact('property'));
	}

	public function ViewPost(Request $request, $id) {
		if($request->approve == 0) $approve = 0;
		if($request->approve == 1) $approve = 1;
		$property = Property::findOrFail($id);
		$property->approve = $approve;
		$property->save();
		return response()->json(['success'=>'Record is successfully added']);
	}

	public function Delete(Request $request, $id) {
		Property::findOrFail($id)->delete();
		return response()->json(['success'=>'Record is successfully added']);
	}

}
