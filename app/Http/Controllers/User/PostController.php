<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
	public function index() {
		$posts = Post::orderBy('post_id', 'desc')->paginate(10);
		return view('User.Post.index', compact('posts'));
	}

	public function PostDetail(Request $request, $slug) {
		$posts = Post::select('post_id', 'post_image', 'post_title', 'created_at', 'slug')->orderBy('post_id', 'desc')->limit(10)->get();
		$post = Post::where('slug', $slug)->firstOrFail();
		return view('User.Post.detail', compact('post', 'posts'));
	}
}
