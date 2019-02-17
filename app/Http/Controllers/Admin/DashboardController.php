<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Property;
use App\Comment;
class DashboardController extends Controller
{
	public function Dashboard(Request $request) {
		$user = User::count();
		$rentmotel = Property::where('property_type', 0)->count();
		$findPeople = Property::where('property_type', 1)->count();
		$comment = Comment::count();
		return view('Admin.dashboard', compact('user', 'rentmotel', 'findPeople', 'comment'));
	}
}
