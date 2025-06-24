<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord - Administration</title>
    <link rel="stylesheet" href="/admin/view/global.css">
</head>

<body>
    <?php include __DIR__ . '/menu.php'; ?>
    <div class="container">
        <h1>Tableau de Bord</h1>
        <p>Bienvenue dans le tableau de bord de l'administration.</p>

        <h2>Statistiques</h2>
        <ul>
            <li>Nombre total d'utilisateurs :
                <?= isset($totalUtilisateurs) ? htmlspecialchars($totalUtilisateurs) : 0 ?>
            </li>
            <li>Nombre total de commentaires :
                <?= isset($totalCommentaires) ? htmlspecialchars($totalCommentaires) : 0 ?>
            </li>
            <li>Commentaires en attente d'approbation :
                <?= isset($commentairesEnAttente) ? htmlspecialchars($commentairesEnAttente) : 0 ?>
            </li>
        </ul>

        <h2>Actions rapides</h2>
        <ul>
            <li><a href="/gestion?page=utilisateurs">Gérer les utilisateurs</a></li>
            <li><a href="/gestion?page=commentaires">Gérer les commentaires</a></li>
        </ul>
    </div>
</body>

</html>