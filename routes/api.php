<?php

$this->post('products/search', 'API\ProductController@search');

$this->resource('products', 'API\ProductController', [
    'except' => [
        'create', 
        'edit'
    ]
]);
