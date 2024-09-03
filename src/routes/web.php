<?php

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
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    // 飲食店の詳細ページのルート
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');

    // 予約のルート
    Route::post('/reservations/{restaurant}', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/done', [ReservationController::class, 'done'])->name('reservations.done');
// プロフィールページのルート
    Route::get('/profile', [HomeController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile', [HomeController::class, 'updateProfile'])->name('profile.update');

// マイページのルート
    Route::get('/mypage', [HomeController::class, 'showMyPage'])->name('mypage.show');
    Route::get('/restaurants/{restaurant}/reserve', [ReservationController::class, 'create'])->name('customer.reserve');
    Route::post('/restaurants/{restaurant}/reserve', [ReservationController::class, 'store'])->name('customer.reserve.store');
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/favorites/{restaurant}', [HomeController::class, 'addFavorite'])->name('favorites.add');
    Route::delete('/favorites/{restaurant}', [HomeController::class, 'removeFavorite'])->name('favorites.remove');

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
    Route::get('/admin/restaurants/{restaurant}/edit', [AdminController::class, 'edit'])->name('admin.edit-restaurant');
    Route::post('/admin/restaurants/{restaurant}', [AdminController::class, 'update'])->name('admin.update-restaurant');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
    Route::delete('/admin/restaurants/{restaurant}', [AdminController::class, 'destroy'])->name('admin.delete-restaurant');
});

Route::middleware(['auth', 'verified', 'owner'])->group(function () {
    Route::get('/owner', [HomeController::class, 'owner'])->name('owner.dashboard');
    Route::get('/owner/create-restaurant', [RestaurantController::class, 'create'])->name('owner.create-restaurant');
    Route::post('/owner/create-restaurant', [RestaurantController::class, 'store'])->name('owner.store-restaurant');
    Route::get('/owner/restaurants/{restaurant}/edit', [RestaurantController::class, 'edit'])->name('owner.edit-restaurant');
    Route::post('/owner/restaurants/{restaurant}/confirm', [RestaurantController::class, 'confirm'])->name('owner.confirm-restaurant');
    Route::post('/owner/restaurants/{restaurant}', [RestaurantController::class, 'update'])->name('owner.update-restaurant');
});