<?php

$this->get('products', 'API\ProductController@index', ['except' => [
    'create', 'edit'
]]);

