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
      <a href="index.php">Ver Todos os Alunos</a>
      <a href="#">Pesquisa Avançada</a>
      <a href="adicionarAluno.php">Adicionar Aluno</a>
      <div class='search'>
        <form action="pesquisarAluno.php" method="ged">
          <input type="text" placeholder='Pesquisar Aluno' name='nome' id='search'>
        </form>
      </a>
    </nav>
  </body>
</html>
