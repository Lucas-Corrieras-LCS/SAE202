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

                    if (
                        !empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
                        (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
                    ) {
                        header('Content-Type: application/json');
                        echo json_encode(['success' => true]);
                        exit;
                    }

                    header('Location: /connexion.html');
                    exit;
                }
            } else {
                $erreur = "Veuillez remplir tous les champs correctement.";
            }

            if (
                !empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
                (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
            ) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => $erreur ?? "Erreur inconnue"]);
                exit;
            }
        }

        require 'view/inscription.php';
    }
}
?>