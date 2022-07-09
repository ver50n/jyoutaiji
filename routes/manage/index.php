<?php
  $module = 'manage';
  Route::get('/', 'Manage\ManageController@dashboard')
    ->name($module.'.dashboard')
    ->middleware(['AdminAuthentication']);

  Route::get('/login', 'Manage\LoginController@login')
    ->name('manage.login')
    ->middleware([]);
  Route::post('/login', 'Manage\LoginController@loginPost')
    ->name('manage.login-post')
    ->middleware([]);

  Route::post('/logout', 'Manage\LoginController@logout')
    ->name('manage.logout')
    ->middleware([]);
    
  Route::prefix('/admin')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/admin.php'));
  Route::prefix('/organization-history')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/organization-history.php'));
  Route::prefix('/announcement')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/announcement.php'));
  Route::prefix('/user')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/user.php'));
  Route::prefix('/gallery')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/gallery.php'));
  Route::prefix('/contact')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/contact.php'));
  Route::prefix('/schedules')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/schedule.php'));
  Route::prefix('/internal-schedules')->middleware(['AdminAuthentication'])->group(base_path('routes/manage/internal-schedule.php'));