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

                    if (
                        !empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
                        (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
                    ) {
                        header('Content-Type: application/json');
                        echo json_encode([
                            'success' => true,
                            'isConnected' => true,
                            'isAdmin' => !empty($utilisateur['is_admin'])
                        ]);
                        exit;
                    }

                    header('Location: /index.html');
                    exit;
                } else {
                    $erreur = "Email ou mot de passe incorrect.";
                }
            } else {
                $erreur = "Veuillez remplir tous les champs.";
            }

            if (
                !empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
                (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
            ) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'error' => $erreur ?? "Erreur inconnue"
                ]);
                exit;
            }
        }

        require 'view/connexion.php';
    }
}
?>