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

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Budget Routes
|--------------------------------------------------------------------------
*/
Route::get('budgets', 'BudgetController@index');
Route::get('budgets/create', 'BudgetController@store');
Route::get('budgets/{budget}', 'BudgetController@show');
Route::patch('budgets/{budget}', 'BudgetController@update');
Route::delete('budgets/{budget}', 'BudgetController@destroy');

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
*/
Route::resource('accounts', 'AccountController')->except([
    'show', 'index'
]);;

/*
|--------------------------------------------------------------------------
| Transaction Routes
|--------------------------------------------------------------------------
*/
Route::resource('transactions', 'TransactionController')->except([
    'show', 'index'
]);

/*
|--------------------------------------------------------------------------
| Bill Routes
|--------------------------------------------------------------------------
*/
Route::resource('bills', 'BillController')->except([
    'show', 'index'
]);