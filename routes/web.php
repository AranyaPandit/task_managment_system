<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;

use App\Http\Controllers\Admin\AdminController;
;
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



Route::prefix('admin')->middleware(['auth','admin'])->group(function()     {
    Route::get('/', [AdminController::class, 'index'])->name('admindashbord'); 
    Route::get('/users', [AdminController::class, 'all_user'])->name('users'); 
    Route::get('/users/{id}', [AdminController::class, 'user_edit'])->name('edit'); 
    Route::put('/users/{id}', [AdminController::class, 'user_update'])->name('update');

});




Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'registerForm'])->name('register.form');
Route::post('/register', [LoginController::class, 'register'])->name('register');


Route::middleware(['auth'])->group(function () {
    Route::resource('task', TaskController::class);
    Route::get('/user-task', [TaskController::class, 'index'])->name('user-task');
    Route::get('/tasks/{id?}', [TaskController::class, 'showDetails'])->name('task-details');
    Route::get('/profile', [LoginController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [LoginController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [LoginController::class, 'updateProfile'])->name('profile.update');
    
});


