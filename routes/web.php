<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RestPosController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;




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



Route::group(['middleware' => 'guest'], function () {

    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'registerView'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

Route::resource('products', ProductController::class);

Route::resource('roles', RoleController::class);

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [AuthController::class, 'home'])->name('home');
    Route::get('adminhome', [AuthController::class, 'adminhome'])->name('adminhome');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    //Route::resource('users', UserController::class);
    
   
});

//Route::resource('users', UserController::class);




Route::get('forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');





Route::group(['middleware'=>['auth','roles:admin']],function(){
    Route::resource('users', UserController::class);
});


//Route::resource('users', UserController::class);

Route::get('/website', function () {
    return view('website.webhome');
});

Route::get('/website/about', function () {
    return view('website.about');
});

Route::get('/website/contact', function () {
    return view('website.contact');
});


Route::get('menu',[RestPosController::class, 'index']);


Route::get('/form', function(){
    return view('form');
});


Route::post('/form', [TestController::class, 'validataForm'])->name('validataForm');






Route::get('posts', [PostController::class, 'index']);

Route::post('post', [PostController::class, 'store']);

Route::put('post', [PostController::class, 'update']);

Route::delete('post/{post_id}', [PostController::class, 'destroy']);