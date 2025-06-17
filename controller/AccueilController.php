<?php
require_once 'model/AccueilModel.php';
require_once 'admin/model/Commentaire.php';

class AccueilController
{
    public function index()
    {
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $contenu = trim($_POST['contenu']);
            if (!empty($contenu)) {
                $commentaireModel = new Commentaire($pdo);
                $commentaireModel->ajouterCommentaire($_SESSION['user_id'], $contenu);
                header('Location: /index.html');
                exit;
            }
        }

        $model = new AccueilModel();
        $donnees = $model->getAccueil();


        $commentaireModel = new Commentaire($pdo);
        $commentaires = $commentaireModel->obtenirCommentaires();

        require 'view/accueil.php';
    }

    public function json()
    {
        $model = new AccueilModel();
        $donnees = $model->getAccueil();

        $isConnected = isset($_SESSION['user_id']);
        $isAdmin = !empty($_SESSION['is_admin']);

        echo json_encode([
            'commentaires' => $donnees,
            'isConnected' => $isConnected,
            'isAdmin' => $isAdmin
        ]);
    }
}
?>