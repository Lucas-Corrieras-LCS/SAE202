<?php
class Utilisateur
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function inscrire($nom, $prenom, $email, $mot_de_passe, $age, $telephone)
    {
        $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO user (nom, prenom, email, password, age, telephone) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nom, $prenom, $email, $hashedPassword, $age, $telephone]);
    }

    public function connecter($email, $mot_de_passe)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $utilisateur = $stmt->fetch();

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['password'])) {
            return $utilisateur;
        }
        return false;
    }

    public function getUtilisateur($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateUtilisateur($id, $nom, $prenom, $email, $age, $telephone)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET nom = ?, prenom = ?, email = ?, age = ?, telephone = ? WHERE id = ?");
        return $stmt->execute([$nom, $prenom, $email, $age, $telephone, $id]);
    }

    public function deleteUtilisateur($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAllUtilisateurs()
    {
        $stmt = $this->pdo->query("SELECT * FROM user");
        return $stmt->fetchAll();
    }
    public function getUtilisateurByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
?>