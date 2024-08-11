<?php

use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {
    $routes->scope('/api', function ($routes) {
        $routes->setExtensions(['json']);

        $routes->setExtensions(['json']);
        $routes->resources('Posts');
    });
};
