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
    Route::get('/projects/{id}/edit-project', 'TaskController@editProject')->name('project.editProject');

    Route::resource('/categories', 'CategoryController');

    Route::get('/task-check', 'TaskCheckController@index')->name('task.check');

    Route::patch('/task-check/{id}/accept', 'TaskCheckController@accept')->name('task.accept');
    Route::patch('/task-check/{id}/decline', 'TaskCheckController@decline')->name('task.decline');
    Route::patch('/task-check/{id}/restart', 'TaskCheckController@restart')->name('task.restart');
});

Route::get('/admin', 'Admin\MainController@index')->middleware('admin')->name('admin');

Route::group(['middleware' => 'login'], function() {
    Route::get('/register', 'UserController@create')->name('register');
    Route::post('/register', 'UserController@store')->name('user.store');

    Route::get('/login', 'UserController@loginForm')->name('login.create');
    Route::post('/login', 'UserController@login')->name('login');
});


Route::get('/logout', 'UserController@logout')->name('logout')->middleware('logout');

Route::group(['namespace' => 'User', 'middleware' => 'user'], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard/tasks', 'DashboardController@task')->name('dashboard.tasks');
    Route::get('/dashboard/tasks/{id}','TaskUserController@show')
                ->name('taskUser.show')->middleware('task.access');

    Route::patch('/dashboard/tasks/{id}/order', 'TaskUserController@orderTask')->name('taskUser.orderTask');
    Route::patch('/dashboard/tasks/{id}/start', 'TaskUserController@startTask')->name('taskUser.startTask')->middleware('task.access');
    Route::patch('/dashboard/tasks/{id}/done', 'TaskUserController@doneTask')->name('taskUser.doneTask')->middleware('task.access');
});


