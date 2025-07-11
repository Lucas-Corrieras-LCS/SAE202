<?php
require_once __DIR__ . '/../model/UtilisateurAdmin.php';
require_once __DIR__ . '/../model/Commentaire.php';

class DashboardController
{
    public function index()
    {
        global $pdo;
        $utilisateurModel = new Utilisateur($pdo);
        $commentaireModel = new Commentaire($pdo);

        $stmt = $pdo->query("SELECT COUNT(*) FROM user");
        $totalUtilisateurs = $stmt ? $stmt->fetchColumn() : 0;

        $stmt = $pdo->query("SELECT COUNT(*) FROM commentaire");
        $totalCommentaires = $stmt ? $stmt->fetchColumn() : 0;

        $stmt = $pdo->query("SELECT COUNT(*) FROM commentaire WHERE is_approved = 0");
        $commentairesEnAttente = $stmt ? $stmt->fetchColumn() : 0;

        require __DIR__ . '/../view/dashboard.php';
    }

    public function json()
    {
        global $pdo;
        header('Content-Type: application/json');
        $nbUsers = $pdo->query("SELECT COUNT(*) FROM user")->fetchColumn();
        $nbCommentaires = $pdo->query("SELECT COUNT(*) FROM commentaire")->fetchColumn();
        $nbCommentairesEnAttente = $pdo->query("SELECT COUNT(*) FROM commentaire WHERE is_approved = 0")->fetchColumn();
        echo json_encode([
            'nbUsers' => $nbUsers,
            'nbCommentaires' => $nbCommentaires,
            'nbCommentairesEnAttente' => $nbCommentairesEnAttente,
        ]);
        exit;
    }
}
?>