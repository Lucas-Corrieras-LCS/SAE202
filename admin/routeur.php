<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . '/../conf/config.inc.php';
require_once 'controller/UtilisateurController.php';
require_once 'controller/CommentaireController.php';
require_once 'controller/DashboardController.php';

if (empty($_SESSION['user_id']) || empty($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo '<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Accès refusé</title>
    </head>
    <body>
        <h1>Accès refusé</h1>
        <p>Vous n\'êtes pas admin. <a href="/sae202/?page=inscription">Inscrivez-vous</a> ou <a href="/sae202/?page=connexion">connectez-vous</a> avec un compte admin.</p>
    </body>
    </html>';
    exit;
}

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {
    case 'utilisateurs':
        $controller = new UtilisateurController();
        $controller->gestionUtilisateurs();
        break;
    case 'modifier_utilisateur':
        $controller = new UtilisateurController();
        $controller->modifier($_GET['id'] ?? null);
        break;
    case 'supprimer_utilisateur':
        $controller = new UtilisateurController();
        $controller->supprimer($_GET['id'] ?? null);
        break;
    case 'commentaires':
        $controller = new CommentaireController();
        $controller->index();
        break;
    case 'dashboard':
    default:
        $controller = new DashboardController();
        $controller->index();
        break;
    case 'approuver_commentaire':
        $controller = new CommentaireController();
        $controller->approuver($_GET['id'] ?? null);
        break;
    case 'refuser_commentaire':
        $controller = new CommentaireController();
        $controller->refuser($_GET['id'] ?? null);
        break;
    case 'modifier_commentaire':
        $controller = new CommentaireController();
        $controller->modifier($_GET['id'] ?? null);
        break;
    case 'supprimer_commentaire':
        $controller = new CommentaireController();
        $controller->supprimer($_GET['id'] ?? null);
        break;
}
?>