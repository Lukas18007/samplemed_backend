<?php

use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {
    $routes->scope('/api', function ($routes) {
        $routes->setExtensions(['json']);

        $routes->connect('/posts', ['controller' => 'Posts', 'action' => 'index', '_method' => 'GET']);
        
        $routes->connect(
            '/posts/:id', 
            ['controller' => 'Posts', 'action' => 'view', '_method' => 'GET']
        )->setPass(['id'])->setPatterns(['id' => '\d+']);

        $routes->connect('/posts', ['controller' => 'Posts', 'action' => 'add', '_method' => 'POST']);
        
        $routes->connect(
            '/posts/:id', 
            ['controller' => 'Posts', 'action' => 'delete', '_method' => 'DELETE']
        )->setPass(['id'])->setPatterns(['id' => '\d+']);
    });
};
