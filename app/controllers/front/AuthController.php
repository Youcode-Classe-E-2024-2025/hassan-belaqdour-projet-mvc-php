<?php

require_once '../models/User.php';
require_once '../config/database.php';

class AuthController
{
    private $user;
    private $twig;

    public function __construct($twig)
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->user = new User($db);
        $this->twig = $twig;
    }

    // Inscription
    public function signup()
    {
        if ($_POST) {
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            if ($this->user->signup()) {
                echo $this->twig->render('signup.twig', ['message' => 'Inscription réussie !']);
            } else {
                echo $this->twig->render('signup.twig', ['message' => 'Erreur lors de l\'inscription.']);
            }
        } else {
            echo $this->twig->render('signup.twig');
        }
    }

    // Connexion
    public function login()
    {
        if ($_POST) {
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            if ($this->user->login()) {
                echo $this->twig->render('login.twig', ['message' => 'Connexion réussie ! Bienvenue, ' . $this->user->username]);
            } else {
                echo $this->twig->render('login.twig', ['message' => 'Identifiants incorrects.']);
            }
        } else {
            echo $this->twig->render('login.twig');
        }
    }
}