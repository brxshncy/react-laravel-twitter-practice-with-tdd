<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth:api']], function(){

    Route::resource('tweet', TweetController::class,[
      'names' => [
            'store' => 'post.tweet',
            'update' => 'update.tweet',
            'index' => 'index.tweet',
            'show' => 'show.tweet'
      ] 
    ]);
});


Route::post('register', [UserController::class, 'store'])->name('register');
Route::post('login', LoginController::class)->name('login');