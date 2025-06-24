<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Modifier un utilisateur</title>
  <link rel="stylesheet" href="/admin/view/global.css">
</head>

<body>
  <?php include __DIR__ . '/menu.php'; ?>
  <h1>Modifier un utilisateur</h1>
  <form method="post">
    <label>Nom : <input type="text" name="nom" value="<?= htmlspecialchars($user['nom'] ?? '') ?>"></label><br>
    <label>Prénom : <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom'] ?? '') ?>"></label><br>
    <label>Email : <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>"></label><br>
    <label>Âge : <input type="number" name="age" value="<?= htmlspecialchars($user['age'] ?? '') ?>"></label><br>
    <label>Téléphone : <input type="text" name="telephone"
        value="<?= htmlspecialchars($user['telephone'] ?? '') ?>"></label><br>
    <button type="submit">Enregistrer</button>
  </form>
  <a href="/gestion?page=utilisateurs">Retour à la liste</a>
</body>

</html>