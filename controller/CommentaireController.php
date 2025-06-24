<?php
require_once '../model/Commentaire.php';

class CommentaireController
{
    public function index()
    {
        global $pdo;
        $model = new Commentaire($pdo);
        $commentaires = $model->obtenirCommentairesNonApprouves();
        require '../view/commentaires.php';
    }

    public function approuver($id)
    {
        global $pdo;
        $model = new Commentaire($pdo);
        $model->approuverCommentaire($id);
        header('Location: /?page=commentaires');
        exit;
    }

    public function refuser($id)
    {
        global $pdo;
        $model = new Commentaire($pdo);
        $model->refuserCommentaire($id);
        header('Location: /?page=commentaires');
        exit;
    }
}
?>