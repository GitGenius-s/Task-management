<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sam', function () {
    return 'hi';
})->middleware('api.access');


Route::middleware('api.access')->group(function(){
      Route::get('sam',function(){
          return "valid";
      });
      Route::post('create','AdminController@store');
      Route::get('show','AdminController@show');
});


Route::middleware('auth:api')->group(function () {
    // Routes that require authentication
    // Route::post('user', function(){
    //     return "Authorized user!";
    // });
   
});
Route::post('register', 'Auth\RegisterController@create');
Route::post('login', 'Auth\LoginController@login');




































































// Route::get('home', function () {
//     return response('Hello World', 200)
//                   ->header('Content-Type', 'text/plain');
// });

