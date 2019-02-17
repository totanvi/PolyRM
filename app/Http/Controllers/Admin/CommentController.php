<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Datatables;
use Illuminate\Support\Str;

class CommentController extends Controller
{
	public function index(Request $request) {
		return view('Admin.Comment.index');
	}

	public function Datatable(Request $request) {
		$comment = Comment::with('user','property')->orderBy('comment_id', 'desc')->get();
		$array = [];
		foreach($comment as $key => $value) {
			$array_tmp['stt'] = $key+1;
			$array_tmp['comment_id'] = $value->comment_id;
			$array_tmp['comment_content'] = $value->comment_content;
			$array_tmp['comment_at_property'] = $value->property->property_title;
			$array_tmp['comment_user'] = $value->user->fullname;
			$array_tmp['approve'] = $value->approve;
			if($value->approve == 1) {
				$array_tmp['status'] = 'Đã duyệt';
			}else $array_tmp['status'] = 'Chưa duyệt';
			array_push($array,$array_tmp);
		}
		return Datatables::of($array)
		->filter(function ($instance) use ($request) {
			if ($request->get('comment_at_property')) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['comment_at_property'], $request->get('comment_at_property')) ? true : false;
				});
			}

			if ($request->get('comment_content')) {
				$instance->collection = $instance->collection->filter(function ($row) use ($request) {
					return Str::contains($row['comment_content'], $request->get('comment_content')) ? true : false;
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
				$approve = 'onclick="approve('.$action['comment_id'].'); return false;"';
			}else {
				$approve ='disabled';
			}
			return '
				<a href="#"'.$approve.' class="btn btn-xs btn-primary approveBtn"><i class="glyphicon glyphicon-check"></i> Duyệt</a>
				<a href="#" onclick="deleteComment('.$action['comment_id'].'); return false" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Xóa</a>		
			';
		})
		->make(true);
	}

	public function Approve(Request $request, $id) {
		if($request->approve == '1') {
			$comment = Comment::findOrFail($id);
			$comment->approve = 1;
			$comment->save();
		}
		return response()->json(['success'=>'Record is successfully added']);
	}
	public function Delete(Request $request, $id) {
		Comment::findOrFail($id)->delete();
		return response()->json(['success'=>'Record is successfully added']);
	}
}
