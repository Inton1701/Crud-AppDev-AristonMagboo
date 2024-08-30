<?php
$db_server = 'localhost';
$db_name = 'productsdb';
$db_user = 'root';
$db_password = '';

try{
    $pdo = new PDO ("mysql:host={$db_server}; dbname={$db_name};", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connected";
}catch(PDOException $e){
    die("Connection failed ". $e->getMessage());
}