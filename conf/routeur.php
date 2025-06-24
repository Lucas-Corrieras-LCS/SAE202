<?php
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.cookie_secure', '1');

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/config.inc.php';

$page = $_GET['page'] ?? 'accueil';
$format = $_GET['format'] ?? 'html';

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
    http_response_code(404);
    include __DIR__ . '/../404.html';
    exit;
}

$pages_privees = ['messagerie', 'profil', 'commentaire/proposer'];
if (in_array($page, $pages_privees) && empty($_SESSION['user_id'])) {
    if ($format === 'json') {
        ob_end_clean();
        header('Content-Type: application/json');
        echo json_encode(['isConnected' => false]);
        exit;
    }
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

if ($format === 'json') {
    $controllerFile = 'controller/' . ucfirst($page) . 'Controller.php';
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controllerClass = ucfirst($page) . 'Controller';
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, 'json')) {
                header('Content-Type: application/json');
                echo $controller->json();
                exit;
            } elseif (method_exists($controller, 'index')) {
                $controller->index();
                exit;
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Page non trouvée']);
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

http_response_code(404);
include __DIR__ . '/404.html';
exit;
?>