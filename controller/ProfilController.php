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
            header('Location: /?page=connexion');
            exit;
        }

        global $pdo;
        $model = new Utilisateur($pdo);
        $utilisateur = $model->getUtilisateur($_SESSION['user_id']);

        require 'view/profil.php';
    }

    public function update()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['user_id'])) {
            header('Location: /?page=connexion');
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

            header('Location: /?page=profil');
            exit;
        }
    }
}
?>