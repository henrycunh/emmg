<?php
  require 'incl/header.php';
  require 'incl/classes/aluno.php';
  $series = array(
    "1anofund" => "1º Ano Fundamental",
    "2anofund" => "2º Ano Fundamental",
    "3anofund" => "3º Ano Fundamental",
    "4anofund" => "4º Ano Fundamental",
    "5anofund" => "5º Ano Fundamental",
    "6anofund" => "6º Ano Fundamental",
    "7anofund" => "7º Ano Fundamental",
    "8anofund" => "8º Ano Fundamental",
    "9anofund" => "9º Ano Fundamental",
    "1anomed" => "1º Ano Médio",
    "2anomed" => "2º Ano Médio",
    "3anomed" => "3º Ano Médio"
  );
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/semantic.min.css">
    <link rel="stylesheet" href="css/icon.min.css">
    <title>Pesquisa</title>
  </head>
  <body>
  <?php if(!empty($_GET)){
        $query = $_GET['query'];
        $alunos = Aluno::search($conn, $query);
        if($alunos):?>
  <table class='ui celled selectable table'>
    <thead>
      <tr>
        <th>ID</th>
        <th>Aluno</th>
        <th>Série</th>
        <th>Turma</th>
        <th>Turno</th>
        <th></th>
      </tr>  
    </thead>
    <tbody>
       <?php foreach($alunos as $aluno):?>

        <tr class='inforow' aluno-id='<?= $aluno['id'] ?>'>
          <td class='collapsing'><?= $aluno['id'] ?></td>
          <td><img class='ui avatar image mini' src='<?= $aluno['foto'] ?>'> <?= $aluno['nome'] ?></td>
          <td class='collapsing'><?= $series[$aluno['serie']] ?></td>
          <td class='collapsing'><?= $aluno['turma'] ?></td>
          <td class='collapsing'><?= $aluno['turno'] ?></td>
          <td class='collapsing'><a class='ui button primary' href="verAluno.php?id=<?= $aluno['id'] ?>">Ver Aluno</a></td>
        </tr>

      <?php endforeach; else:?>
        <div class="ui message">Nenhum aluno foi encontrado com os termos dados.</div>
      <?php endif; } ?>
    </tbody>
  </table>

  <div class="ui dimmer" id='aluno-modal'>
    <div class="content">
      <div class="center">
        <div class="ui card" style=' margin: 0 auto;text-align: left'>
          <div class="image">
            <img src="" alt="" id='mFoto'>
          </div>
          <div class="content">
              <span class="header" id='mNome'>Kristy</span>
              <div class="meta">
                <span class="date" id='mDataNasc'>20/20/1111</span>
              </div>
              <div class="description">
                    <b>Sexo</b>: <span id='mSexo'>Masculino</span><div class='ui divider' style='margin: 0.3em'></div>
                    <b>Turma</b>: <span id='mTurma'>A</span><div class='ui divider' style='margin: 0.3em'></div>
                    <b>Telefone</b>: <span id='mTelefone'>7999999999</span><div class='ui divider' style='margin: 0.3em'></div>
                    <b>Turno</b>: <span id='mTurno'>Manhã</span><div class='ui divider' style='margin: 0.3em'></div>
                    <b>Série</b>: <span id='mSerie'>Série</span><div class='ui divider' style='margin: 0.3em'></div>
                    <b>Responsável</b>: <span id='mResponsavel'>José</span>                  
            </div>
          </div>
          <div class="extra content">
          <i class="hashtag icon"></i> <span id="mId">3203</span>
          </div>
        </div>
    </div>
  </div>

  </body>
  <script>
    $(()=>
      {
        // Se uma linha for clicada
        $('.inforow').click(
          e =>
          {
            let id = $(e.target).parent().attr('aluno-id');
            $.ajax(
              {
                url: 'api/aluno.php',
                data: { op: 'aluno/id' , id: id },
                dataType: 'json',
                type: 'POST',
                success: data => 
                {
                  let series = {
                    "1anofund" : "1º Ano Fundamental",
                    "2anofund" : "2º Ano Fundamental",
                    "3anofund" : "3º Ano Fundamental",
                    "4anofund" : "4º Ano Fundamental",
                    "5anofund" : "5º Ano Fundamental",
                    "6anofund" : "6º Ano Fundamental",
                    "7anofund" : "7º Ano Fundamental",
                    "8anofund" : "8º Ano Fundamental",
                    "9anofund" : "9º Ano Fundamental",
                    "1anomed" : "1º Ano Médio",
                    "2anomed" : "2º Ano Médio",
                    "3anomed" : "3º Ano Médio"
                  };
                  $("#mFoto").attr('src', data.foto);
                  $("#mNome").text(data.nome);
                  let tDate = new Date();
                  let date = new Date(data.dataNasc);
                  let diff = new Date(Math.abs(date - tDate));
                  console.log(diff);
                  $("#mDataNasc").html(date.toLocaleDateString() + ` <i>(${diff.getUTCFullYear() - 1970} anos)</i>`);
                  $("#mId").text(data.id);
                  $("#mSexo").text(data.sexo == "M" ? "Masculino" : "Feminino");
                  $("#mTurma").text(data.turma);
                  $("#mTelefone").text(data.telefone);
                  $("#mTurno").text(data.turno);
                  $("#mSerie").text(series[data.serie]);
                  $("#mResponsavel").text(data.responsavel_1);

                  $("#aluno-modal").dimmer('show');
                },
                error: (s, e, x) =>
                {
                  console.log(s);
                  console.log(e);
                  console.log(x);
                }
              }
            );

          }
        );
      }
    )
  </script>
</html>
