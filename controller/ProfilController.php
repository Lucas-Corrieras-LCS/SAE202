<?php
require_once 'model/Utilisateur.php';

class ProfilController
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['user_id'])) {
            if (isset($_GET['format']) && $_GET['format'] === 'json') {
                header('Content-Type: application/json');
                echo json_encode(['isConnected' => false]);
                exit;
            }
            header('Location: /connexion.html');
            exit;
        }

        global $pdo;
        $model = new Utilisateur($pdo);
        $utilisateur = $model->getUtilisateur($_SESSION['user_id']);

        if (isset($_GET['format']) && $_GET['format'] === 'json') {
            header('Content-Type: application/json');
            echo json_encode([
                'isConnected' => true,
                'isAdmin' => !empty($_SESSION['is_admin']),
                'profil' => [
                    'nom' => $utilisateur['nom'],
                    'prenom' => $utilisateur['prenom'],
                    'email' => $utilisateur['email'],
                    'age' => $utilisateur['age'],
                    'telephone' => $utilisateur['telephone'],
                ]
            ]);
            exit;
        }

        require 'view/profil.php';
    }

    public function update()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['user_id'])) {
            header('Location: /connexion.html');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = htmlspecialchars(trim($_POST['nom']));
            $prenom = htmlspecialchars(trim($_POST['prenom']));
            $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
            $age = isset($_POST['age']) ? intval($_POST['age']) : null;
            $telephone = htmlspecialchars(trim($_POST['telephone']));

            global $pdo;
            $model = new Utilisateur($pdo);
            $model->updateUtilisateur($_SESSION['user_id'], $nom, $prenom, $email, $age, $telephone);

            header('Location: /profil.html');
            exit;
        }
    }
}

file_put_contents('/tmp/debug_session.txt', print_r($_SESSION, true));
?>