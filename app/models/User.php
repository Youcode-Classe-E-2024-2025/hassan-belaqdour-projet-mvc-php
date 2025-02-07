<?php

class User
{
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Inscription d'un utilisateur
    public function signup()
    {
        $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);

        // Nettoyer les données
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // Hasher le mot de passe
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        // Lier les valeurs
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);

        // Exécuter la requête
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Connexion d'un utilisateur
    public function login()
    {
        $query = "SELECT id, username, password FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);

        // Nettoyer les données
        $this->username = htmlspecialchars(strip_tags($this->username));

        // Lier les valeurs
        $stmt->bindParam(":username", $this->username);

        // Exécuter la requête
        $stmt->execute();

        // Vérifier si l'utilisateur existe
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier le mot de passe
            if (password_verify($this->password, $row['password'])) {
                $this->id = $row['id'];
                $this->username = $row['username'];
                return true;
            }
        }
        return false;
    }
}