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
        header('Location: /sae202/admin/routeur.php?page=commentaires');
        exit;
    }

    public function refuser($id)
    {
        global $pdo;
        $model = new Commentaire($pdo);
        $model->refuserCommentaire($id);
        header('Location: /sae202/admin/routeur.php?page=commentaires');
        exit;
    }
    public function modifier($id)
    {
        global $pdo;
        $model = new Commentaire($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contenu = $_POST['contenu'];
            $approuve = isset($_POST['approuve']) ? 1 : 0;
            $model->modifierCommentaire($id, $contenu, $approuve);
            header('Location: /sae202/admin/routeur.php?page=commentaires');
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
        header('Location: /sae202/admin/routeur.php?page=commentaires');
        exit;
    }
}

?>