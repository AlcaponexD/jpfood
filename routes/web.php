<?php

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::get('/','Admin\PlanController@index')->name('admin.index');
    /**
     * Permissions
     */
    Route::post('profiles/{id}/permissions','Admin\ACL\PermissionProfileController@permissionsAttach')->name('permission.profile.attach');
    Route::delete('profiles/{id}/permission/{idpermission}','Admin\ACL\PermissionProfileController@detachPermissionProfile')->name('permission.profile.detach');
    Route::get('profiles/{id}/permissions','Admin\ACL\PermissionProfileController@permissions')->name('permission.profile');
    Route::get('profiles/{id}/permissions/avaliable','Admin\ACL\PermissionProfileController@permissionsAvaliable')->name('permission.profile.avaliable');

    //Others routes
    Route::prefix('plans')->group(function () {
        Route::any('/search','Admin\PlanController@search')->name('plans.search');
        Route::get('/create','Admin\PlanController@create')->name('plans.create');
        Route::get('{url}','Admin\PlanController@show')->name('plans.show');
        Route::get('{url}/detail','Admin\DetailPlanController@index')->name('plans.details.index');
        Route::post('{url}/detail','Admin\DetailPlanController@store')->name('plans.details.store');
        Route::delete('/detail/{id}','Admin\DetailPlanController@destroy')->name('plans.details.destroy');
        Route::get('{url}/detail/create','Admin\DetailPlanController@create')->name('plans.details.create');
        Route::get('/edit/{url}','Admin\PlanController@edit')->name('plans.edit');
        Route::put('/update/{url}','Admin\PlanController@update')->name('plans.update');
        Route::delete('{url}','Admin\PlanController@destroy')->name('plans.destroy');
        Route::get('/','Admin\PlanController@index')->name('plans.index');
        Route::post('/','Admin\PlanController@store')->name('plans.store');
    });
    Route::prefix('profiles')->group(function () {
        Route::any('/search','Admin\ProfileController@search')->name('profiles.search');
        Route::get('/create','Admin\ProfileController@create')->name('profiles.create');
        Route::delete('/{id}','Admin\ProfileController@destroy')->name('profiles.destroy');
        Route::get('/','Admin\ProfileController@index')->name('profiles.index');
        Route::post('/','Admin\ProfileController@store')->name('profiles.store');
    });
    Route::prefix('permissions')->group(function () {
        Route::any('/search','Admin\PermissionController@search')->name('permissions.search');
        Route::get('/create','Admin\PermissionController@create')->name('permissions.create');
        Route::delete('/{id}','Admin\PermissionController@destroy')->name('permissions.destroy');
        Route::get('/','Admin\PermissionController@index')->name('permissions.index');
        Route::post('/','Admin\PermissionController@store')->name('permissions.store');
    });
});