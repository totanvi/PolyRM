<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Validator;
use Auth;
use Datatables;
use Illuminate\Support\Str;

class PostController extends Controller
{
	private function createSlug($str) {
		$str = trim(mb_strtolower($str));
		$str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
		$str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
		$str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
		$str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
		$str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
		$str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
		$str = preg_replace('/(đ)/', 'd', $str);
		$str = preg_replace('/[^a-z0-9-\s]/', '', $str);
		$str = preg_replace('/([\s]+)/', '-', $str);
		return $str;
	}

	public function Create() {
		return view('Admin.Post.create');
	}

	public function CreatePost(Request $request) {
		$validator = Validator::make($request->all(), [
            'post_title' => 'required|max:191',
            'post_description' => 'required|max:300',
            'post_content' => 'required|min:100',
        ], [
			'required' => 'Trường này không được bỏ trống',
			'post_title.max' => 'Tiêu đề quá dài',
			'post_description.max' => 'Mô tả ngắn quá dài',
			'post_content.min' => 'Nội dung quá ngắn',
		]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
		}
		$check = Post::where('slug', $this->createSlug($request->post_title))->first();
		if(!$check) {
			$post = new Post;
			$post->post_title = $request->post_title;
			$post->post_description = $request->post_description;
			$post->post_content = $request->post_content;
			$post->slug = $this->createSlug($request->post_title);
			$post->user_id = Auth::user()->id;
			if($request->post_image) {
				$fileExtension = $request->post_image[0]->getClientOriginalExtension(); // Lấy . của file
				$fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
				$uploadPath = public_path('/upload'); 
				$request->post_image[0]->move($uploadPath, $fileName);
				$post->post_image = $fileName;
			}else {
				$post->post_image = 'post_image_default.jpg';
			}
			$post->save();
			return response()->json(['success'=>'Record is successfully added']);
		}else {
			return response()->json(['unique_slug'=>$validator->errors()]);
		}
		
	}

	public function List() {
		return view('Admin.Post.list');
	}

	public function Datatable(Request $request) {
		$post = Post::with('user')->orderBy('post_id', 'desc')->get();
		$array = [];
		foreach($post as $key => $value) {
			$array_tmp['stt'] = $key+1;
			$array_tmp['post_title'] = $value->post_title;
			$array_tmp['post_description'] = $value->post_description;
			$array_tmp['post_id'] = $value->post_id;
			$array_tmp['user_post'] = $value->user->fullname;
			array_push($array,$array_tmp);
		}
		return Datatables::of($array)
		->filter(function ($instance) use ($request) {
			if ($request->get('post_title')) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['post_title'], $request->get('post_title')) ? true : false;
				});
			}

			if ($request->get('post_description')) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['post_description'], $request->get('post_description')) ? true : false;
				});
			}

			if ($request->get('user_post')) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['user_post'], $request->get('user_post')) ? true : false;
				});
			}
		})
		->addColumn('action', function ($action) {
			return '
				<a href="'.route('PostEdit', $action['post_id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Sửa</a>
				<a href="#" onclick="deletePost('.$action['post_id'].'); return false" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Xóa</a>		
			';
		})
		->make(true);
	}

	public function Edit(Request $request, $id) {
		$post = Post::findOrFail($id);
		return view('Admin.Post.edit', compact('post'));
	}

	public function EditPost(Request $request, $id) {
		$validator = Validator::make($request->all(), [
            'post_title' => 'required|max:191',
            'post_description' => 'required|max:300',
            'post_content' => 'required|min:100',
        ], [
			'required' => 'Trường này không được bỏ trống',
			'post_title.max' => 'Tiêu đề quá dài',
			'post_description.max' => 'Mô tả ngắn quá dài',
			'post_content.min' => 'Nội dung quá ngắn',
		]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
		}
		$post = Post::findOrFail($id);
		$check = true;
		if($post->slug == $this->createSlug($request->post_title)) {
			$check = true;
		}else {
			$check2 = Post::where('slug', $this->createSlug($request->post_title))->first();
			if($check2) $check = false;
		}
		if($check) {
			$post->post_title = $request->post_title;
			$post->post_description = $request->post_description;
			$post->post_content = $request->post_content;
			$post->slug = $this->createSlug($request->post_title);
			$post->user_id = Auth::user()->id;
			if($request->post_image) {
				$fileExtension = $request->post_image[0]->getClientOriginalExtension(); // Lấy . của file
				$fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
				$uploadPath = public_path('/upload'); 
				$request->post_image[0]->move($uploadPath, $fileName);
				$post->post_image = $fileName;
			}
			$post->save();
			return response()->json(['success'=>'Record is successfully added']);
		}else {
			return response()->json(['unique_slug'=>$validator->errors()]);
		}
	}

	public function Delete(Request $request, $id) {
		Post::find($id)->delete();
		return response()->json(['success'=>'Record is successfully added']);
	}
}
