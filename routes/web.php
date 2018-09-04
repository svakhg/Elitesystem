<?php

Auth::routes();

Route::get('/','HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register',function(){ return redirect('home'); });
Route::post('/login/custom','Auth\LoginController@login')->name('login.custom');

Route::resource('/users','UserController');
Route::resource('/services','ServiceController');
Route::resource('/cycles','CycleController');
Route::resource('/packages','PackageController');
Route::resource('/members','MemberController');
Route::resource('/bar','BarController');
Route::resource('/purchases','PurchaseController');
Route::resource('/subscriptions','SubscriptionController');
Route::resource('/installments','InstallmentController');

// target routes
Route::post('/addTarget','TargetController@addTarget')->name('addTarget');
Route::get('/expireTarget','TargetController@expireTarget');

// turn routes
Route::get('/checkIfHasTurn','TurnController@checkIfHasTurn');
Route::post('/deactivateCurrentTurn','TurnController@deactivateCurrentTurn')->name('deactivateCurrentTurn');

/**** AJAX ROUTES ****/
Route::post('/getProductPriceById/{id}','AjaxController@getProdouctPriceById');
Route::post('/getProductQtyById/{id}','AjaxController@getProductQtyById');
Route::post('/getMemberDebtById/{id}','AjaxController@getMemberDebtById');
Route::post('/checkIfAlreadySybscribed/{id}','AjaxController@checkIfAlreadySybscribed');
Route::post('/getUserDebtById/{id}','AjaxController@getUserDebtById');
Route::post('/addRecievmentBySubscriptionId/{id}','AjaxController@addRecievmentBySubscriptionId');
Route::get('/getCheckInUsers', 'AjaxController@getCheckInUsers');
Route::post('/checkIn/{id}','AjaxController@checkIn');
Route::post('/checkOut/{id}','AjaxController@checkOut');
Route::post('/searchMember','AjaxController@searchMember')->name('searchMember');