<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Modifier un commentaire</title>
  <link rel="stylesheet" href="/admin/view/global.css">
</head>

<body>
  <?php include __DIR__ . '/menu.php'; ?>
  <h1>Modifier le commentaire</h1>
  <form method="post">
    <label for="contenu">Contenu :</label><br>
    <textarea id="contenu" name="contenu" rows="5" cols="60"
      required><?= htmlspecialchars($commentaire['contenu']) ?></textarea><br><br>
    <label>
      <input type="checkbox" name="is_approved" <?= !empty($commentaire['is_approved']) ? 'checked' : '' ?>> Approuvé
    </label><br><br>
    <button type="submit">Enregistrer</button>
    <a href="/gestion?page=commentaires">Annuler</a>
  </form>
</body>

</html>