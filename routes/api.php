<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'API'], function(){

    Route::resource('categories', 'CategoryAPIController');
    Route::resource('products', 'ProductAPIController');

});
