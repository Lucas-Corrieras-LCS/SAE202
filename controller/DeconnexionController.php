<?php
class DeconnexionController
{
  public function index()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    session_unset();
    session_destroy();
    header('Location: /?page=connexion');
    exit;
  }
}
?>