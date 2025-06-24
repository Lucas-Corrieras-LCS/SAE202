<?php
class Utilisateur
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function create($nom, $prenom, $email, $mot_de_passe, $age, $telephone)
  {
    $stmt = $this->pdo->prepare("INSERT INTO user (nom, prenom, email, password, age, telephone) VALUES (?, ?, ?, ?, ?, ?)");
    $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    $stmt->execute([$nom, $prenom, $email, $hashedPassword, $age, $telephone]);
  }

  public function inscrire($nom, $prenom, $email, $mot_de_passe, $age, $telephone)
  {
    $this->create($nom, $prenom, $email, $mot_de_passe, $age, $telephone);
  }

  public function find($id)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  public function update($id, $nom, $prenom, $email, $age, $telephone)
  {
    $stmt = $this->pdo->prepare("UPDATE user SET nom = ?, prenom = ?, email = ?, age = ?, telephone = ? WHERE id = ?");
    $stmt->execute([$nom, $prenom, $email, $age, $telephone, $id]);
  }

  public function delete($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM message WHERE expediteur_id = ?");
    $stmt->execute([$id]);

    $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = ?");
    $stmt->execute([$id]);
  }

  public function authenticate($email, $mot_de_passe)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['password'])) {
      return $utilisateur;
    }
    return false;
  }

  public function connecter($email, $mot_de_passe)
  {
    return $this->authenticate($email, $mot_de_passe);
  }

  public function getAllUtilisateurs()
  {
    $stmt = $this->pdo->query("SELECT * FROM user");
    return $stmt->fetchAll();
  }
}
?>