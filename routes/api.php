<?php

$this->post('auth', 'Auth\AuthApiController@authenticate');
$this->post('auth-refresh', 'Auth\AuthApiController@refreshToken');

$this->group(['middleware' => 'jwt.auth'], function(){

    $this->post('products/search', 'API\ProductController@search');
    
    $this->resource('products', 'API\ProductController', [
        'except' => [
            'create', 
            'edit'
        ]
    ]);

});


