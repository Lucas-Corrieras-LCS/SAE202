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
                header('Location: /gestion/utilisateurs.html');
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
                    header('Location: /gestion.html');
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

            if (
                isset($_SERVER['HTTP_ACCEPT']) &&
                strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false
            ) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
                exit;
            }

            header('Location: /gestion?page=utilisateurs');
            exit;
        }

        $user = $utilisateur->find($id);
        require __DIR__ . '/../view/modifier_utilisateur.php';
    }

    public function supprimer($id)
    {
        global $pdo;
        $pdo->prepare("DELETE FROM message WHERE destinataire_id = ? OR expediteur_id = ?")->execute([$id, $id]);

        $stmt = $pdo->prepare("DELETE FROM user WHERE id = ?");
        $success = $stmt->execute([$id]);

        if (
            isset($_SERVER['HTTP_ACCEPT']) &&
            strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false
        ) {
            header('Content-Type: application/json');
            echo json_encode(['success' => $success]);
            exit;
        }

        header('Location: /gestion?page=utilisateurs');
        exit;
    }

    public function json()
    {
        global $pdo;
        header('Content-Type: application/json');
        $stmt = $pdo->query("SELECT * FROM user");
        $utilisateurs = $stmt->fetchAll();
        echo json_encode(['utilisateurs' => $utilisateurs]);
        exit;
    }

    public function jsonById($id)
    {
        global $pdo;
        header('Content-Type: application/json');
        $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        echo json_encode(['utilisateur' => $user]);
        exit;
    }
}
?>