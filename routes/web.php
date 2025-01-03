<?php

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
  return view('auth.login');
});

Auth::routes([
  'register' => false, // Registration Routes...
  'verify' => false, // Email Verification Routes...
]);

Route::middleware(['auth'])->prefix('admin')->group(function () {

  //USERS
  Route::get('/dashboard/resume', 'DashboardController@resume')->name('dashboard.resume');
  Route::resource('activities', 'ActivityController');
  Route::resource('approve-activities', 'ApproveActivityController');
  Route::get('loans/history', 'LoanController@history')->name('loans.history');
  Route::resource('loans', 'LoanController');

  //CLIENTS
  Route::middleware(['isClient'])->group(function () {

    Route::resource('activityTypes', 'ActivityTypeController');
    Route::resource('companies', 'CompanyController');
    Route::get('/dashboard/summary', 'DashboardController@summary')->name('dashboard.summary');
    Route::get('/dashboard/payment', 'DashboardController@payment')->name('dashboard.payment');
    Route::get('/dashboard/pending_users', 'DashboardController@pending_users')->name('dashboard.pending_users');
    Route::get('/dashboard/payAllPendingActivities', 'DashboardController@payAllPendingActivities')->name('dashboard.pay_pending_activities');
    Route::resource('deposits', 'DepositController');
    Route::resource('users', 'UserController');
    Route::resource('withdrawals', 'WithdrawalController');
    Route::get('/calculator', 'CalculatorController@index')->name('calculator.index');
    
  });
});
