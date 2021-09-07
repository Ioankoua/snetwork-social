<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\AuthController;
use App\HTTP\Controllers\MainController;
use App\HTTP\Controllers\SearchController;
use App\HTTP\Controllers\ProfileController;
use App\HTTP\Controllers\FreindsController;
use App\HTTP\Controllers\StatusController;
use App\HTTP\Controllers\MessageController;


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

Route::get('/', [MainController::class, 'mainPage'])->name('main');


Route::get('/reg', [AuthController::class, 'getRegister'])->middleware('guest')->name('auth.register');

Route::post('/reg', [AuthController::class, 'postRegister'])->middleware('guest');

Route::get('/enter', [AuthController::class, 'getEnter'])->middleware('guest')->name('auth.enter');

Route::post('/enter', [AuthController::class, 'postEnter'])->middleware('guest');

Route::get('/exit', [AuthController::class, 'getExit'])->name('auth.exit');


Route::get('/search', [SearchController::class, 'getResult'])->middleware('auth')->name('search.results');

Route::get('/user/{name}', [ProfileController::class, 'getProfile'])->middleware('auth')->name('profile.mainProfile');

Route::get('/account/edit', [ProfileController::class, 'getEdit'])->middleware('auth')->name('profile.edit');

Route::post('/account/edit', [ProfileController::class, 'postEdit'])->middleware('auth');

Route::post('/account/avatar/{name}', [ProfileController::class, 'upAvatar'])->middleware('auth')->name('upAvatar');


Route::get('friends', [FreindsController::class, 'getIndex'])->middleware('auth')->name('friends.index');

Route::get('friends/add/{name}', [FreindsController::class, 'getAdd'])->middleware('auth')->name('friends.add');

Route::get('friends/accept/{name}', [FreindsController::class, 'getAccept'])->middleware('auth')->name('friends.accept');

Route::post('friends/delete/{name}', [FreindsController::class, 'deleteFriend'])->middleware('auth')->name('friends.delete');


Route::get('/wall', [MainController::class, 'mainPage'])->middleware('auth')->name('wall.timeline');

Route::post('/status', [StatusController::class, 'postStatus'])->name('status.post')->middleware('auth');

Route::post('/status/{statusId}/reply', [StatusController::class, 'postReply'])->middleware('auth')->name('status.reply');


Route::get('/message', [MessageController::class, 'getMessage'])->middleware('auth')->name('message.messagesPage');

Route::post('/message', [MessageController::class, 'postMessage'])->middleware('auth');

Route::get('/chat/{name}', [MessageController::class, 'chatMessage'])->middleware('auth')->name('message.chat');


Route::get('status/{statusId}/like', [StatusController::class, 'getLike'])->middleware('auth')->name('status.like');

