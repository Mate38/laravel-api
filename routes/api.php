<?php

$this->get('products', 'API\ProductController@index', ['except' => [
    'create', 'edit'
]]);

$this->post('products', 'API\ProductController@store', ['except' => [
    'create', 'edit'
]]);

