<?php

Route::get('cart', function(){
    echo 'Hello from the cart package!';
});

Route::resource('cart','Farris27\Cart\CartController');
Route::get('/cart/addProduct/ajax','Farris27\Cart\CartController@updateAjax')->name('addAjax');
Route::get('/cart/addProduct/globale','Farris27\Cart\CartController@updateAjaxGlobale')->name('addAjaxGlobale');
Route::post('/cart/addProduct/{slug}','Farris27\Cart\CartController@addCart')->name('addProduct');