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

// auth endpoint
$routes->post('/api/auth/login', 'UserController::login');

// main dashboard endpoint
$routes->get("/api/dashboard/count-data", "DashboardController::countData");

// user endpoint
$routes->get("/api/user/get-users", "UserController::getUsers");
$routes->post("/api/user/add-user", "UserController::addUser");
$routes->get("/api/user/get-edit/(:num)", "UserController::getEdit/$1");
$routes->post("/api/user/save-edit/(:num)", "UserController::saveEdit/$1");
$routes->delete('/api/user/delete-user/(:num)', 'UserController::deleteUser/$1');

// item endpoint
$routes->get('/api/item/get-items', 'ItemController::getItems');
$routes->post('/api/item/add-item', 'ItemController::addItem');
$routes->get("/api/item/get-edit/(:num)", "ItemController::getEdit/$1");
$routes->delete('/api/item/delete-item/(:num)', 'ItemController::deleteItem/$1');

// category endpoint
$routes->get('/api/category/get-categories', 'CategoryController::getCategories');
$routes->post('/api/category/add-category', 'CategoryController::addCategory');
$routes->get('/api/category/search', 'CategoryController::search');
