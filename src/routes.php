<?php
Route::group(['middleware' => 'web'], function(){
    Route::resource('products', 'Kajifat\SampleProducts\ProductsController', ['except' => 'show']);
});