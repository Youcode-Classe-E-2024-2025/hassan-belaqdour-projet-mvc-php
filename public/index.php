<?php

require_once '../app/controllers/AuthController.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

$authController = new AuthController();

switch ($action) {
    case 'login':
        $authController->login();
        break;
    case 'signup':
        $authController->signup();
        break;
    default:
        include '../app/views/login.php';
        break;
}