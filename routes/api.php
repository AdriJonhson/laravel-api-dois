<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function(){
   return response()->json('welcome', 200);
});

Route::group(['namespace' => 'API'], function(){
    Route::resource('categories', 'CategoryAPIController')->except(['show']);
    Route::resource('products', 'ProductAPIController')->except(['show', 'update']);

    Route::get('/products/show/{category}', 'ProductAPIController@listCategory');
    Route::put('/products/disable/', 'ProductAPIController@disableProduct');
    Route::get('/products/disabled', 'ProductAPIController@listDisableProducts');
    Route::put('/product/enable', 'ProductAPIController@enableProduct');
});
