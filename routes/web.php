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
Route::get('budgets/create', 'BudgetController@create');
Route::get('budgets/{name}', 'BudgetController@show');
Route::post('budgets', 'BudgetController@store');
Route::patch('budgets/{name}', 'BudgetController@update');
Route::delete('budgets/{name}', 'BudgetController@destroy');