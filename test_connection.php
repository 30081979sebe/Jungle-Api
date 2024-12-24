<?php
require_once 'config/database.php';

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connexion réussie à la base de données.';
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
