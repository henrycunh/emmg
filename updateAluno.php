<?php 
    $index = 1;
    require 'incl/header.php'; 
    require 'incl/classes/aluno.php'; 
    // Lidando com ações de atualização
    if(isset($_GET['delete']) && $_GET['delete'] == 'true'){
        $stmt = $conn->prepare("DELETE FROM aluno WHERE id=:id");
        $stmt->execute([
            ":id" => $_POST['id']
        ]);
        try{
            unlink('fotos/' . $_POST['id'] . ".jpg");
            unlink('fotos/' . $_POST['id'] . ".png");
        } catch(Exception $e){ }

        echo "<div class='ui message'>Aluno removido com sucesso</div>";
        echo "<script>window.location.replace('index.php')</script>";
    } else {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $filename = 'fotos/' . $_POST['id'] . ".$ext";
        move_uploaded_file($_FILES['foto']['tmp_name'], $filename);        
        $stmt = $conn->prepare(
            "UPDATE aluno SET 
                nome=:nome,
                dataNasc=:dataNasc,
                sexo=:sexo,
                responsavel_1=:responsavel_1,
                responsavel_2=:responsavel_2,
                telefone=:telefone,
                endereco=:endereco,
                bolsaFamilia=:bolsaFamilia,
                serie=:serie,
                turma=:turma,
                turno=:turno,
                foto=:foto,
                anoLetivo=:anoLetivo
            WHERE id=:id
            ");
        $s = $stmt->execute([
            ":nome"=>$_POST['nome'],
            ":dataNasc"=>$_POST['dataNasc'],
            ":sexo"=>$_POST['sexo'],
            ":responsavel_1"=>$_POST['responsavel_1'],
            ":responsavel_2"=>$_POST['responsavel_2'],
            ":telefone"=>$_POST['telefone'],
            ":endereco"=>$_POST['endereco'],
            ":bolsaFamilia"=>$_POST['bolsaFamilia'],
            ":serie"=>$_POST['serie'],
            ":turma"=>$_POST['turma'],
            ":turno"=>$_POST['turno'],
            ":foto"=>$filename,
            ":anoLetivo"=>$_POST['anoLetivo'],
            ":id"=>$_POST['id']
        ]);
        if($s){
            echo "<div class='ui message'>Aluno atualizado com sucesso.</div>";
        } else {
            echo "<div class='ui message erro'>Algo deu errado.</div>";
            echo "<div class='ui segment>";
            var_dump($stmt->errorInfo());
            echo "</div>";
        }
        echo "<script>window.location.replace('index.php')</script>";
        
        
    }

    //

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Atualização de Aluno</title>
    <link rel="stylesheet" href="css/semantic.min.css">
    <link rel="stylesheet" href="css/icon.min.css">
  </head>

  <body>

  </body>
</html>
