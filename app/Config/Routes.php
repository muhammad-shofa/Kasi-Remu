<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  pages endpoint
$routes->get('/', 'PagesController::dashboard');
$routes->get('/user-management', 'PagesController::userManagement');
$routes->get('/item-management', 'PagesController::itemManagement');
$routes->get('/login', 'PagesController::login');

// user endpoint
$routes->get("/api/user/get-users", "UserController::getUsers");
$routes->post("/api/user/add-user", "UserController::addUser");
$routes->get("/api/user/get-edit/(:num)", "UserController::getEdit/$1");
$routes->post("/api/user/save-edit/(:num)", "UserController::saveEdit/$1");
$routes->delete('/api/user/delete-user/(:num)', 'UserController::deleteUser/$1');

// auth endpoint
$routes->post('/api/auth/login', 'UserController::login');
