<?php
require_once 'model/Message.php';

class MessagerieController
{
    public function index()
    {
        global $pdo;
        $messages = Message::recupererMessages($_SESSION['user_id'], $pdo);

        $stmt = $pdo->prepare("SELECT id, nom, prenom, email FROM user WHERE is_admin = 1 AND id != ?");
        $stmt->execute([$_SESSION['user_id']]);
        $admins = $stmt->fetchAll();

        require 'view/messagerie.php';
    }

    public function envoyer()
    {
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contenu = htmlspecialchars(trim($_POST['contenu']));
            $destinataire_id = intval($_POST['destinataire_id']);

            if (!empty($contenu) && $destinataire_id > 0) {
                Message::envoyerMessage($_SESSION['user_id'], $destinataire_id, $contenu, $pdo);
                header('Location: /?page=messagerie');
                exit;
            }
        }
        $messages = Message::recupererMessages($_SESSION['user_id'], $pdo);

        $stmt = $pdo->prepare("SELECT id, nom, prenom, email FROM user WHERE is_admin = 1 AND id != ?");
        $stmt->execute([$_SESSION['user_id']]);
        $admins = $stmt->fetchAll();

        require 'view/messagerie.php';
    }
}
?>