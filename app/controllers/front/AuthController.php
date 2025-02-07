<?php

require_once '../models/User.php';
require_once '../config/database.php';

class AuthController
{
    private $user;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->user = new User($db);
    }

    // Inscription
    public function signup()
    {
        if ($_POST) {
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            if ($this->user->signup()) {
                echo "Inscription réussie !";
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    }

    // Connexion
    public function login()
    {
        if ($_POST) {
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            if ($this->user->login()) {
                echo "Connexion réussie ! Bienvenue, " . $this->user->username;
            } else {
                echo "Identifiants incorrects.";
            }
        }
    }
}