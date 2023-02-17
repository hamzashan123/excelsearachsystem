<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    //bills
    Route::get('bills', 'BillController@index')->name('bills.index');
    Route::get('bills-delete/{id}', 'BillController@deleteBill')->name('bills.delete');
    Route::get('create-bills', 'BillController@create')->name('bills.create');
    Route::get('deleteItem/{id}', 'BillController@deleteItems')->name('bills.item.delete');
    Route::post('createbill', 'BillController@store')->name('bills.store');
    Route::post('save-items', 'BillController@saveItems')->name('bills.item.store');
    Route::post('gethostguests', 'BillController@getHostGuest')->name('bills.hostguest');
    Route::post('get-discountypes', 'BillController@getDiscountTypes')->name('bills.discountTypes');

});
