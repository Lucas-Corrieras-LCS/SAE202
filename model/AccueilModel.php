<?php
class AccueilModel
{
    public function getAccueil()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM commentaire WHERE approuve = 1 ORDER BY date DESC LIMIT 5");
        return $stmt->fetchAll();
    }
}
?>