<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  pages endpoint
$routes->get('/', 'PagesController::login');
$routes->get('/dashboard', 'PagesController::dashboard', ['filter' => 'role:admin,cashier,manager']);
$routes->get('/user-management', 'PagesController::userManagement', ['filter' => 'role:admin']);
$routes->get('/item-management', 'PagesController::itemManagement', ['filter' => 'role:admin']);
$routes->get('/create-transaction', 'PagesController::createTransaction', ['filter' => 'role:admin,cashier']);
$routes->get('/my-transactions', 'PagesController::myTransactions', ['filter' => 'role:admin,cashier']);
$routes->get('/all-transactions', 'PagesController::allTransactions', ['filter' => 'role:admin']);
$routes->get('/unauthorized', 'PagesController::unauthorized');

// auth endpoint
$routes->post('/api/auth/login', 'UserController::login');
$routes->get('/api/auth/logout', 'UserController::logout');

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

// transaction endpoint
$routes->post('/api/transaction/add-catalog-item', 'TransactionController::addCatalogItem');
$routes->get('/api/transaction/get-tmp-transaction', 'TransactionController::getTmpTransaction');
$routes->get('/api/transaction/get-my-transactions', 'TransactionController::getMyTransactions');
$routes->get('/api/transaction/get-all-transactions', 'TransactionController::getAllTransactions');
$routes->post('/api/transaction/min-qty', 'TransactionController::minQty');
$routes->post('/api/transaction/add-qty', 'TransactionController::addQty');
$routes->delete('/api/transaction/reset-cart', 'TransactionController::resetCart');
$routes->delete('/api/transaction/delete-item-cart/(:num)', 'TransactionController::deleteItemCart/$1');
$routes->post('/api/transaction/complete-transaction', 'TransactionController::completeTransaction');
$routes->get('/api/transaction/get-transaction-detail/(:num)', 'TransactionController::getTransactionDetail/$1');
