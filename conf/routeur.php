<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . '/config.inc.php';

$page = $_GET['page'] ?? 'accueil';
$pages_autorisees = [
    'accueil',
    'concept',
    'infos',
    'inscription',
    'connexion',
    'mentions-legales',
    'messagerie',
    'commentaire/proposer',
    'profil',
    'deconnexion',
    'supprimer_message'
];

if (!in_array($page, $pages_autorisees)) {
    $page = 'accueil';
}

$pages_privees = ['messagerie', 'profil', 'commentaire/proposer'];
if (in_array($page, $pages_privees) && empty($_SESSION['user_id'])) {
    echo '<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Accès refusé</title>
    </head>
    <body>
        <h1>Accès refusé</h1>
        <p>Vous devez être connecté pour accéder à cette page. <a href="/sae202/?page=inscription">Inscrivez-vous</a> ou <a href="/sae202/?page=connexion">connectez-vous</a>.</p>
    </body>
    </html>';
    exit;
}

if ($page === 'profil' && isset($_GET['action']) && $_GET['action'] === 'update') {
    require_once 'controller/ProfilController.php';
    $controller = new ProfilController();
    $controller->update();
    exit;
}

if ($page === 'messagerie' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'controller/MessagerieController.php';
    $controller = new MessagerieController();
    $controller->envoyer();
    exit;
}

if ($page === 'supprimer_message' && isset($_GET['id'])) {
    require_once 'controller/MessagerieController.php';
    $controller = new MessagerieController();
    $controller->supprimer();
    exit;
}

$controllerFile = 'controller/' . ucfirst($page) . 'Controller.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($page) . 'Controller';
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        $controller->index();
        exit;
    }
}

echo "Page non trouvée.";
?>