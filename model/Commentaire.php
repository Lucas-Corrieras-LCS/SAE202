<?php
class Commentaire
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function ajouterCommentaire($user_id, $contenu)
    {
        $stmt = $this->pdo->prepare("INSERT INTO commentaire (user_id, contenu, is_approved, created_at) VALUES (?, ?, 0, NOW())");
        return $stmt->execute([$user_id, $contenu]);
    }

    public function obtenirCommentaires()
    {
        $stmt = $this->pdo->query("SELECT * FROM commentaire WHERE is_approved = 1 ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function approuverCommentaire($id)
    {
        $stmt = $this->pdo->prepare("UPDATE commentaire SET is_approved = 1 WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function refuserCommentaire($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM commentaire WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function obtenirCommentairesNonApprouves()
    {
        $stmt = $this->pdo->query("SELECT * FROM commentaire WHERE is_approved = 0 ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
}
?>