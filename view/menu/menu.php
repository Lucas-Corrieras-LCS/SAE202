<nav>
  <ul>
    <li><a href="/sae202/">Accueil</a></li>
    <li><a href="/sae202/?page=concept">Concept</a></li>
    <li><a href="/sae202/?page=infos">Infos pratiques</a></li>
    <?php if (session_status() === PHP_SESSION_NONE)
      session_start(); ?>
    <?php if (isset($_SESSION['user_id'])): ?>
      <li><a href="/sae202/?page=messagerie">Messagerie interne</a></li>
      <li><a href="/sae202/?page=profil">Mon profil</a></li>
      <?php if (!empty($_SESSION['is_admin'])): ?>
        <a href="/sae202/gestion?page=dashboard">Admin</a>
      <?php endif; ?>
      <li><a href="/sae202/?page=deconnexion">Déconnexion</a></li>
    <?php else: ?>
      <li><a href="/sae202/?page=inscription">Inscription</a></li>
      <li><a href="/sae202/?page=connexion">Connexion</a></li>
    <?php endif; ?>
    <li><a href="/sae202/?page=mentions-legales">Mentions légales</a></li>
  </ul>
</nav>