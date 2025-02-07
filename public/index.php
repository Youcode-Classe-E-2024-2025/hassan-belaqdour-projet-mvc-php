<?php
// public/index.php

require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/controllers/front/AuthController.php';

session_start();

$router = new Router();

// Routes
$router->addRoute('/login', 'AuthController', 'showLogin');
$router->addRoute('/signup', 'AuthController', 'showSignup');
$router->addRoute('/login', 'AuthController', 'login');
$router->addRoute('/signup', 'AuthController', 'signup');

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($path);