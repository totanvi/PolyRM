<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Datatables;
use Illuminate\Support\Str;
use Validator;
use Response;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function index(Request $request) {
		return view('Admin.User.index');
	}

	public function DatableUser(Request $request) {
		$user = User::all();
		$array = [];
		foreach($user as $key => $value) {
			$array_tmp['stt'] = $key+1;
			$array_tmp['fullname'] = $value->fullname;
			$array_tmp['username'] = $value->username;
			$array_tmp['email'] = $value->email;
			$array_tmp['id'] = $value->id;
			$array_tmp['searchrole'] = $value->role;
			if($value->role == 1) {
				$array_tmp['role'] = 'Chủ phòng trọ';
			}else if($value->role == 0) {
				$array_tmp['role'] = 'Thành viên thường';
			}else if($value->role == 10) {
				$array_tmp['role'] = 'Quản trị viên';
			}
			array_push($array,$array_tmp);
		}
		return Datatables::of($array)
		->filter(function ($instance) use ($request) {
			if ($request->get('fullname')) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['fullname'], $request->get('fullname')) ? true : false;
				});
			}

			if ($request->get('email')) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['email'], $request->get('email')) ? true : false;
				});
			}

			if ($request->get('username')) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['username'], $request->get('username')) ? true : false;
				});
			}

			if ($request->get('role') || $request->get('role') == "0") {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['searchrole'], $request->get('role')) ? true : false;
				});
			}
		})
		->addColumn('action', function ($action) {
			return '
				<a href="'.route('UserView', $action['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Sửa</a>
				<a href="#" onclick="deleteUser('.$action['id'].'); return false" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Xóa</a>		
			';
		})
		->make(true);
	}

	public function View(Request $request, $id) {
		$user = User::findOrFail($id);
		return view('Admin.User.edit', compact('user'));
	}

	public function ViewPost(Request $request, $id) {
		$validator = validator::make($request->all(),[
            'fullname' => 'required|max:100',
			'phone' => 'required|numeric',
			'role' => 'required',
        ],[
			'required' => 'Trường này không được bỏ trống',
			'phone.numeric' => 'Không đúng định dạng',
			'fullname.max' => 'Tên quá dài',
        ]);
		if($validator->fails()) {
			return Response::json(['errors' => $validator->errors()]);
		}
		$user = User::findOrFail($id);
		$user->fullname = $request->fullname;
		$user->phone = $request->phone;
		if($request->role == 1) {
			$user->role = 1;
		}else if($request->role == 0) {
			$user->role = 0;
		}else if($request->role == 10) {
			$user->role = 10;
		}else {
			return Response::json(['errors' => 'Register Fail']);
		}
		if($request->has('password')) {
			if(strlen($request->password) > 5) {
				if($request->password == $request->password_c) {
					$user->password = Hash::make($request->password);
				}else {
					return Response::json(['errors_password' => 'Mật khẩu không khớp']);
				}
			}else {
				return Response::json(['errors_password' => 'Mật khẩu quá ngắn']);
			}
		}
		$user->save();
		return response()->json(['success'=>'Record is successfully added']);
	}

	public function Create(Request $request) {
		return view('Admin.User.create');
	}
	public function CreatePost(Request $request) {
		$validator = validator::make($request->all(),[
            'fullname' => 'required|max:100',
			'email' => 'required|email|unique:rm_users|max:100',
			'username' => 'required|unique:rm_users|max:50',
			'password' => 'required|min:6|confirmed',
			'phone' => 'required|numeric',
			'role' => 'required',
        ],[
			'required' => 'Trường này không được bỏ trống',
			'email' => 'Email không đúng định dạng',
			'email.unique' => 'Email đã có người dùng',
			'username.max' => 'Tên đăng nhập quá dài',
			'username.unique' => 'Tên đăng nhập đã có người dùng',
			'password.min' => 'Mật khẩu quá ngắn',
			'password.confirmed' => 'Mật khẩu không khớp',
			'phone.numeric' => 'Không đúng định dạng',
			'fullname.max' => 'Tên quá dài',
			'email.max' => 'Email quá dài',
        ]);
		if($validator->fails()) {
			return Response::json(['errors' => $validator->errors()]);
		}
		$user = new User;
		$user->fullname = $request->fullname;
		$user->email = $request->email;
		$user->username = $request->username;
		$user->password = Hash::make($request->password);
		$user->phone = $request->phone;
		if($request->role == 1) {
			$user->role = 1;
		}else if($request->role == 0) {
			$user->role = 0;
		}else if($request->role == 10) {
			$user->role = 10;
		}else {
			return Response::json(['errors' => 'Register Fail']);
		}
		$user->save();
		return Response::json(['success' => 'Register Success']);
	}

	public function Delete(Request $request, $id) {
		User::findOrFail($id)->delete();
		return response()->json(['success'=>'Record is successfully added']);
	}
}
