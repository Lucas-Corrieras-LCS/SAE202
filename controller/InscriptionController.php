<?php
require_once 'model/Utilisateur.php';

class InscriptionController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = htmlspecialchars(trim($_POST['nom']));
            $prenom = htmlspecialchars(trim($_POST['prenom']));
            $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
            $mot_de_passe = $_POST['mot_de_passe'];
            $age = intval($_POST['age']);
            $telephone = htmlspecialchars(trim($_POST['telephone']));

            if ($email && !empty($mot_de_passe)) {
                global $pdo;
                $utilisateur = new Utilisateur($pdo);
                if ($utilisateur->getUtilisateurByEmail($email)) {
                    $erreur = "Cet email est déjà utilisé.";
                } else {
                    $utilisateur->inscrire($nom, $prenom, $email, $mot_de_passe, $age, $telephone);
                    header('Location: /?page=connexion');
                    exit;
                }
            } else {
                $erreur = "Veuillez remplir tous les champs correctement.";
            }
        }

        require 'view/inscription.php';
    }
}
?>