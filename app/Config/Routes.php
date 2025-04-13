<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  pages route
$routes->get('/', 'PagesController::dashboard');
$routes->get('/user-management', 'PagesController::userManagement');
$routes->get('/item-management', 'PagesController::itemManagement');

// user endpoint
$routes->get("/api/user/get-users", "UserController::getUsers");
$routes->post("/api/user/add-user", "UserController::addUser");
$routes->get("/api/user/get-edit/(:num)", "UserController::getEdit/$1");
$routes->post("/api/user/save-edit/(:num)", "UserController::saveEdit/$1");
