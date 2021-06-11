<?php

use Illuminate\Support\Facades\Route;

// Define path to route
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Notifications\PostCreated;
use App\Models\Post;
use App\Mail\newUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

/*

Route::get('/users/{id}/{name}', function($id, $name) {
    return view ('This is user '.$name. 'with and ID of ' .$id);
});

*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', 'App/Http/Controllers/PagesController@index');

// Path to route defined above, PagesController is called followed by requested class
Route::get('/', [PagesController::class, 'index']);

// OLD Routes - now using Page Manager (bottom of web.php routes file)
// Route::get('/about', [PagesController::class, 'about']);
// Route::get('/services', [PagesController::class, 'services']);

// Route resource for all posts
Route::resource('posts', PostsController::class);

// Authentication Generated Routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Email Verification

// prompted to verify email
// if the user is 'auth' but not 'verified' when accessing a page that requries verification, they are redirected
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware(['auth'])->name('verification.notice');

// handle request from confirmation email
// user clicks the confirmation email, they are redirected to dashboard and shown a message
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home')->with('message', 'Your account has been verified');
})->middleware(['auth', 'signed'])->name('verification.verify');

// resend the verification email
// user clicks link on "verify.blade.php" - verification email is sent, user is shown a confirmation message
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    // return back()->with('status', 'verification-link-sent');
    return back()->with('message', 'A fresh verification link has been sent to your email address.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}/{subs?}', ['uses' => '\App\Http\Controllers\PageController@index'])
    ->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$', 'subs' => '.*']);