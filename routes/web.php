<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function() {
    Route::resource('/projects', 'ProjectController');
    Route::resource('/tasks', 'TaskController')->except(['create', 'store', 'show']);

    Route::get('/projects/{id}/addTask', 'TaskController@create')->name('tasks.create');
    Route::post('/projects/{id}/addTask', 'TaskController@store')->name('tasks.store');

    Route::resource('/categories', 'CategoryController');
});

Route::get('/admin', 'Admin\MainController@index')->middleware('admin')->name('admin');

Route::get('/register', 'UserController@create')->name('user.create');
Route::post('/register', 'UserController@store')->name('user.store');

Route::get('/login', 'UserController@loginForm')->name('login.create');
Route::post('/login', 'UserController@login')->name('login');

Route::get('/logout', 'UserController@logout')->name('logout');

Route::group(['namespace' => 'User', 'middleware' => 'admin'], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard/tasks', 'DashboardController@task')->name('dashboard.tasks');
    Route::get('/dashboard/tasks/{id}','TaskUserController@show')
                ->name('taskUser.show')->middleware('task.access');

    Route::patch('/dashboard/tasks/{id}/order', 'TaskUserController@orderTask')->name('taskUser.orderTask');
    Route::patch('/dashboard/tasks/{id}/start', 'TaskUserController@startTask')->name('taskUser.startTask')->middleware('task.access');
    Route::patch('/dashboard/tasks/{id}/done', 'TaskUserController@startTask')->name('taskUser.doneTask')->middleware('task.access');
});


