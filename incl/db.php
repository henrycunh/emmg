<?php
  $user = 'root';
  $pw = '2811';
  $host = 'localhost';
  $db = 'emmg';

  try {
    $conn = new PDO("mysql:host=$host;dbname=$db;", $user, $pw);
  } catch (Exception $e) {
    die("Erro:" . $e->getMessage());
  }





 ?>
