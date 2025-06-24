<?php
require_once 'model/AccueilModel.php';
require_once 'model/Commentaire.php';

class AccueilController
{
    public function index()
    {
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $contenu = trim($_POST['contenu']);
            $note = isset($_POST['note']) ? intval($_POST['note']) : 5;
            if (!empty($contenu) && $note >= 1 && $note <= 5) {
                $commentaireModel = new Commentaire($pdo);
                $commentaireModel->ajouterCommentaire($_SESSION['user_id'], $contenu, $note);
                header('Location: /index.html');
                exit;
            }
        }

        $model = new AccueilModel();
        $donnees = $model->getAccueil();


        $commentaireModel = new Commentaire($pdo);
        $donnees = $commentaireModel->obtenirCommentaires();

        require 'view/accueil.php';
    }

    public function json()
    {
        global $pdo;
        $commentaireModel = new Commentaire($pdo);
        $donnees = $commentaireModel->obtenirCommentaires();
        $isConnected = !empty($_SESSION['user_id']);
        $isAdmin = !empty($_SESSION['is_admin']);

        echo json_encode([
            'commentaires' => $donnees,
            'isConnected' => $isConnected,
            'isAdmin' => $isAdmin
        ]);
    }
}
?>