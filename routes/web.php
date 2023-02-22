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


    Route::get('bills', 'NewBillController@index')->name('bills.index');
    Route::get('create-bills', 'BillController@create')->name('bills.create');

    Route::get('formOne','NewBillController@getFormOne')->name('bill.form.one');
    Route::post('formOneSave','NewBillController@saveFormOne')->name('bill.form.one.save');

    Route::get('formTwo','NewBillController@getFormTwo')->name('bill.form.two');
    Route::post('formTwoSave','NewBillController@saveFormTwo')->name('bill.form.two.save');

    Route::get('formThree','NewBillController@getFormThree')->name('bill.form.three');
    Route::post('formThreeSave','NewBillController@saveFormThree')->name('bill.form.three.save');

    Route::get('bills-delete/{id}', 'BillController@deleteBill')->name('bills.delete');

    Route::post('get-discountypes', 'BillController@getDiscountTypes')->name('bills.discountTypes');
    Route::post('save-items', 'NewBillController@saveItems')->name('bills.item.store');
    Route::get('deleteItem', 'NewBillController@deleteItems')->name('bills.item.delete');
    Route::post('assign-items', 'NewBillController@assignItems')->name('bills.item.assign');
    Route::post('gethostguests', 'NewBillController@getHostGuest')->name('bills.hostguest');
    Route::post('gethostguesitems', 'NewBillController@getHostGuesItems')->name('bills.gethostguesitems');
    

    // Route::get('bills-delete/{id}', 'NewBillController@deleteBill')->name('bills.delete');
    // Route::get('create-bills', 'NewBillController@create')->name('bills.create');
    // Route::post('deleteItem', 'NewBillController@deleteItems')->name('bills.item.delete');
    // Route::post('createbill', 'NewBillController@store')->name('bills.store');
    // Route::post('save-items', 'NewBillController@saveItems')->name('bills.item.store');
    // Route::post('update-items', 'NewBillController@updateItems')->name('bills.item.update');
    // Route::post('get-items', 'NewBillController@getItems')->name('bills.getItems');
    // Route::post('gethostguests', 'NewBillController@getHostGuest')->name('bills.hostguest');
    // Route::post('get-discountypes', 'NewBillController@getDiscountTypes')->name('bills.discountTypes');

    //bills
    // Route::get('bills', 'BillController@index')->name('bills.index');
    // Route::get('viewbill/{bill_id}', 'BillController@viewBill')->name('bills.view');
    // Route::get('bills-delete/{id}', 'BillController@deleteBill')->name('bills.delete');
   
    
    // Route::post('createbill', 'BillController@store')->name('bills.store');
    // Route::post('save-items', 'BillController@saveItems')->name('bills.item.store');
    // Route::post('update-items', 'BillController@updateItems')->name('bills.item.update');
    // Route::post('get-items', 'BillController@getItems')->name('bills.getItems');
    // Route::post('gethostguests', 'BillController@getHostGuest')->name('bills.hostguest');
    

});
