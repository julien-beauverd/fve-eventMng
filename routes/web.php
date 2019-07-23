<?php

use App\Http\Controllers\EventListController;
use App\Http\Controllers\AdminController;

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
//////////////GENERAL///////////////////////////////////
Route::get('/', function () {
    return view('welcome');
});

Route::get('about', function () {
    return view('about');
});

Route::get('usefulLinks', function () {
    return view('usefulLinks');
});

Route::get('documentsToDownload', 'EventController@documentsToDownload');

Route::get('login', function () {
    return view('login');
});

Route::get('eventList/{orderBy}', 'EventController@index');
Route::get('eventCal', 'EventController@calendar');
Route::get('event/{id}/{OK?}', 'EventController@show');

/////////////AUTHENTIFICATE ROUTES//////////////////////
Auth::routes(['verify' => true]);
Route::get('home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('profile', function () {
    return view('profile');
})->middleware('verified');
Route::put('profile/edit/{id}', 'UserController@update')->middleware('verified');
Route::get('myEvents/{id}', 'EventController@myEvents')->middleware('verified');
Route::get('/participate/{id}', 'UserController@participate')->middleware('verified');

//////////////ADMIN////////////////////////////////////////
Route::get('admin/dashboard', 'AdminController@dashboard')->middleware('verified');

Route::get('admin/newEvent', 'AdminController@showNewEventPage')->middleware('verified');
Route::post('admin/newEvent', 'AdminController@newEvent')->middleware('verified');

Route::get('admin/nextEvents', 'AdminController@showNextEventsPage')->middleware('verified');
Route::get('admin/nextEvents/{id}', 'AdminController@showNextEventsPage')->middleware('verified');

Route::get('admin/modifyEvent/{id}', 'AdminController@showModifyEvent')->middleware('verified');
Route::put('admin/modifyEvent/{id}', 'AdminController@modifyEvent')->middleware('verified');

Route::get('admin/deleteEvent/{id}', 'AdminController@deleteEvent')->middleware('verified');

Route::get('admin/deleteUser/{id}', 'AdminController@deleteUser')->middleware('verified');

Route::get('admin/docsToDownloadManagement', 'AdminController@showDocsToDownload')->middleware('verified');
Route::put('admin/docsToDownloadManagement', 'AdminController@modifyDocsToDownload')->middleware('verified');

Route::get('admin/pastEvents', 'AdminController@showPastEventsPage')->middleware('verified');

Route::get('admin/sendMail', 'AdminController@showSendMail')->middleware('verified');

Route::post('sendMail', 'AdminController@sendMail')->middleware('verified');
