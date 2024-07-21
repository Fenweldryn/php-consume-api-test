<?php

use App\Controllers\EventController;
use App\Router;

$router = new Router();

$router->get('/events', EventController::class, 'index');
$router->get('/events/:id', EventController::class, 'show');
$router->post('/events', EventController::class, 'create');

$router->dispatch();