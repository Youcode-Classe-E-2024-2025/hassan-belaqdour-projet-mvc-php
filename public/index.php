<?php

require_once '../vendor/autoload.php'; // Charger Twig
require_once '../app/controllers/AuthController.php';
require_once '../config/database.php';

// Configuration de Twig
$loader = new \Twig\Loader\FilesystemLoader('../app/views');
$twig = new \Twig\Environment($loader);

// Créer une instance du contrôleur
$authController = new AuthController($twig);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'login':
        $authController->login();
        break;
    case 'signup':
        $authController->signup();
        break;
    default:
        echo $twig->render('login.twig');
        break;
}