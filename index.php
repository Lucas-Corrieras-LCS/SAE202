<?php
if (preg_match('#^/agence($|/)#', $_SERVER['REQUEST_URI'])) {
  return;
}

if (isset($_SERVER['HTTP_ORIGIN']) && preg_match('#^https?://localhost(:[0-9]+)?$#', $_SERVER['HTTP_ORIGIN'])) {
  header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Allow-Headers: Content-Type, Accept');
  header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
  }
}
require_once __DIR__ . '/conf/routeur.php';