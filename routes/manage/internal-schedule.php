<?php
  $module = 'manage.internal-schedule';
  $controller = 'Manage\InternalScheduleController';
  Route::get('/create', $controller.'@create')
    ->name($module.'.create')
    ->middleware([]);
  Route::post('/create', $controller.'@createPost')
    ->name($module.'.createPost')
    ->middleware([]);
  Route::get('/{slug}/update', $controller.'@update')
    ->name($module.'.update')
    ->middleware([]);
  Route::post('/{slug}/update', $controller.'@updatePost')
    ->name($module.'.updatePost')
    ->middleware([]);
  Route::post('/{slug}/active', $controller.'@active')
    ->name($module.'.active')
    ->middleware([]);
  Route::post('/{slug}/inactive', $controller.'@inactive')
    ->name($module.'.inactive')
    ->middleware([]);
  Route::post('/{slug}/delete', $controller.'@delete')
    ->name($module.'.delete')
    ->middleware([]);
  Route::get('/', $controller.'@list')
    ->name($module.'.list')
    ->middleware([]);
  Route::get('/{slug}', $controller.'@view')
    ->name($module.'.view')
    ->middleware([]);