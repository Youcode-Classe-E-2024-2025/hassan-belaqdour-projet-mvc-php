<?php
// app/core/View.php

require_once __DIR__ . '/../../vendor/autoload.php';

class View
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new \Twig\Environment($loader);
    }

    public function render($template, $data = [])
    {
        echo $this->twig->render($template, $data);
    }
}