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

    if (
      !empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
      (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
    ) {
      header('Content-Type: application/json');
      echo json_encode(['success' => true]);
      exit;
    }

    header('Location: /connexion.html');
    exit;
  }
}
?>