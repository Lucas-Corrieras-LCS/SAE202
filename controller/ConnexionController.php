<?php
require_once 'model/Utilisateur.php';

class ConnexionController
{
    public function index()
    {
        global $pdo;
        $utilisateurModel = new Utilisateur($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];

            if ($email && $mot_de_passe) {
                $utilisateur = $utilisateurModel->getUtilisateurByEmail($email);

                if ($utilisateur && password_verify($mot_de_passe, $utilisateur['password'])) {
                    $_SESSION['user_id'] = $utilisateur['id'];
                    $_SESSION['is_admin'] = $utilisateur['is_admin'] ?? 0;
                    header('Location: /');
                    exit;
                } else {
                    $erreur = "Email ou mot de passe incorrect.";
                }
            } else {
                $erreur = "Veuillez remplir tous les champs.";
            }
        }

        require 'view/connexion.php';
    }
}
?>