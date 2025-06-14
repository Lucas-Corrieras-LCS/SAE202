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
        $totalUtilisateurs = $stmt->fetchColumn();

        $stmt = $pdo->query("SELECT COUNT(*) FROM commentaire");
        $totalCommentaires = $stmt->fetchColumn();

        $stmt = $pdo->query("SELECT COUNT(*) FROM commentaire WHERE approuve = 0");
        $commentairesEnAttente = $stmt->fetchColumn();

        require __DIR__ . '/../view/dashboard.php';
    }
}
?>