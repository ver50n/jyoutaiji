<?php

use Illuminate\Support\Facades\Route;


Route::get('/',['as' => 'pages.root', 'uses' => 'PageController@home']);
Route::get('/home',['as' => 'pages.home', 'uses' => 'PageController@home']);
Route::get('/about',['as' => 'pages.about', 'uses' => 'PageController@about']);
Route::get('/gallery',['as' => 'pages.gallery', 'uses' => 'PageController@gallery']);
Route::get('/contact',['as' => 'pages.contact', 'uses' => 'PageController@contact']);
Route::post('/contact',['as' => 'pages.contactPost', 'uses' => 'PageController@contactPost']);
Route::get('/announcement',['as' => 'pages.announcement', 'uses' => 'PageController@announcement']);

Route::get('/schedule',['as' => 'pages.schedule', 'uses' => 'PageController@schedule']);
Route::post('/schedule-detail/{id}/apply',['as' => 'pages.schedule-detail.apply', 'uses' => 'PageController@scheduleApply']);
Route::get('/schedule-detail/{id}',['as' => 'pages.schedule-detail', 'uses' => 'PageController@scheduleDetail']);

/* Helper Routes */
Route::post('/helpers/change-locale',['as' => 'helpers.change-locale', 'uses' => 'HelperController@changeLocale']);
Route::get('/helpers/load-schedule',['as' => 'helpers.load-schedule', 'uses' => 'HelperController@loadSchedule']);
Route::get('/helpers/download-file',['as' => 'helpers.download-file', 'uses' => 'HelperController@downloadFile']);
Route::post('/helpers/change-row-per-page', 'HelperController@changeRowPerPage')
    ->name('helpers.change-row-per-page')
    ->middleware([]);
Route::post('/helpers/export', 'HelperController@export')
    ->name('helpers.export')
    ->middleware([]);
Route::post('/helpers/activation', 'HelperController@activation')
    ->name('helpers.activation')
    ->middleware([]);

Route::prefix('/manage')->middleware([])->group(base_path('routes/manage/index.php'));