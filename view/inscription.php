<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription - SAE202</title>
</head>

<body>
    <?php include 'view/menu/menu.php'; ?>
    <h1>Inscription</h1>
    <?php if (isset($erreur)): ?>
        <p style="color:red"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>
    <form action="/?page=inscription" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>

        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone">

        <label for="age">Âge :</label>
        <input type="number" id="age" name="age" min="1" max="120">

        <button type="submit">S'inscrire</button>
    </form>
</body>

</html>