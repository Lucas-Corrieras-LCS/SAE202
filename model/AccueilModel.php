<?php
class AccueilModel
{
    public function getAccueil()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM commentaire WHERE is_approved = 1 ORDER BY created_at DESC LIMIT 5");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>