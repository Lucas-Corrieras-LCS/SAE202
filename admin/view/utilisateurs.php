<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des Utilisateurs - Back-office</title>
</head>

<body>
    <?php include __DIR__ . '/menu.php'; ?>
    <h1>Liste des Utilisateurs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Âge</th>
                <th>Téléphone</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?= htmlspecialchars($utilisateur['id']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['nom']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['prenom']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['email']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['age']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['telephone']) ?></td>
                    <td><?= $utilisateur['is_admin'] ? 'Administrateur' : 'Utilisateur' ?></td>
                    <td>
                        <a href="/gestion?page=modifier_utilisateur&id=<?= $utilisateur['id'] ?>">Modifier</a>
                        <a href="/gestion?page=supprimer_utilisateur&id=<?= $utilisateur['id'] ?>"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>