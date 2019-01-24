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
Route::get('budgets/{name}', 'BudgetController@show');
Route::patch('budgets/{name}', 'BudgetController@update');
Route::delete('budgets/{name}', 'BudgetController@destroy');

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
*/
Route::get('accounts', 'AccountController@index');
Route::get('accounts/create', 'AccountController@create');
Route::get('accounts/{name}', 'AccountController@show');
Route::post('accounts', 'AccountController@store');
Route::patch('accounts/{name}', 'BudgetController@update');
Route::delete('accounts/{name}', 'BudgetController@destroy');