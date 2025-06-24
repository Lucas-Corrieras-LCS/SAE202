<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Proposer un Commentaire - SAE202</title>
</head>

<body>
    <?php include 'view/menu/menu.php'; ?>
    <h1>Proposer un Commentaire</h1>
    <form action="/?page=commentaire/proposer" method="post">
        <label for="contenu">Votre commentaire :</label><br>
        <textarea id="contenu" name="contenu" required></textarea><br>
        <input type="submit" value="Soumettre">
    </form>
</body>

</html>