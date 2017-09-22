<?php
  require 'incl/header.php';
  require 'incl/classes/aluno.php';
  $get = !empty($_GET);
  $aluno = '';
  if($get){
    $aluno = Aluno::getById($conn, $_GET['id']);
  } else {
    die("Página não encontrada.");
  }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ver Aluno / <?= $aluno['nome'] ?></title>
    <link rel="stylesheet" href="css/semantic.min.css">
    <link rel="stylesheet" href="css/icon.min.css">
  </head>
  <body>
  <div class="ui segment" style='width: 70%; margin: 0 auto'>
  <div class="ui form">
    <h4 class="ui dividing header">
      Informações do Aluno
    </h4>
    <form action="updateAluno.php" enctype='multipart/form-data' method="post" novalidate>

      <div class="field">
        <div class="three fields">
          <div class="field">
            <label for="nome">Nome Completo</label>
            <input type="text" name="nome" value='<?= $aluno['nome'] ?>' required>
          </div>
          <div class="disabled field">
            <label for="id">Identificação <i>(ID)</i></label>
            <input type="text" name="id" value='<?= $aluno['id'] ?>' required>
          </div>
          <div class="field">
            <label for="dataNasc">Data Nascimento</label>
            <input type="date" name="dataNasc" value='<?= $aluno['dataNasc'] ?>' required>
          </div>
        </div>
      </div>

      <div class="field">
        <div class="three fields">
          <div class="field">
            <label for="sexo">Sexo</label>
            <select name='sexo' value='<?= $aluno['sexo'] ?>' class='ui dropdown' required>
              <option value="M">Masculino</option>
              <option value="F">Feminino</option>
            </select>
          </div>
          <div class="field">
            <label for="turma">Turma</label>
            <input type="text" value='<?= $aluno['turma'] ?>' name="turma" required>            
          </div>
          <div class="field">
            <label for="serie">Serie</label>
            <select name='serie' value='<?= $aluno['serie'] ?>' class='ui dropdown' required>
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
          </div>
        </div>
      </div>

      <div class="field">
        <div class="four fields">
          <div class="field">
            <label for="turno">Turno</label>
            <select name='turno' value='<?= $aluno['turno'] ?>' class='ui dropdown' required>
              <option value="Manhã">Matutino</option>
              <option value="Tarde">Vespertino</option>
            </select>
          </div>
          <div class="field">
            <label for="anoLetivo">Ano Letivo</label>
            <input type="text" value='<?= $aluno['anoLetivo'] ?>' name="anoLetivo" required>
          </div>

          <div class="field">
            <label for="bolsaFamilia">Bolsa Familia</label>
            <select name='bolsaFamilia' class='ui dropdown' selected='<?= $aluno['bolsaFamilia'] ?>' required>
              <option value="on">Sim</option>
              <option value="off">Não</option>
            </select>
          </div>
          <div class="field">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" value='<?= $aluno['telefone'] ?>' required>
          </div>
        </div>
      </div>

      <div class="field">
        <div class="two fields">
          <div class="field">
            <label for="responsavel_1">Nome do Responsável (1)</label>
            <input type="text" name="responsavel_1" value='<?= $aluno['responsavel_1'] ?>' required>            
          </div>
          <div class="field">
            <label for="responsavel_2">Nome do Responsável (2)</label>
            <input type="text" name="responsavel_2" value='<?= $aluno['responsavel_2'] ?>' required>            
          </div>
        </div>
      </div>

      <div class="field">
        <label for="endereco">Endereco</label>
        <textarea name='endereco' required><?= $aluno['endereco'] ?></textarea>
      </div>

      <div class="field">
        <b style='display:block; margin-bottom: 0.5em'>Foto</b>
        <label for="foto" class='ui button primary' style='color: #fff; display: inline-block'>
          <i class="upload icon"></i>
          Selecionar Foto
        </label>
        <input type="file" style='display: none;' id='foto' name="foto" accept='image/*' required>
        <center>
          <img src="<?= $aluno['foto'] ?>" id='preview' class='ui image circular' width='10%'>        
        </center>
      </div>

      <input type="submit" class='ui button primary fluid' value="Salvar Mudanças">
    </form>
    <div class="ui divider"></div>
    <form action="updateAluno.php?delete=true" method='post'>
      <input type="hidden" name='id' value='<?= $aluno['id'] ?>'> 
      <input type="submit" class='ui button negative fluid' value="Remover Aluno">
    </form>
  </div>
</div>
  </body>
  <script type="text/javascript">
  $(()=>{
    $(".ui.dropdown").dropdown();
    $(".ui.segment").addClass("loading");
    $('select[name="sexo"]').dropdown('set selected', '<?= $aluno['sexo'] ?>');
    $('select[name="serie"]').dropdown('set selected', "<?= $aluno['serie'] ?>");
    $('select[name="turno"]').dropdown('set selected', "<?= $aluno['turno'] ?>");
    $('select[name="bolsaFamilia"]').dropdown('set selected', "<?= $aluno['bolsaFamilia'] ?>");
    $(".ui.segment").removeClass("loading");
  })
    function preview(input){
      input = input[0]
      console.log(input.files)
      if(input.files && input.files[0]){
        var reader = new FileReader()

        reader.onload = e => {
          $("#preview").attr('src', e.target.result)
        }

        reader.readAsDataURL(input.files[0])
      }
    }

    $("#foto").change(()=>{
      preview($("#foto"))
    })
  </script>
</html>
