<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;


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

Fortify::verifyEmailView(function () {
	return view('auth.verify-email');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();
	return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
	$request->user()->sendEmailVerificationNotification();
	return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

Route::get('/reservations/done', [ReservationController::class, 'done'])->name('reservations.done');

Route::middleware(['auth', 'verified'])->group(function () {

	Route::get('/', function () {
		if (Auth::user()->role == 'admin') {
			return redirect()->route('admin.manage-owners');
		} elseif (Auth::user()->role == 'restaurant_owner') {
			return redirect()->route('owner.dashboard');
		} else {
			return redirect()->route('home');
		}
	})->name('home');

	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::get('/search', [HomeController::class, 'index'])->name('home.search');


	// 飲食店の詳細ページのルート
	Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');

	// マイページのルート
	Route::get('/mypage', [HomeController::class, 'showMyPage'])->name('mypage.show');

	// 予約のルート
	Route::get('/reservations/{restaurant}', [ReservationController::class, 'show'])->name('customer.reserve');
	Route::post('/reservations/{restaurant}', [ReservationController::class, 'store'])->name('reservations.store');
	Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
	Route::post('/reservations/{reservation}/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
	Route::patch('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
	Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
	// プロフィールページのルート
	Route::get('/profile', [HomeController::class, 'showProfile'])->name('profile.show');
	Route::post('/profile', [HomeController::class, 'updateProfile'])->name('profile.update');

	// レビューページへのルート
	Route::get('/reviews/{restaurant}', [ReviewController::class, 'create'])->name('reviews.create');
	Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
	Route::get('/reviews/edit/{review}', [ReviewController::class, 'edit'])->name('reviews.edit');
	Route::put('/reviews/edit/{review}', [ReviewController::class, 'update'])->name('reviews.update');
	Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');


	// お気に入り登録
	Route::post('/favorites/toggle/{restaurant}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

	// ログアウト
	Route::post('/logout', function () {
		Auth::logout();
		return redirect('/login');
	})->name('logout');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
	Route::get('/admin', [AdminController::class, 'index'])->name('admin.manage-owners');
	Route::post('/admin/manage-owners/{user}', [AdminController::class, 'updateRole'])->name('admin.update-role');
	Route::get('/admin/manage-owners/search', [AdminController::class, 'search'])->name('admin.search');
	Route::get('/admin/make-owner', [AdminController::class, 'createOwnerForm'])->name('admin.make-owner');
	Route::post('/admin/make-owner', [AdminController::class, 'storeOwner'])->name('admin.store-owner');
	Route::get('/admin/restaurants', [AdminController::class, 'indexRestaurants'])->name('admin.restaurants');
	Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create-restaurant');
	Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.store-restaurant');
	Route::get('/admin/restaurants/{restaurant}', [AdminController::class, 'edit'])->name('admin.edit-restaurant');
	Route::post('/admin/restaurants/{restaurant}', [AdminController::class, 'update'])->name('admin.update-restaurant');
	Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
	Route::delete('/admin/restaurants/{restaurant}', [AdminController::class, 'destroy'])->name('admin.delete-restaurant');
	Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('admin.reviews');
});

Route::middleware(['auth', 'verified', 'owner'])->group(function () {
	Route::get('/owner', [HomeController::class, 'owner'])->name('owner.dashboard');
	Route::get('/owner/restaurants', [HomeController::class, 'indexRestaurants'])->name('owner.restaurants');
	Route::get('/owner/create-restaurant', [RestaurantController::class, 'create'])->name('owner.create-restaurant');
	Route::post('/owner/create-restaurant', [RestaurantController::class, 'store'])->name('owner.store-restaurant');
	Route::get('/owner/restaurants/{restaurant}', [RestaurantController::class, 'edit'])->name('owner.edit-restaurant');
	Route::post('/owner/restaurants/{restaurant}', [RestaurantController::class, 'confirm'])->name('owner.confirm-restaurant');
	Route::patch('/owner/restaurants/{restaurant}', [RestaurantController::class, 'update'])->name('owner.update-restaurant');
	Route::delete('/owner/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])->name('owner.delete-restaurant');
	Route::patch('/owner/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
});
