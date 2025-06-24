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
                <label for="note">Note :</label>
                <select name="note" id="note" required>
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★☆</option>
                    <option value="3">★★★☆☆</option>
                    <option value="2">★★☆☆☆</option>
                    <option value="1">★☆☆☆☆</option>
                </select><br>
                <button type="submit">Envoyer</button>
            </form>
        <?php else: ?>
            <p>
                <a href="/?page=connexion">Connectez-vous</a> pour ajouter un commentaire.
            </p>
        <?php endif; ?>
        <?php foreach ($donnees as $commentaire): ?>
            <li>
                <strong><?= htmlspecialchars($commentaire['prenom']) ?>
                    <?= htmlspecialchars($commentaire['nom']) ?></strong>
                : <?= htmlspecialchars($commentaire['contenu']) ?>
                <span style="color:gold;">
                    <?php
                    $stars = intval($commentaire['note']);
                    echo str_repeat('★', $stars) . str_repeat('☆', 5 - $stars);
                    ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>