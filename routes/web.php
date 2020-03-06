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

/*Route::get('/', function () {
    return view('home');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/about', function () {
    return view('about');
});*/
// Route::view('/', 'home')->name('home');
// Route::view('/contact', 'contact')->name('contact');
// Route::view('/about', 'about')->name('about');

// Route::get('/blog-post/{id}/{welcome?}', function ($id, $welcome=1) 
// {   $page=[
//         1=>['title' => 'from PAGE 1',],
//         2=>['title' => 'from PAGE 2',],
//         ];
//     $welcomes=[
//         1=>'<b>Hello</b>',
//         2=>'<u>Welcome</u>'
//     ];
//     return view('blog-post',[
//         'data'=>$page[$id],
//         'welcome'=>$welcomes[$welcome],
//     ]);
// })->name('blog-post');


Route::get('/', 'HomeController@home')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/secret', 'HomeController@secret')->name('secret')->middleware('can:home.secret');
Route::resource('/post', 'PostController');
Route::get('/post/tag/{tag}', 'PostTagController@index')->name('post.tags.index');
Route::resource('post.comments', 'PostCommentController')->only(['store']);
Route::resource('user', 'UserController')->only(['show', 'edit', 'update']);

Auth::routes();
