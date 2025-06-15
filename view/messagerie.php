<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Messagerie - SAE202</title>
</head>

<body>
    <?php include 'view/menu/menu.php'; ?>
    <h1>Messagerie interne</h1>
    <h2>Messages</h2>
    <ul>
        <?php foreach ($messages as $message): ?>
            <li>
                <strong>
                    <?= htmlspecialchars($message['expediteur_prenom'] . ' ' . $message['expediteur_nom']) ?>
                    (<?= htmlspecialchars($message['expediteur_email']) ?>)
                    :</strong>
                <?= htmlspecialchars($message['contenu']) ?>
                <em>(<?= htmlspecialchars($message['created_at']) ?>)</em>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Envoyer un message</h2>
    <form action="/?page=messagerie" method="post">
        <label for="destinataire_id">Destinataire :</label>
        <select id="destinataire_id" name="destinataire_id" required>
            <option value="">-- Choisir un admin --</option>
            <?php foreach ($admins as $admin): ?>
                <option value="<?= $admin['id'] ?>">
                    <?= htmlspecialchars($admin['prenom'] . ' ' . $admin['nom'] . ' (' . $admin['email'] . ')') ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="contenu">Message :</label>
        <textarea id="contenu" name="contenu" required></textarea>

        <button type="submit">Envoyer</button>

</html>
</body>

</html>