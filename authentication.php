<?php
    require __DIR__ . '/vendor/autoload.php';
    $db = new \PDO('mysql:dbname=untitled_test;host=localhost;charset=utf8mb4', 'root', '');
    $auth = new \Delight\Auth\Auth($db) or die("Error connecting with the database.");
    //echo "SUCCESS";