<?php
  session_start();
  // DB
  header("Content-type: application/json");
  require '../incl/db.php';

  if(!empty($_POST)){
    $data = $_POST;

    if($data['op'] == 'aluno/id'){
      // Retorna um Aluno a partir de seu ID
      $res = $conn->query("SELECT * FROM aluno WHERE id = " . $data['id'])->fetch(PDO::FETCH_ASSOC);
      echo json_encode($res, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else if($data['op'] == 'aluno/nome'){
      // Retorna Alunos a partir de seu nome
      $res = $conn->query("SELECT * FROM aluno WHERE UPPER(nome) LIKE UPPER('%" . $data['nome'] . "%')")->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($res, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else if($data['op'] == 'aluno/adicionar'){
      $dados = $data['dados'];
      $aluno = Aluno::createAluno(
        $data['nome'], $data['id'], $data['dataNasc'],
        $data['sexo'], $data['responsavel_1'],
        $data['responsavel_2'], $data['telefone'],
        $data['endereco'], $data['bolsaFamilia'],
        $data['serie'], $data['turma'], $data['turno'],
        $data['foto'], $data['anoLetivo']
      );
      $aluno->insertIntoDB($conn);
      echo json_encode(['success' => true]);
    }


  } else {
    $res = $conn->query("SELECT * FROM aluno")->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($res, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);


  }
 ?>
