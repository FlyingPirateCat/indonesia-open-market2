<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// $routes->get('/', 'Home::index');
$routes->get('/', 'Pages::index');


//$routes->get('/product', 'Product::index');
$routes->get('/product/all', 'Product::product_type/-1');
$routes->get('/product/product_home', 'Product::product_type/0');
$routes->get('/product/product_agri', 'Product::product_type/1');
$routes->get('/product/product_sea', 'Product::product_type/2');
$routes->get('/product/product_mining', 'Product::product_type/3');
$routes->get('/product/product_culinary', 'Product::product_type/4');
$routes->get('/product/product_tour', 'Product::product_type/5');

$routes->get('/product/create', 'Product::create', ['filter' => 'login']);
$routes->get('/product/edit/(:segment)', 'Product::edit/$1', ['filter' => 'login']);
$routes->delete('/product/(:num)', 'Product::delete/$1', ['filter' => 'login']);

$routes->get('/product/add_cart/(:num)', 'Product::add_to_cart/$1');
$routes->get('/product/delete_cart/(:segment)', 'Product::delete_from_cart/$1');

$routes->get('/product/clear_cart', 'Product::clear_cart');
$routes->post('/product/update_cart', 'Product::update_cart');
$routes->get('/product/(:any)', 'Product::detail/$1');



$routes->get('/user', 'User::index', ['filter' => 'login']);
$routes->get('/user/index', 'User::index', ['filter' => 'login']);
$routes->get('/user/cart', 'User::cart', ['filter' => 'login']);
$routes->get('/user/(:num)', 'User::detail_profile/$1');



$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/(:num)', 'Admin::detail/$1', ['filter' => 'role:admin']);
