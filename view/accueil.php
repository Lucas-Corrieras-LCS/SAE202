<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil - SAE202</title>
</head>

<body>
    <?php include 'view/menu/menu.php'; ?>
    <h1>Bienvenue sur l'événement SAE202</h1>
    <h2>Commentaires approuvés :</h2>
    <ul>
        <?php if (session_status() === PHP_SESSION_NONE)
            session_start(); ?>

        <?php if (isset($_SESSION['user_id'])): ?>
            <h2>Ajouter un commentaire</h2>
            <form method="post" action="">
                <textarea name="contenu" required placeholder="Votre commentaire"></textarea><br>
                <button type="submit">Envoyer</button>
            </form>
        <?php else: ?>
            <p>
                <a href="/?page=connexion">Connectez-vous</a> pour ajouter un commentaire.
            </p>
        <?php endif; ?>
        <?php foreach ($donnees as $commentaire): ?>
            <li><?= htmlspecialchars($commentaire['contenu']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>