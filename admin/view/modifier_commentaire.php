<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Modifier un commentaire</title>
</head>

<body>
  <?php include __DIR__ . '/menu.php'; ?>
  <h1>Modifier le commentaire</h1>
  <form method="post">
    <label for="contenu">Contenu :</label><br>
    <textarea id="contenu" name="contenu" rows="5" cols="60"
      required><?= htmlspecialchars($commentaire['contenu']) ?></textarea><br><br>
    <label>
      <input type="checkbox" name="approuve" value="1" <?= $commentaire['approuve'] ? 'checked' : '' ?>>
      Approuvé
    </label><br><br>
    <button type="submit">Enregistrer</button>
    <a href="/sae202/admin/routeur.php?page=commentaires">Annuler</a>
  </form>
</body>

</html>