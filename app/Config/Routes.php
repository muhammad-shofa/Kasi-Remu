<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  pages route
$routes->get('/', 'PagesController::dashboard');
$routes->get('/user-management', 'PagesController::userManagement');

// endpoint
$routes->get("/api/get-users", "UserController::getUsers");
