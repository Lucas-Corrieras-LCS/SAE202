<?php
require_once __DIR__ . '/../model/Commentaire.php';

class CommentaireController
{
    public function index()
    {
        global $pdo;
        $model = new Commentaire($pdo);
        $commentaires = $model->getCommentairesNonApprouves();
        $tousCommentaires = $model->obtenirTousCommentaires();
        require __DIR__ . '/../view/commentaires.php';
    }

    public function approuver($id)
    {
        global $pdo;
        $model = new Commentaire($pdo);
        $model->approuverCommentaire($id);

        if (
            isset($_SERVER['HTTP_ACCEPT']) &&
            strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false
        ) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }

        header('Location: /commentaires.html');
        exit;
    }

    public function refuser($id)
    {
        global $pdo;
        $model = new Commentaire($pdo);
        $model->refuserCommentaire($id);
        header('Location: /gestion/commentaires.html');
        exit;
    }

    public function modifier($id)
    {
        global $pdo;
        $model = new Commentaire($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contenu = $_POST['contenu'];
            $is_approved = isset($_POST['is_approved']) ? 1 : 0;
            $model->modifierCommentaire($id, $contenu, $is_approved);

            if (
                isset($_SERVER['HTTP_ACCEPT']) &&
                strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false
            ) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
                exit;
            }

            header('Location: /gestion/commentaires.html');
            exit;
        }

        $commentaire = $model->getCommentaireById($id);
        require __DIR__ . '/../view/modifier_commentaire.php';
    }

    public function supprimer($id)
    {
        global $pdo;
        $model = new Commentaire($pdo);
        $model->refuserCommentaire($id);
        header('Location: /gestion/commentaires.html');
        exit;
    }

    public function commentaires_json()
    {
        global $pdo;
        header('Content-Type: application/json');
        $model = new Commentaire($pdo);
        $commentaires = $model->getCommentairesNonApprouves();
        $tousCommentaires = $model->obtenirTousCommentaires();
        echo json_encode([
            'commentaires' => $commentaires,
            'tousCommentaires' => $tousCommentaires
        ]);
        exit;
    }

    public function jsonById($id)
    {
        global $pdo;
        header('Content-Type: application/json');
        $model = new Commentaire($pdo);
        $commentaire = $model->getCommentaireById($id);
        echo json_encode(['commentaire' => $commentaire]);
        exit;
    }
}
?>