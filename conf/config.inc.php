<?php

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'sae202');
define('DB_USER', 'agence-sae202');
define('DB_PASS', 'Gedeon2014@a');
define('DB_CHARSET', 'utf8mb4');

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die('Erreur connexion BDD : ' . $e->getMessage());
}
?>