<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Profil - SAE202</title>
</head>

<body>
    <?php include 'view/menu/menu.php'; ?>
    <h1>Mon Profil</h1>
    <form method="POST" action="/?page=profil&action=update">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($utilisateur['nom']) ?>" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($utilisateur['prenom']) ?>" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($utilisateur['email']) ?>" required>

        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($utilisateur['telephone']) ?>">

        <label for="age">Âge :</label>
        <input type="number" id="age" name="age" value="<?= htmlspecialchars($utilisateur['age']) ?>" required>

        <input type="submit" value="Mettre à jour">
    </form>
</body>

</html>