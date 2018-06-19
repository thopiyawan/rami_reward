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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('bot', function (Request $request) {
    logger("message request : ", $request->all());
});
Route::post('bot', ['as' => 'line.bot.message', 'uses' => 'GetMessageController@getmessage']);




//Route::get('peat_api','ApiController@api');
Route::get('peat_api', function (Request $request) {
    logger("message request : ", $request->all());
});
Route::post('peat_api', ['as' => 'peat_api', 'uses' => 'ApiController@api']);

Route::post('peat_localRegister', ['as' => 'peat_localRegister', 'uses' => 'ApiController@peat_localRegister']);
Route::post('peat_setGraphWeight', ['as' => 'peat_setGraphWeight', 'uses' => 'ApiController@peat_setGraphWeight']);



