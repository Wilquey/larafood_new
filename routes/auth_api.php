<?php

Route::group([
    'namespace' => 'Api',
    'middleware' => ['auth']
], function(){
    
    Route::get('/my-orders', 'Auth\OrderTenantControoller@index');
    Route::patch('/my-orders', 'Auth\OrderTenantController@update');
});



