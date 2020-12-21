<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return auth()->user();
    });

    Route::resource('notes', 'NoteController');
    Route::resource('tags', 'TagController');

    Route::post('/notes/{note}/tags', 'NoteTagsController@store');
    Route::delete('/notes/{note}/tags/{tag}', 'NoteTagsController@destroy');
});

Auth::routes([
    'confirm' => false
]);
