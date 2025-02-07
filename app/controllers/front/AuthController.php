<?php
// app/controllers/front/AuthController.php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../../models/User.php';

class AuthController extends Controller
{
    private $user;
    private $view;

    public function __construct()
    {
        $this->user = new User();
        $this->view = new View();
    }

    public function showLogin()
    {
        $this->view->render('front/login.twig');
    }

    public function showSignup()
    {
        $this->view->render('front/signup.twig');
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = $this->user->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            // Authentification réussie
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header('Location: /');
        } else {
            // Authentification échouée
            $this->view->render('front/login.twig', ['error' => 'Invalid credentials']);
        }
    }

    public function signup()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $this->user->create($username, $password);
        header('Location: /login');
    }
}