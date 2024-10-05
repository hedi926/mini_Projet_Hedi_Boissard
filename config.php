<?php
$host = 'localhost';
$db = 'test';
$user = 'hedi'; 
$pass = '1234'; 

try {
    
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass); // cette ligne sert à faire une connexion avec la base de données
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage()); // cette ligne sert à catch une erreur et s'il y'en a une affichier le message "Could not..."
}
?>
