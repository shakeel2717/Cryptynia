<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RanksController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\user\DepositController;
use App\Http\Controllers\user\KycController;
use App\Http\Controllers\user\ProfileController as UserProfileController;
use App\Http\Controllers\user\TreeController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;


Route::prefix('user/')->name('user.')->middleware('auth', 'user')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::post('/deposit/verify', [DepositController::class, 'verify'])->name('deposit.verify');
    Route::resource('deposit', DepositController::class);
    Route::post('/plan/networkcap', [PlanController::class, 'networkcap'])->name('plan.networkcap');
    Route::resource('plan', PlanController::class);
    Route::resource('tree', TreeController::class);
    Route::resource('withdraw', WithdrawController::class);
    Route::resource('ranks', RanksController::class);
    Route::post('/profile/password', [UserProfileController::class, 'password'])->name('profile.password');
    Route::resource('profile', UserProfileController::class);
    Route::resource('kyc', KycController::class);

    Route::controller(HistoryController::class)->name('history.')->prefix('history/')->group(function () {
        Route::view('deposits', 'user.history.deposits')->name('deposits');
        Route::view('withdrawals', 'user.history.withdrawals')->name('withdrawals');
        Route::view('direct', 'user.history.direct')->name('direct');
        Route::view('roi', 'user.history.roi')->name('roi');
        Route::view('all', 'user.history.all')->name('all');
    });
});

Route::get('/privacy', [LandingPageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [LandingPageController::class, 'terms'])->name('terms');
Route::get('/disclaimer', [LandingPageController::class, 'disclaimer'])->name('disclaimer');


Route::post('/contact', [LandingPageController::class, 'contactStore'])->name('contact.store');
Route::get('/contact', [LandingPageController::class, 'contact'])->name('contact');
Route::get('/about', [LandingPageController::class, 'about'])->name('about');
Route::resource('/', LandingPageController::class);
Route::resource('/post', PostController::class);
Route::resource('/newsletter', NewsLetterController::class);

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
