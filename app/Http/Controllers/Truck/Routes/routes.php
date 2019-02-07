<?php

   // sample test route
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });

    $router->get('/trucks', 'IndexController@index');
    $router->post('/trucks', 'IndexController@registerTrucker');
    $router->get('/trucks-notloaded/', 'IndexController@truckNotLoaded');
    $router->post('/trucks-filter/', 'IndexController@filter');
   /* $router->delete('/{id}', 'IndexController@destroy');*/

