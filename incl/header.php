<?php
  session_start();
  require 'incl/db.php';
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/header.css">
  </head>
  <body>
    <nav>
      <a href="#">Pesquisa Avançada</a>
      <a href="adicionarAluno.php">Adicionar Aluno</a>
      <div class='search'>
        <input type="text" placeholder='Pesquisar Aluno' id='search'>
      </a>
    </nav>
  </body>
</html>
