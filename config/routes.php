<?php

use app\middlewares\ProcessRawBody;
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::setDefaultNamespace('app\controllers');

Router::group([
    'prefix' => 'api/v1',
    'middleware' => [
        ProcessRawBody::class
    ]
], function () {
    Router::get('/create-check', 'CaffeController@createCheck');
    Router::get('/add-dish-to-check', 'CaffeController@addDish');
});
