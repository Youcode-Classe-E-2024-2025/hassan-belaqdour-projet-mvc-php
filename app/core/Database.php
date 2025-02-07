<?php
// app/core/Database.php

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $config = require __DIR__ . '/../config/config.php';
        $dsn = "pgsql:host={$config['db']['host']};dbname={$config['db']['dbname']}";
        $this->pdo = new PDO($dsn, $config['db']['user'], $config['db']['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }
}