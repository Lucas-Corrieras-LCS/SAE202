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
        $stmt = $this->pdo->prepare("INSERT INTO commentaire (user_id, contenu, approuve, date) VALUES (?, ?, 0, NOW())");
        return $stmt->execute([$user_id, $contenu]);
    }

    public function obtenirCommentaires()
    {
        $stmt = $this->pdo->query("SELECT * FROM commentaire WHERE approuve = 1 ORDER BY date DESC");
        return $stmt->fetchAll();
    }

    public function approuverCommentaire($id)
    {
        $stmt = $this->pdo->prepare("UPDATE commentaire SET approuve = 1 WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function refuserCommentaire($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM commentaire WHERE id = ?");
        $stmt->execute([$id]);
    }
    public function obtenirCommentairesNonApprouves()
    {
        $stmt = $this->pdo->query("SELECT * FROM commentaire WHERE approuve = 0 ORDER BY date DESC");
        return $stmt->fetchAll();
    }
}
?>