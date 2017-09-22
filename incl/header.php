<?php
  session_start();
  require 'incl/db.php';
  global $index;
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <style>
      kbd{
        display:inline-block;
        border-radius: 2px;
        border: 1px solid #ccc;
        background: #eee;
        padding: 0.1em 0.3em;
      }
    </style>
  </head>
  <body style='padding: 1em'>
    <div class="ui menu">
      <a href="index.php" class="<?= $index == 1 ? 'active' : '' ?> item">
        Todos os Alunos
      </a>
      <a href="adicionarAluno.php" class="<?= $index == 2 ? 'active' : '' ?> item">
        Adicionar Aluno
      </a>
      <div class="right menu">
        <div class="item">
          <form action="pesquisa.php" method="get">
              <div class="ui icon transparent input">
                <input type="text" placeholder='Pesquisar Aluno' name='query' id='search'>
                <i class="search link icon"></i>
              </div>
          </form>
        </div>
        <div class="item">
          <button class='ui icon button circular basic' id='info'>
              <i class="info icon"></i>
          </button>
          <div class="ui modal" id='modal'>
          <div class="ui segment basic">
          
            A pesquisa de alunos se dá de uma forma bastante direcionada, veja abaixo como efetua-la:<br>
            <table class="ui celled table">
              <thead>
                <tr>
                <th>Informação</th>
                <th>Método</th>
                <th>Exemplo</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Nome</td>
                  <td>Buscar o termo</td>
                  <td><kbd>Joãozinho</kbd></td>
                </tr>
                <tr>
                  <td>ID</td>
                  <td>Buscar o termo</td>
                  <td><kbd>4654</kbd></td>
                </tr>
                <tr>
                  <td>Telefone</td>
                  <td>Buscar o termo</td>
                  <td><kbd>79999664455</kbd></td>
                </tr>
                <tr>
                  <td>Nome dos Responsáveis</td>
                  <td>Buscar o termo</td>
                  <td><kbd>Maria Silva</kbd></td>
                </tr>
                <tr>
                  <td>Endereço</td>
                  <td>Buscar o termo</td>
                  <td><kbd>Rua L9</kbd></td>
                </tr>
                <tr>
                  <td>Série</td>
                  <td>Digitar <kbd>serie=</kbd> seguido do número do ano, a palavra "ano" e da palavra "fund" para o ensino fundamental, e "med" para o ensino médio. </td>
                  <td><kbd>serie=4anofund</kbd> irá mostrar todos os alunos do 4° ano do ensino fundamental</td>
                </tr>
                <tr>
                  <td>Sexo</td>
                  <td>Digitar <kbd>sexo=</kbd> seguido de "m" para masculino, e "f" para feminino. </td>
                  <td><kbd>sexo=f</kbd> irá mostrar todas as alunas de sexo feminino.</td>
                </tr>
                <tr>
                  <td>Ano Letivo</td>
                  <td>Digitar <kbd>ano=</kbd> seguido do ano letivo. </td>
                  <td><kbd>ano=2014</kbd> irá mostrar todos os alunos do ano letivo de 2014.</td>
                </tr>
                <tr>
                  <td>Bolsa Família</td>
                  <td>Digitar <kbd>bolsa=</kbd> seguido sim ou não. </td>
                  <td><kbd>bolsa=não</kbd> irá mostrar todos os alunos que não possuem bolsa família.</td>
                </tr>
                <tr>
                  <td>Turma</td>
                  <td>Digitar <kbd>turma=</kbd> seguido da turma. </td>
                  <td><kbd>turma=A</kbd> irá mostrar todos os alunos da turma A.</td>
                </tr>
                <tr>
                  <td>Turno</td>
                  <td>Digitar <kbd>turno=</kbd> seguido do turno (Manhã ou Tarde). </td>
                  <td><kbd>turno=manhã</kbd> irá mostrar todos os alunos da manhã.</td>
                </tr>
              </tbody>
            </table>
            Você também pode pesquisar por vários termos ao mesmo tempo, incluindo uma virgula após cada termo.
            <br>Por exemplo: <kbd>turma=A,bolsa=não,ano=2011</kbd>.

          </div>
          </div>
        </div>
      </div>
    </div>
    
  </body>
  <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
  <script src="js/semantic.min.js"></script>
  <script>
    $(()=>{
      $('#info').click(()=>{
        $("#modal").modal('show');
      })
    })
  </script>
</html>
