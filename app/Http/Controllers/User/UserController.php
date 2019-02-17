<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;
use Response;
use Auth;
use App\User;
use App\Property;
use Illuminate\Foundation\Console\Presets\React;

class UserController extends Controller
{
	public function username() {
        return 'username';
	}

    public function Register(Request $request) {
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
		}else {
			return Response::json(['errors' => 'Register Fail']);
		}
		$user->save();
		return Response::json(['success' => 'Register Success']);
	}

	public function Login(Request $request) {
		$validator = validator::make($request->all(),[
			'username' => 'required',
			'password' => 'required',
        ],[
			'required' => 'Trường này không được bỏ trống',
        ]);
		if($validator->fails()) {
			return Response::json(['errors' => $validator->errors()]);
		}
		$data=[
    		'username' => $request->username,
    		'password' => $request->password,
    	];
    	if(Auth::attempt($data)){
    		return Response::json(['success' => 'Login Success']);
    	}else{
    		return Response::json(['errors' => 'Login Fail']);
    	}
	}

	public function Logout(Request $request) {
		Auth::logout();
		return Response::json(['success' => 'Logout Success']);
	}

	public function Profile(Request $request) {
		return view('User.profile');
	}

	public function ProfileSave(Request $request) {
		$validator = validator::make($request->all(),[
            'fullname' => 'required|max:100',
			'phone' => 'required|numeric',
        ],[
			'required' => 'Trường này không được bỏ trống',
			'phone.numeric' => 'Không đúng định dạng',
			'fullname.max' => 'Tên quá dài',
        ]);
		if($validator->fails()) {
			return Response::json(['errors' => $validator->errors()]);
		}
		$user = User::find(Auth::user()->id);
		$user->fullname = $request->fullname;
		$user->phone = $request->phone;
		if($request->has('password')) {
			if(strlen($request->password) > 5) {
				if($request->password == $request->password_confirmation) {
					$user->password = Hash::make($request->password);
				}else {
					return Response::json(['errors_password' => 'Mật khẩu không khớp']);
				}
			}else {
				return Response::json(['errors_password' => 'Mật khẩu quá ngắn']);
			}
		}
		if($request->has('avatar')) {
			$images = $request->avatar;
			$fileExtension = $images->getClientOriginalExtension(); // Lấy . của file
			$fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
			$uploadPath = public_path('/upload'); 
			$images->move($uploadPath, $fileName);
			$user->avatar = $fileName;
		}
		$user->save();
		return response()->json(['success'=>'Record is successfully added']);
	}

	public function ProfileList(Request $request) {
		$listProperty = Property::where('user_id', Auth::user()->id)->orderBy('property_id', 'desc')->paginate(10);
		return view('User.Property.list', compact('listProperty'));
	}

	public function LoginAdmin(Request $request) {	
		$validator = validator::make($request->all(),[
			'username' => 'required',
			'password' => 'required',
        ],[
			'required' => 'Trường này không được bỏ trống',
        ]);
		if($validator->fails()) {
			return Response::json(['errors' => $validator->errors()]);
		}
		$data=[
    		'username' => $request->username,
			'password' => $request->password,
			'role' => 10
    	];
    	if(Auth::attempt($data)){
    		return Response::json(['success' => 'Login Success']);
    	}else{
    		return Response::json(['errors' => 'Login Fail']);
    	}
	}

	public function LoginAdminPage(Request $request) {
		if(Auth::check() && Auth::user()->role == 10) {
			return redirect()->route('Dashboard');
		}
		return view('Admin.login');
	}
}
