<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::setDefaultNamespace('app\controllers');

Router::group([
    'prefix' => 'api/v1',
], function () {
    Router::post('/receipt/dish/{dishId}', 'CaffeController@createReceipt');
    Router::patch('/receipt/{id}/dish/{dishId}', 'CaffeController@addToReceipt');
    Router::get('/cook', 'CaffeController@getPopularCook');
});
