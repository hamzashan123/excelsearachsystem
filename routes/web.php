<?php

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);

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

    // Documents
    // Route::delete('document/destroy', 'PurchaseController@massDestroy')->name('document.massDestroy');
    // Route::resource('documents', 'DocumentsController');
    Route::get('purchaselist', 'PurchaseController@list')->name('purchaser.list');
    Route::post('purchase-create', 'PurchaseController@create')->name('purchaser.create');
    Route::post('purchase-edit/{id}', 'PurchaseController@edit')->name('purchaser.edit');

    Route::get('recievelist', 'RecieveController@list')->name('reciever.list');
    Route::post('reciever-edit/{id}', 'RecieveController@edit')->name('purchaser.edit');
    

});
