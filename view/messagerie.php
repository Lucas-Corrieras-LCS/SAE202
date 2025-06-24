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
                <form action="/?page=messagerie" method="post" style="display:inline;">
                    <input type="hidden" name="destinataire_id" value="<?= $message['expediteur_id'] ?>">
                    <button type="submit">Répondre</button>
                </form>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <a href="/?page=supprimer_message&id=<?= $message['id'] ?>"
                        onclick="return confirm('Supprimer ce message ?');" style="color:red; margin-left:10px;">Supprimer</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Envoyer un message</h2>
    <form action="/?page=messagerie" method="post">
        <label for="destinataire_id">Destinataire :</label>
        <select id="destinataire_id" name="destinataire_id" required>
            <option value="">-- Choisir un destinataire --</option>
            <optgroup label="Admins">
                <?php foreach ($admins as $admin): ?>
                    <option value="<?= $admin['id'] ?>" <?php if (isset($_POST['destinataire_id']) && $_POST['destinataire_id'] == $admin['id']) echo 'selected'; ?>>
                        <?= htmlspecialchars($admin['prenom'] . ' ' . $admin['nom'] . ' (' . $admin['email'] . ')') ?>
                    </option>
                <?php endforeach; ?>
            </optgroup>
            <?php if (isset($utilisateurs) && count($utilisateurs) > 0): ?>
                <optgroup label="Utilisateurs">
                    <?php foreach ($utilisateurs as $user): ?>
                        <option value="<?= $user['id'] ?>" <?php if (isset($_POST['destinataire_id']) && $_POST['destinataire_id'] == $user['id']) echo 'selected'; ?>>
                            <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom'] . ' (' . $user['email'] . ')') ?>
                        </option>
                    <?php endforeach; ?>
                </optgroup>
            <?php endif; ?>
        </select>

        <label for="contenu">Message :</label>
        <textarea id="contenu" name="contenu" required></textarea>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>