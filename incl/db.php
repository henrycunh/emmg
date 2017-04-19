<?php
  $user = 'root';
  $pw = '2811';
  $host = 'localhost';
  $db = 'emmg';

  try {
    $conn = new PDO("mysql:host=$host;dbname=$db;", $user, $pw, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  } catch (Exception $e) {
    die("Erro:" . $e->getMessage());
  }





 ?>
