<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});

Route::group(['namespace' => 'Posts'], function(){
    Route::pattern('posts','[0-9]+');
    Route::resource('posts','PostsController');
});


Route::get('edit-post/{id}', function ($id) {
    // Let's just pretend we are logged in as the user with ID 1
    Auth::loginUsingId(1);
    // Now let's try to find a post
    $post = App\Post::findOrFail($id);
    // Do we have access to update it?
    if (Gate::denies('update-general', 'post')) {
        abort(404);
    }
    // Then we show the form, etc. but for now just the title is fine:
    return $post->name;

});