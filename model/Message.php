<?php
class Message
{
    private $id;
    private $expediteur_id;
    private $destinataire_id;
    private $contenu;
    private $created_at;

    public function __construct($id, $expediteur_id, $destinataire_id, $contenu, $created_at)
    {
        $this->id = $id;
        $this->expediteur_id = $expediteur_id;
        $this->destinataire_id = $destinataire_id;
        $this->contenu = $contenu;
        $this->created_at = $created_at;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getExpediteurId()
    {
        return $this->expediteur_id;
    }

    public function getDestinataireId()
    {
        return $this->destinataire_id;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public static function envoyerMessage($expediteur_id, $destinataire_id, $contenu, $pdo)
    {
        $stmt = $pdo->prepare("INSERT INTO message (expediteur_id, destinataire_id, contenu, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$expediteur_id, $destinataire_id, $contenu]);
    }

    public static function recupererMessages($utilisateur_id, $pdo)
    {
        $stmt = $pdo->prepare("
            SELECT m.*, u.prenom AS expediteur_prenom, u.nom AS expediteur_nom, u.email AS expediteur_email
            FROM message m
            JOIN user u ON m.expediteur_id = u.id
            WHERE m.destinataire_id = ?
            ORDER BY m.created_at DESC
        ");
        $stmt->execute([$utilisateur_id]);
        return $stmt->fetchAll();
    }

    public static function recupererMessagesEnvoyes($utilisateur_id, $pdo)
    {
        $stmt = $pdo->prepare("
            SELECT m.*, u.prenom AS destinataire_prenom, u.nom AS destinataire_nom, u.email AS destinataire_email
            FROM message m
            JOIN user u ON m.destinataire_id = u.id
            WHERE m.expediteur_id = ?
            ORDER BY m.created_at DESC
        ");
        $stmt->execute([$utilisateur_id]);
        return $stmt->fetchAll();
    }

    public static function supprimerMessage($id, $pdo)
    {
        $stmt = $pdo->prepare("DELETE FROM message WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>