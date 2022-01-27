<?php


use Illuminate\Support\Facades\Route;

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

route::prefix('admin')
            ->namespace('Admin')
            ->group(function(){
    /**
     * Documentation
     */


    /**
     * Routes Profile
     */
    Route::get('profiles/create', 'ACL\ProfileController@create')->name('profiles.create');
    Route::put('profiles/{id}', 'ACL\ProfileController@update')->name('profiles.update');
    Route::get('profiles/{id}/edit', 'ACL\ProfileController@edit')->name('profiles.edit');
    Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::delete('profiles/{id}', 'ACL\ProfileController@destroy')->name('profiles.destroy');
    Route::get('profiles/{id}', 'ACL\ProfileController@show')->name('profiles.show');
    Route::post('profiles/store', 'ACL\ProfileController@store')->name('profiles.store');
    Route::get('profiles', 'ACL\ProfileController@index')->name('profiles.index');

    /**
     * Routes Details Plans
    */
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
    Route::delete('plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
    Route::get('plans/{url}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show');
    Route::put('plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');

    /**
     * Routes Plans
     */
    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::post('plans/store', 'PlanController@store')->name('plans.store');
    Route::get('plans', 'PlanController@index')->name('plans.index');

    /**
     * Home Dashboard
     */
    Route::get('/', 'PlanController@index')->name('admin.index');

});



Route::get('/', function () {
    return view('welcome');
});
