<?php require 'incl/header.php' ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Adicionar Aluno</title>
    <link rel="stylesheet" href="css/adicionar.css">
  </head>
  <body>
    <div class="wrapper">
    <form action="adicionarAluno.php" method="post">
      <label for="nome">Nome Completo</label>
      <input type="text" name="nome" required>

      <label for="id">ID</label>
      <input type="text" name="id" required>

      <label for="dataNasc">Data Nascimento</label>
      <input type="date" name="dataNasc" required>

      <label for="sexo">Sexo</label>
      <select name='sexo' required>
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
      </select>

      <label for="responsavel_1">Nome do Responsável (1)</label>
      <input type="text" name="responsavel_1" required>

      <label for="responsavel_2">Nome do Responsável (2)</label>
      <input type="text" name="responsavel_2" required>

      <label for="serie">Serie</label>
      <select name='serie' required>
        <option value="1anofund">1º Ano Fundamental</option>
        <option value="2anofund">2º Ano Fundamental</option>
        <option value="3anofund">3º Ano Fundamental</option>
        <option value="4anofund">4º Ano Fundamental</option>
        <option value="5anofund">5º Ano Fundamental</option>
        <option value="6anofund">6º Ano Fundamental</option>
        <option value="7anofund">7º Ano Fundamental</option>
        <option value="8anofund">8º Ano Fundamental</option>
        <option value="9anofund">9º Ano Fundamental</option>
        <option value="1anomed">1º Ano Médio</option>
        <option value="2anomed">2º Ano Médio</option>
        <option value="3anomed">3º Ano Médio</option>
      </select>





    </form>
  </div>
  </body>
</html>
