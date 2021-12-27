<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SocialAuthController;
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
/*
Route::get('/', function () {
    return 'Hello World';
});


Route::get('/home', function () {
    return 'Hello World';
});

Route::get('/greeting', function () {
    return 'Hello World';
});
*/
//Route::get ( '/redirect/{service}', 'SocialAuthController@redirect' );
//Route::get ( '/callback/{service}', 'SocialAuthController@callback' );

//Route::get('/home', [SocialAuthController::class,'sociallogins']);
Route::get('/redirect/{service}', [SocialAuthController::class, 'redirect']);
Route::get('/callback/{service}', [SocialAuthController::class, 'callback']);


Route::get ( '/users/list',[SocialAuthController::class,'userslist']);
Route::get ( '/getusers',[SocialAuthController::class,'getusers']);


Route::get ( '/layout',[SocialAuthController::class,'getusers']);

Route::get ( '/logout',[SocialAuthController::class,'logout']);

Route::get('home2', function()
{
    return View::make('home');
});

Route::get('profile',[SocialAuthController::class,'profile']);





/*
Route::get('/', function()
{
    return View::make('pages.home');
}); */

Route::get('projects', function()
{
    return View::make('pages.projects');
});
Route::get('contact', function()
{
    return View::make('pages.contact');
});





Route::get('/tasks', function () {
    $page_name = "Task list details";
    $tasks = ["Task1", "Task2", "Task3", "Task4" , "Task5" , "Task6" , "Task7" ];

    return view('tasks', compact('page_name', 'tasks'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
