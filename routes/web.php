<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'User\HomeController@Home')->name('Home');

Route::post('/register', 'User\UserController@Register')->name('Register');
Route::post('/login', 'User\UserController@Login')->name('Login');
Route::get('/logout', 'User\UserController@Logout')->name('Logout');
Route::post('/select', 'User\HomeController@SelectSearch');

Route::get('/rentmotel', 'User\PropertyController@Rentmotel')->name('Rentmotel');
Route::get('/rentmotel/search', 'User\PropertyController@RentMotel')->name('RentmotelSearch');
Route::get('/moteldetail/{id}', 'User\PropertyController@MotelDetail')->name('MotelDetail');

Route::get('/contact', 'User\HomeController@Contact')->name('Contact');

Route::get('/post', 'User\PostController@index')->name('Post');
Route::get('/post/{slug}', 'User\PostController@PostDetail')->name('PostDetail');
	
Route::middleware('checkLogin')->group(function () {
	Route::get('/property/create', 'User\PropertyController@AddProperty')->name('AddProperty');
	Route::post('/property/create', 'User\PropertyController@AddPropertyPost')->name('AddPropertyPost');
	Route::post('/property/comment', 'User\PropertyController@AddComment')->name('AddComment');
	Route::get('/profile', 'User\UserController@Profile')->name('Profile');
	Route::post('/profile', 'User\UserController@ProfileSave')->name('ProfileSave');
	Route::get('/profile/list', 'User\UserController@ProfileList')->name('ProfileList');
	Route::get('/property/edit/{id}', 'User\PropertyController@EditProperty')->name('EditProperty');
	Route::post('/property/edit/{id}', 'User\PropertyController@EditPropertyPost')->name('EditPropertyPost');
	Route::get('/property/delete/{id}', 'User\PropertyController@DeletePropertyPost')->name('DeletePropertyPost');
});

Route::get('/rm-admin', 'User\UserController@LoginAdminPage')->name('LoginAdminPage');
Route::post('/rm-admin', 'User\UserController@LoginAdmin')->name('LoginAdmin');
Route::group(['prefix' => 'rm-admin',  'middleware' => 'isAdmin'], function() {
	Route::get('/dashboard', 'Admin\DashboardController@Dashboard')->name('Dashboard');

	Route::get('/rentmotel', 'Admin\RentMotelController@index')->name('ListRentMotel');
	Route::post('/rentmotel/datatable', 'Admin\RentMotelController@Datatable')->name('Datatable');
	Route::get('/rentmotel/view/{id}', 'Admin\RentMotelController@View')->name('ListRentMotelView');
	Route::post('/rentmotel/view/{id}', 'Admin\RentMotelController@ViewPost')->name('ListRentMotelViewPost');
	Route::get('/rentmotel/delete/{id}', 'Admin\RentMotelController@Delete')->name('ListRentMotelDelete');

	Route::get('/findpeople', 'Admin\FindPeopleController@index')->name('FindPeople');
	Route::post('/findpeople/datatable', 'Admin\FindPeopleController@Datatable')->name('DatatableFindPeople');
	Route::get('/findpeople/view/{id}', 'Admin\FindPeopleController@View')->name('FindPeopleView');
	Route::post('/findpeople/view/{id}', 'Admin\FindPeopleController@ViewPost')->name('FindPeopleViewPost');
	Route::get('/findpeople/delete/{id}', 'Admin\FindPeopleController@Delete')->name('FindPeopleDelete');

	Route::get('/comment', 'Admin\CommentController@index')->name('Comment');
	Route::post('/comment/datatable', 'Admin\CommentController@Datatable')->name('CommentDatatable');
	Route::post('/comment/approve/{id}', 'Admin\CommentController@Approve')->name('CommentApprove');
	Route::get('/comment/delete/{id}', 'Admin\CommentController@Delete')->name('CommentDelete');

	Route::get('/user', 'Admin\UserController@index')->name('User');
	Route::post('/user/datatable', 'Admin\UserController@DatableUser')->name('DatableUser');
	Route::get('/user/view/{id}', 'Admin\UserController@View')->name('UserView');
	Route::post('/user/view/{id}', 'Admin\UserController@ViewPost')->name('UserViewPost');
	Route::get('/user/create', 'Admin\UserController@Create')->name('UserCreate');
	Route::post('/user/create', 'Admin\UserController@CreatePost')->name('UserCreatePost');
	Route::get('/user/delete/{id}', 'Admin\UserController@Delete')->name('UserDelete');

	Route::get('/post/create', 'Admin\PostController@Create')->name('PostCreate');
	Route::post('/post/create', 'Admin\PostController@CreatePost')->name('PostCreatePost');
	Route::get('/post/list', 'Admin\PostController@List')->name('PostList');
	Route::post('/post/list/datatable', 'Admin\PostController@Datatable')->name('PostDatable');
	Route::get('/post/edit/{id}', 'Admin\PostController@Edit')->name('PostEdit');
	Route::post('/post/edit/{id}', 'Admin\PostController@EditPost')->name('PostEditPost');
	Route::get('/post/delete/{id}', 'Admin\PostController@Delete')->name('PostDelete');
});
// Route::get('/{any}', function ($any) {
// 	return redirect()->route('Home');
// })->where('any', '.*');
