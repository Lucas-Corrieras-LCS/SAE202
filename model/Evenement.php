<?php
class Evenement
{
    private $id;
    private $nom;
    private $date_debut;
    private $date_fin;
    private $lieu;
    private $description;

    public function __construct($id, $nom, $date_debut, $date_fin, $lieu, $description)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->lieu = $lieu;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getDateDebut()
    {
        return $this->date_debut;
    }

    public function getDateFin()
    {
        return $this->date_fin;
    }

    public function getLieu()
    {
        return $this->lieu;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setDateDebut($date_debut)
    {
        $this->date_debut = $date_debut;
    }

    public function setDateFin($date_fin)
    {
        $this->date_fin = $date_fin;
    }

    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
?>