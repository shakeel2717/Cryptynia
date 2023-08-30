<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DepositController;
use App\Http\Controllers\admin\FinanceController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\WithdrawController;
use Illuminate\Support\Facades\Route;


Route::redirect('/admin', 'admin/dashboard');
Route::prefix('admin/')->name('admin.')->middleware('auth', 'admin', 'verified')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('finance', FinanceController::class);
    Route::resource('withdraw', WithdrawController::class);
    Route::resource('deposit', DepositController::class);
    Route::resource('setting', SettingController::class);
    Route::name('history.')->prefix('history/')->group(function () {
        Route::view('deposits', 'admin.history.deposits')->name('deposits');
        Route::view('roi', 'admin.history.roi')->name('roi');
        Route::view('withdrawals', 'admin.history.withdrawals')->name('withdrawals');
        Route::view('withdraw-fees', 'admin.history.withdraw_fees')->name('withdrawals.fees');
        Route::view('all-users', 'admin.history.users')->name('users');
        Route::view('plan-profit', 'admin.history.plan-profit')->name('plan.profit');
        Route::view('kyc', 'admin.history.kyc')->name('kyc.all');
    });
});
