<?php
  $index = 2;
  require 'incl/header.php';
  require 'incl/classes/aluno.php';
  if(!empty($_POST)){
    $dados = $_POST;
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $filename = 'fotos/' . $dados['id'] . ".$ext";
    $aluno = Aluno::createAluno(
      $dados['id'],
      $dados['nome'],
      $dados['dataNasc'],
      $dados['sexo'],
      $dados['responsavel_1'],
      $dados['responsavel_2'],
      $dados['telefone'],
      $dados['endereco'],
      ($dados['bolsaFamilia'] === 'on' ? 1 : 0),
      $dados['serie'],
      $dados['turma'],
      $dados['turno'],
      $filename,
      $dados['anoLetivo']
    );
    $query = $aluno->insertIntoDB($conn);
    if(file_exists($filename)) {
      chmod($filename,0755);
      unlink($filename);
    }
    move_uploaded_file($_FILES['foto']['tmp_name'], $filename);
    if($query['success']) {
      echo '<div class="ui message success" style="width: 70%; margin: 0.5em auto">Aluno cadastrado com sucesso.</div>';
    } else {
      echo '<div class="ui message error" style="width: 70%; margin: 0.5em auto">Erro ao cadastrar aluno.<br>' . $query['message'] . '</div>';
    }

  }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Adicionar Aluno</title>
    <link rel="stylesheet" href="css/semantic.min.css">
    <link rel="stylesheet" href="css/icon.min.css">
  </head>
  <body>
  <div class="ui segment" style='width: 70%; margin: 0 auto'>
    <div class="ui form">
      <h4 class="ui dividing header">
        Informações do Aluno
      </h4>
      <form action="adicionarAluno.php" enctype='multipart/form-data' method="post">

        <div class="field">
          <div class="three fields">
            <div class="field">
              <label for="nome">Nome Completo</label>
              <input type="text" name="nome" required>
            </div>
            <div class="field">
              <label for="id">Identificação <i>(ID)</i></label>
              <input type="text" name="id" required>
            </div>
            <div class="field">
              <label for="dataNasc">Data Nascimento</label>
              <input type="date" name="dataNasc" required>
            </div>
          </div>
        </div>

        <div class="field">
          <div class="three fields">
            <div class="field">
              <label for="sexo">Sexo</label>
              <select name='sexo' class='ui dropdown' required>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
              </select>
            </div>
            <div class="field">
              <label for="turma">Turma</label>
              <input type="text" name="turma" required>            
            </div>
            <div class="field">
              <label for="serie">Serie</label>
              <select name='serie' class='ui dropdown' required>
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
              <select name='turno' class='ui dropdown' required>
                <option value="Manhã">Matutino</option>
                <option value="Tarde">Vespertino</option>
              </select>
            </div>
            <div class="field">
              <label for="anoLetivo">Ano Letivo</label>
              <input type="text" name="anoLetivo" required>
            </div>

            <div class="field">
              <label for="bolsaFamilia">Bolsa Familia</label>
              <select name='bolsaFamilia' class='ui dropdown' required>
                <option value="on">Sim</option>
                <option value="off">Não</option>
              </select>
            </div>
            <div class="field">
              <label for="telefone">Telefone</label>
              <input type="text" name="telefone" required>
            </div>
          </div>
        </div>

        <div class="field">
          <div class="two fields">
            <div class="field">
              <label for="responsavel_1">Nome do Responsável (1)</label>
              <input type="text" name="responsavel_1" required>            
            </div>
            <div class="field">
              <label for="responsavel_2">Nome do Responsável (2)</label>
              <input type="text" name="responsavel_2" required>            
            </div>
          </div>
        </div>

        <div class="field">
          <label for="endereco">Endereco</label>
          <textarea name='endereco' required></textarea>
        </div>

        <div class="field">
          <b style='display:block; margin-bottom: 0.5em'>Foto</b>
          <label for="foto" class='ui button primary' style='color: #fff; display: inline-block'>
            <i class="upload icon"></i>
            Selecionar Foto
          </label>
          <input type="file" style='display: none;' id='foto' name="foto" accept='image/*' required>
          <center>
            <img src="#" id='preview' class='ui image circular' width='10%'>        
          </center>
        </div>

        <input type="submit" class='ui button huge positive fluid' value="Adicionar Aluno">

    </form>
    </div>
  </div>
   
  </body>
  <script type="text/javascript">
    $(()=>{
      $(".ui.dropdown").dropdown();
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
      $("#preview").fadeIn(300)
      preview($("#foto"))
    })
  </script>
</html>
