<?php
  $module = 'manage.schedule';
  $controller = 'Manage\ScheduleController';
  Route::get('/create', $controller.'@create')
    ->name($module.'.create')
    ->middleware([]);
  Route::post('/create', $controller.'@createPost')
    ->name($module.'.createPost')
    ->middleware([]);
  Route::get('/{id}/clone', $controller.'@clone')
    ->name($module.'.clone')
    ->middleware([]);
  Route::post('/{id}/clone', $controller.'@clonePost')
    ->name($module.'.clonePost')
    ->middleware([]);
  Route::get('/{id}/update', $controller.'@update')
    ->name($module.'.update')
    ->middleware([]);
  Route::post('/{id}/update', $controller.'@updatePost')
    ->name($module.'.updatePost')
    ->middleware([]);
  Route::get('/{id}/view', $controller.'@view')
    ->name($module.'.view')
    ->middleware([]);
  Route::post('/{id}/active', $controller.'@active')
    ->name($module.'.active')
    ->middleware([]);
  Route::post('/{id}/inactive', $controller.'@inactive')
    ->name($module.'.inactive')
    ->middleware([]);
  Route::post('/{id}/delete', $controller.'@delete')
    ->name($module.'.delete')
    ->middleware([]);
  Route::get('/', $controller.'@list')
    ->name($module.'.list')
    ->middleware([]);
  Route::get('/{id}', $controller.'@view')
    ->name($module.'.view')
    ->middleware([]);
  Route::get('/{id}/render-export-file', $controller.'@renderExportFile')
    ->name($module.'.render-export-file')
    ->middleware([]);
  Route::get('/{id}/print-preview', $controller.'@printPreview')
    ->name($module.'.print-preview')
    ->middleware([]);
  Route::get('/{id}/approve/{applicationId}', $controller.'@approveApplicant')
    ->name($module.'.approve-applicant')
    ->middleware([]);
  Route::get('/{id}/reject/{applicationId}', $controller.'@rejectApplicant')
    ->name($module.'.reject-applicant')
    ->middleware([]);