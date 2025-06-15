<?php
require_once __DIR__ . '/../model/UtilisateurAdmin.php';

class UtilisateurController
{
    public function inscription()
    {
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = htmlspecialchars(trim($_POST['nom']));
            $prenom = htmlspecialchars(trim($_POST['prenom']));
            $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
            $mot_de_passe = $_POST['mot_de_passe'];
            $age = intval($_POST['age']);
            $telephone = htmlspecialchars(trim($_POST['telephone']));

            if ($email && !empty($mot_de_passe)) {
                $utilisateur = new Utilisateur($pdo);
                $utilisateur->inscrire($nom, $prenom, $email, $mot_de_passe, $age, $telephone);
                header('Location: /gestion?page=utilisateurs');
                exit;
            }
        }
        $utilisateur = new Utilisateur($pdo);
        $utilisateurs = $utilisateur->getAllUtilisateurs();
        require __DIR__ . '/../view/utilisateurs.php';
    }

    public function connexion()
    {
        global $pdo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
            $mot_de_passe = $_POST['mot_de_passe'];

            if ($email && !empty($mot_de_passe)) {
                $utilisateur = new Utilisateur($pdo);
                $utilisateurConnecte = $utilisateur->connecter($email, $mot_de_passe);
                if ($utilisateurConnecte) {
                    if (session_status() === PHP_SESSION_NONE)
                        session_start();
                    $_SESSION['user_id'] = $utilisateurConnecte['id'];
                    $_SESSION['is_admin'] = $utilisateurConnecte['is_admin'];
                    header('Location: /gestion?page=dashboard');
                    exit;
                } else {
                    $erreur = "Identifiants invalides.";
                }
            } else {
                $erreur = "Veuillez remplir tous les champs.";
            }
        }
        require __DIR__ . '/../view/connexion.php';
    }

    public function gestionUtilisateurs()
    {
        global $pdo;
        $utilisateur = new Utilisateur($pdo);
        $utilisateurs = $utilisateur->getAllUtilisateurs();
        require __DIR__ . '/../view/utilisateurs.php';
    }

    public function modifier($id)
    {
        global $pdo;
        $utilisateur = new Utilisateur($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = htmlspecialchars(trim($_POST['nom']));
            $prenom = htmlspecialchars(trim($_POST['prenom']));
            $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
            $age = intval($_POST['age']);
            $telephone = htmlspecialchars(trim($_POST['telephone']));
            $utilisateur->update($id, $nom, $prenom, $email, $age, $telephone);
            header('Location: /gestion?page=utilisateurs');
            exit;
        }

        $user = $utilisateur->find($id);
        require __DIR__ . '/../view/modifier_utilisateur.php';
    }

    public function supprimer($id)
    {
        global $pdo;
        $pdo->prepare("DELETE FROM commentaire WHERE user_id = ?")->execute([$id]);
        $utilisateur = new Utilisateur($pdo);
        $utilisateur->delete($id);
        header('Location: /gestion?page=utilisateurs');
        exit;
    }
}
?>