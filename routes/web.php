<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CoinPaymentController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\OrderConfirmationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RanksController;
use App\Http\Controllers\TeamRewardController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\user\DepositController;
use App\Http\Controllers\user\KycController;
use App\Http\Controllers\user\ProfileController as UserProfileController;
use App\Http\Controllers\user\TreeController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;


Route::prefix('user/')->name('user.')->middleware('auth', 'user', 'emailVerified')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::post('/deposit/verify', [DepositController::class, 'verify'])->name('deposit.verify');
    Route::resource('deposit', DepositController::class);
    Route::post('/plan/networkcap', [PlanController::class, 'networkcap'])->name('plan.networkcap');
    Route::get('/plan/active', [PlanController::class, 'active'])->name('plan.active');
    Route::resource('plan', PlanController::class);
    Route::resource('tree', TreeController::class);
    Route::resource('withdraw', WithdrawController::class);
    Route::resource('ranks', RanksController::class);
    Route::resource('team_ranks', TeamRewardController::class);
    Route::post('/profile/password', [UserProfileController::class, 'password'])->name('profile.password');
    Route::resource('profile', UserProfileController::class);
    Route::resource('kyc', KycController::class);
    Route::resource('exchange', ExchangeController::class)->middleware('kyc');
    Route::resource('account', AccountController::class);
    Route::resource('order', OrderController::class);
    Route::resource('order-confirm', OrderConfirmationController::class);

    Route::controller(HistoryController::class)->name('history.')->prefix('history/')->group(function () {
        Route::view('deposits', 'user.history.deposits')->name('deposits');
        Route::view('withdrawals', 'user.history.withdrawals')->name('withdrawals');
        Route::view('direct', 'user.history.direct')->name('direct');
        Route::view('roi', 'user.history.roi')->name('roi');
        Route::view('all', 'user.history.all')->name('all');
        Route::view('indirect1', 'user.history.indirect1')->name('indirect1');
        Route::view('indirect2', 'user.history.indirect2')->name('indirect2');
        Route::view('indirect3', 'user.history.indirect3')->name('indirect3');
    });
    Route::controller(HistoryController::class)->name('referrals.')->prefix('referrals/')->group(function () {
        Route::view('direct', 'user.referrals.direct')->name('direct');
        Route::view('level1', 'user.referrals.level1')->name('level1');
        Route::view('level2', 'user.referrals.level2')->name('level2');
        Route::view('level3', 'user.referrals.level3')->name('level3');
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

Route::prefix('payment')->group(function () {
    Route::post('/webhook', [CoinPaymentController::class, 'webhook'])->name('webhook');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
