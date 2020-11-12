<?php

require_once '../vendor/autoload.php';

session_start();

/* ------------
--- ROUTAGE ---
-------------*/

$router = new AltoRouter();

if (array_key_exists('BASE_URI', $_SERVER)) {
    $router->setBasePath($_SERVER['BASE_URI']);
}
else {
    $_SERVER['BASE_URI'] = '/';
}

$router->map('GET', '/', 'MainController#home', 'main-home');

//affichage de la liste des catégories
$router->map('GET', '/category/list', 'CategoryController#list', 'category-list');

//ajout de categorie
$router->map('GET|POST', '/category/add', 'CategoryController#add', 'category-add');

//modification de catégorie
$router->map('GET|POST', '/category/edit/[i:id]', 'CategoryController#edit', 'category-edit');

//suppression d'une catégorie
$router->map('GET', '/category/delete/[i:id]', 'CategoryController#delete', 'category-delete');

//affichage de la liste des produits
$router->map('GET', '/product/list', 'ProductController#list', 'product-list');

//ajout de produit
$router->map('GET|POST', '/product/add', 'ProductController#add', 'product-add');

//modification de produit
$router->map('GET|POST', '/product/edit/[i:id]', 'ProductController#edit', 'product-edit');

//suppression d'un produit
$router->map('GET', '/product/delete/[i:id]', 'ProductController#delete', 'product-delete');

//affichage de la liste des marques
$router->map('GET', '/brand/list', 'BrandController#list', 'brand-list');

//ajout de marque
$router->map('GET|POST', '/brand/add', 'BrandController#add', 'brand-add');

//modification de marque
$router->map('GET|POST', '/brand/edit/[i:id]', 'BrandController#edit', 'brand-edit');

//suppression d'une marque
$router->map('GET', '/brand/delete/[i:id]', 'BrandController#delete', 'brand-delete');

//formulaire modification des marques dans le footer
$router->map('GET|POST', '/brand/footer/edit', 'BrandController#footerEdit', 'brand-footer-edit');

//formulaire modification des types de produits dans le footer
$router->map('GET|POST', '/type/footer/edit', 'TypeController#footerEdit', 'type-footer-edit');

//affichage de la liste des types
$router->map('GET', '/type/list', 'TypeController#list', 'type-list');

//ajout d'un type
$router->map('GET|POST', '/type/add', 'TypeController#add', 'type-add');

//modification d'un type
$router->map('GET|POST', '/type/edit/[i:id]', 'TypeController#edit', 'type-edit');

//suppression d'un type
$router->map('GET', '/type/delete/[i:id]', 'TypeController#delete', 'type-delete');

//affiche formulaire de connexion d'un utilisateur
$router->map('GET|POST', '/login', 'AppUserController#login', 'user-login');

//permet la déconnexion d'un utilisateur
$router->map('GET', '/logout', 'AppUserController#logout', 'user-logout');

//affichage de la liste des utilisateurs
$router->map('GET', '/user/list', 'AppUserController#list', 'user-list');

//affichage de la page d'ajout d'un utilisateur
$router->map('GET|POST', '/user/add', 'AppUserController#add', 'user-add');

//affichage du menu d'édition des catégories mises en avant sur la home
$router->map('GET|POST', '/category/home/edit', 'CategoryController#homeEdit', 'home-edit');

/* -------------
--- DISPATCH ---
--------------*/

$match = $router->match();
//dump($match);
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

$dispatcher->setControllersNamespace('\App\Controllers');

$dispatcher->dispatch();
