<nav>
  <ul>
    <li><a href="/">Accueil</a></li>
    <li><a href="/?page=concept">Concept</a></li>
    <li><a href="/?page=infos">Infos pratiques</a></li>
    <?php if (session_status() === PHP_SESSION_NONE)
      session_start(); ?>
    <?php if (isset($_SESSION['user_id'])): ?>
      <li><a href="/?page=messagerie">Messagerie interne</a></li>
      <li><a href="/?page=profil">Mon profil</a></li>
      <?php if (!empty($_SESSION['is_admin'])): ?>
        <a href="/gestion?page=dashboard">Admin</a>
      <?php endif; ?>
      <li><a href="/?page=deconnexion">Déconnexion</a></li>
    <?php else: ?>
      <li><a href="/?page=inscription">Inscription</a></li>
      <li><a href="/?page=connexion">Connexion</a></li>
    <?php endif; ?>
    <li><a href="/?page=mentions-legales">Mentions légales</a></li>
  </ul>
</nav>