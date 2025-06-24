<?php
ini_set('session.cookie_path', '/');
ini_set('session.cookie_domain', 'mmi24b11.sae202.ovh');
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.cookie_secure', '1');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/../conf/config.inc.php';
require_once __DIR__ . '/controller/UtilisateurController.php';
require_once __DIR__ . '/controller/CommentaireController.php';
require_once __DIR__ . '/controller/DashboardController.php';

$page = $_GET['page'] ?? 'dashboard';

if (empty($_SESSION['user_id']) || empty($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Accès refusé', 'isConnected' => false, 'isAdmin' => false]);
    exit;
}

if ($page === 'utilisateur_json' && isset($_GET['id'])) {
    require_once 'controller/UtilisateurController.php';
    $controller = new UtilisateurController();
    $controller->jsonById($_GET['id']);
    exit;
}

if ($page === 'commentaire_json' && isset($_GET['id'])) {
    $controller = new CommentaireController();
    $controller->jsonById($_GET['id']);
    exit;
}

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
    case 'dashboard_json':
        $controller = new DashboardController();
        $controller->json();
        break;
    case 'utilisateurs_json':
        $controller = new UtilisateurController();
        $controller->json();
        exit;
    case 'commentaires_json':
        $controller = new CommentaireController();
        $controller->commentaires_json();
        exit;
    case 'supprimer_message':
        if (isset($_GET['id'])) {
            require_once 'controller/MessagerieController.php';
            $controller = new MessagerieController();
            $controller->supprimer();
        }
        exit;
    default:
        header('Content-Type: application/json');
        http_response_code(404);
        echo json_encode(['error' => 'Page non trouvée.']);
        exit;
}