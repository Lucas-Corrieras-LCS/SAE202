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
        $stmt = $this->pdo->prepare("INSERT INTO commentaire (user_id, contenu, approuve, is_approved, date) VALUES (?, ?, 0, 0, NOW())");
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
        return $stmt->execute([$id]);
    }

    public function refuserCommentaire($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM commentaire WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getCommentairesNonApprouves()
    {
        $stmt = $this->pdo->query("SELECT * FROM commentaire WHERE approuve = 0 ORDER BY date DESC");
        return $stmt->fetchAll();
    }

    public function obtenirTousCommentaires()
    {
        $stmt = $this->pdo->query("SELECT * FROM commentaire ORDER BY date DESC");
        return $stmt->fetchAll();
    }

    public function getCommentaireById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM commentaire WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function modifierCommentaire($id, $contenu, $approuve)
    {
        $stmt = $this->pdo->prepare("UPDATE commentaire SET contenu = ?, approuve = ? WHERE id = ?");
        return $stmt->execute([$contenu, $approuve, $id]);
    }
}
?>