<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Commentaires - Back-office</title>
</head>

<body>
    <?php include __DIR__ . '/menu.php'; ?>
    <h1>Gestion des Commentaires</h1>
    <h2>Commentaires à valider :</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Contenu</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commentaires as $commentaire): ?>
                <tr>
                    <td><?= htmlspecialchars($commentaire['id']) ?></td>
                    <td><?= htmlspecialchars($commentaire['contenu']) ?></td>
                    <td><?= htmlspecialchars($commentaire['created_at'] ?? '') ?></td>
                    <td>
                        <a href="/gestion?page=approuver_commentaire&id=<?= $commentaire['id'] ?>">Valider</a>
                        <a href="/gestion?page=refuser_commentaire&id=<?= $commentaire['id'] ?>">Refuser</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Tous les commentaires :</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Contenu</th>
                <th>Date</th>
                <th>Approuvé</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tousCommentaires as $commentaire): ?>
                <tr>
                    <td><?= htmlspecialchars($commentaire['id']) ?></td>
                    <td><?= htmlspecialchars($commentaire['user_id']) ?></td>
                    <td><?= htmlspecialchars($commentaire['contenu']) ?></td>
                    <td><?= htmlspecialchars($commentaire['created_at'] ?? '') ?></td>
                    <td><?= !empty($commentaire['is_approved']) ? 'Oui' : 'Non' ?></td>
                    <td>
                        <a href="/gestion?page=modifier_commentaire&id=<?= $commentaire['id'] ?>">Modifier</a>
                        <a href="/gestion?page=supprimer_commentaire&id=<?= $commentaire['id'] ?>"
                            onclick="return confirm('Supprimer ce commentaire ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>