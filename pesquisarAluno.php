<?php
  require 'incl/header.php';
  require 'incl/classes/aluno.php';
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Pesquisar Aluno</title>
  </head>
  <body>
  <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Série</th>
        <th>Turma</th>
        <th>Turno</th>
      </tr>

    <?php if(!empty($_GET)){
      $nome = $_GET['nome'];
      $alunos = Aluno::getByName($conn, $nome);
      foreach($alunos as $aluno):?>

      <tr>
        <td><?= $aluno['id'] ?></td>
        <td><?= $aluno['nome'] ?></td>
        <td><?= $aluno['serie'] ?></td>
        <td><?= $aluno['turma'] ?></td>
        <td><?= $aluno['turno'] ?></td>
        <td><a href="verAluno.php?id=<?= $aluno['id'] ?>">Ver Aluno</a></td>
      </tr>

    <?php endforeach; } ?>

  </table>



  </body>
</html>
