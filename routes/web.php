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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/{id}', 'testController@show');

// return redirect()->route('/', ['id' => 1]);

// Route::get('/graph/{id}', function($id)
// {

// 	return view('graph');
//     //    return $id;
// 	// return view('welcome');
// });

//////////////////////////////////////////////////////////////////////
Route::get('graph/{id}', 'noticeController@graph');
Route::get('notice_monday','noticeController@notice_monday');
Route::get('notice_day','noticeController@notice_day');
Route::get('api','ApiController@api');
Route::get('index','testController@index');

Route::get('notice_breakfast','noticeController@notice_breakfast');
Route::get('notice_lunch','noticeController@notice_lunch');
Route::get('notice_dinner','noticeController@notice_dinner');

Route::get('food_diary/{id}','diaryController@show_food');
Route::get('vitamin_diary/{id}','diaryController@show_vitamin');
Route::get('exercise_diary/{id}','diaryController@show_exercise');
Route::get('weight_diary/{id}','diaryController@show_weight');




Route::get('index','testController@index');