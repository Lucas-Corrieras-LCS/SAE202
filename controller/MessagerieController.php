<?php
require_once 'model/Message.php';

class MessagerieController
{
    public function index()
    {
        global $pdo;
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            $stmt = $pdo->prepare("
                SELECT m.*, u.prenom AS expediteur_prenom, u.nom AS expediteur_nom, u.email AS expediteur_email
                FROM message m
                JOIN user u ON m.expediteur_id = u.id
                ORDER BY m.created_at DESC
            ");
            $stmt->execute();
            $messages = $stmt->fetchAll();
        } else {
            $messages = Message::recupererMessages($_SESSION['user_id'], $pdo);
        }

        $stmt = $pdo->prepare("SELECT id, nom, prenom, email FROM user WHERE is_admin = 1 AND id != ?");
        $stmt->execute([$_SESSION['user_id']]);
        $admins = $stmt->fetchAll();

        $stmt = $pdo->prepare("SELECT id, nom, prenom, email FROM user WHERE is_admin = 0");
        $stmt->execute();
        $utilisateurs = $stmt->fetchAll();

        require 'view/messagerie.php';
    }

    public function envoyer()
    {
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contenu = isset($_POST['contenu']) ? htmlspecialchars(trim($_POST['contenu'])) : '';
            $destinataire_id = isset($_POST['destinataire_id']) ? intval($_POST['destinataire_id']) : 0;

            if (!empty($contenu) && $destinataire_id > 0) {
                Message::envoyerMessage($_SESSION['user_id'], $destinataire_id, $contenu, $pdo);
                header('Location: /messagerie.html');
                exit;
            }
        }
        $messages = Message::recupererMessages($_SESSION['user_id'], $pdo);

        $stmt = $pdo->prepare("SELECT id, nom, prenom, email FROM user WHERE is_admin = 1 AND id != ?");
        $stmt->execute([$_SESSION['user_id']]);
        $admins = $stmt->fetchAll();

        $stmt = $pdo->prepare("SELECT id, nom, prenom, email FROM user WHERE is_admin = 0");
        $stmt->execute();
        $utilisateurs = $stmt->fetchAll();

        require 'view/messagerie.php';
    }

    public function supprimer()
    {
        global $pdo;
        $success = false;
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $success = Message::supprimerMessage(intval($_GET['id']), $pdo);
        }


        if (
            isset($_SERVER['HTTP_ACCEPT']) &&
            strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false
        ) {
            header('Content-Type: application/json');
            echo json_encode(['success' => $success]);
            exit;
        }

        header('Location: /messagerie.html');
        exit;
    }

    public function json()
    {
        global $pdo;
        header('Content-Type: application/json');
        if (empty($_SESSION['user_id'])) {
            echo json_encode(['isConnected' => false]);
            exit;
        }

        $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
        if ($isAdmin) {
            $stmt = $pdo->prepare("
                SELECT m.*, u.prenom AS expediteur_prenom, u.nom AS expediteur_nom, u.email AS expediteur_email
                FROM message m
                JOIN user u ON m.expediteur_id = u.id
                ORDER BY m.created_at DESC
            ");
            $stmt->execute();
            $messages = $stmt->fetchAll();
        } else {
            $messages = Message::recupererMessages($_SESSION['user_id'], $pdo);
        }

        $stmt = $pdo->prepare("SELECT id, nom, prenom, email FROM user WHERE is_admin = 1 AND id != ?");
        $stmt->execute([$_SESSION['user_id']]);
        $admins = $stmt->fetchAll();

        $stmt = $pdo->prepare("SELECT id, nom, prenom, email FROM user WHERE is_admin = 0");
        $stmt->execute();
        $utilisateurs = $stmt->fetchAll();

        echo json_encode([
            'isConnected' => true,
            'isAdmin' => $isAdmin,
            'messages' => $messages,
            'admins' => $admins,
            'utilisateurs' => $utilisateurs,
            'user_id' => $_SESSION['user_id'],
        ]);
        exit;
    }
}
?>