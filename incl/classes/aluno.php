<?php
  class Aluno{
    public $nome;
    public $id;
    public $dataNasc;
    public $sexo;
    public $responsavel_1;
    public $responsavel_2;
    public $telefone;
    public $endereco;
    public $bolsaFamilia;
    public $serie;
    public $turma;
    public $turno;
    public $foto;
    public $anoLetivo;

    public function __construct(){
      $this->nome = '';
      $this->id = '';
      $this->dataNasc = '';
      $this->sexo = '';
      $this->responsavel_1 = '';
      $this->responsavel_2 = '';
      $this->telefone = '';
      $this->endereco = '';
      $this->bolsaFamilia = '';
      $this->serie = '';
      $this->turma = '';
      $this->turno = '';
      $this->foto = '';
      $this->anoLetivo = '';
    }

    public static function createAluno(
      $nome, $id, $dataNasc, $sexo, $responsavel_1, $responsavel_2, $telefone,
      $endereco, $bolsaFamilia, $serie, $turma, $turno, $foto, $anoLetivo){
        $aluno = new self();
        $aluno->nome = $nome;
        $aluno->id = $id;
        $aluno->dataNasc = $dataNasc;
        $aluno->sexo = $sexo;
        $aluno->responsavel_1 = $responsavel_1;
        $aluno->responsavel_2 = $responsavel_2;
        $aluno->telefone = $telefone;
        $aluno->endereco = $endereco;
        $aluno->bolsaFamilia = $bolsaFamilia;
        $aluno->serie = $serie;
        $aluno->turma = $turma;
        $aluno->turno = $turno;
        $aluno->foto = $foto;
        $aluno->anoLetivo = $anoLetivo;
        return $aluno;
    }

    public function insertIntoDB($conn){
      $sqlQuery =
        "INSERT INTO aluno VALUES(:nome, :id, :dataNasc, :sexo,
        :responsavel_1, :responsavel_2, :telefone, :endereco, :bolsaFamilia,
        :serie, :turma, :turno, :foto, :anoLetivo)";
      $stmt = $conn->prepare($sqlQuery);
      // Bidding params
      $stmt->bindParam(':nome',$this->nome);
      $stmt->bindParam(':id',$this->id);
      $stmt->bindParam(':dataNasc',$this->dataNasc);
      $stmt->bindParam(':sexo',$this->sexo);
      $stmt->bindParam(':responsavel_1',$this->responsavel_1);
      $stmt->bindParam(':responsavel_2',$this->responsavel_2);
      $stmt->bindParam(':telefone',$this->telefone);
      $stmt->bindParam(':endereco',$this->endereco);
      $stmt->bindParam(':bolsaFamilia',$this->bolsaFamilia);
      $stmt->bindParam(':serie',$this->serie);
      $stmt->bindParam(':turma',$this->turma);
      $stmt->bindParam(':turno',$this->turno);
      $stmt->bindParam(':foto',$this->foto);
      $stmt->bindParam(':anoLetivo',$this->anoLetivo);
      // executing stmt
      $query = $stmt->execute();
      if(!$query){
        return ['success' => false, 'message' => $stmt->errorInfo()[2]];
      } else {
        return ['success' => true];
      }
    }

    public static function getAllAlunos($conn){
        $res = $conn->query("SELECT * FROM aluno")->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function getById($conn, $id){
        $res = $conn->query("SELECT * FROM aluno WHERE id='$id'")->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public static function search($conn, $term){
      $SQL = "SELECT * FROM aluno WHERE";
      function addCond($param, $cond, $terms){
        switch($param){
          case "sexo":
            $term = strtoupper($terms[1]);
            return " $cond sexo = '$term'";
          case "turma":
            $term = strtoupper($terms[1]);
            return " $cond turma = '$term'";
          case "ano":
            $term = strtoupper($terms[1]);
            return " $cond anoLetivo = '$term'";
          case "bolsa":
            $term = strtoupper($terms[1]);
            $term = $term == "SIM" ? 'on' : 'off';
            return " $cond bolsaFamilia = '$term'";
          case "serie":
            $term = strtoupper($terms[1]);
            return " $cond UPPER(serie) = '$term'";
          case "turno":
          $term = strtoupper($terms[1]);
          return " $cond UPPER(serie) = '$term'";
          default:
            $template = mb_strtoupper("'%$param%'", "UTF-8");
            return  " AND (UPPER(id) LIKE $template
                      OR UPPER(nome) LIKE $template
                      OR UPPER(dataNasc) LIKE $template
                      OR UPPER(responsavel_1) LIKE $template
                      OR UPPER(responsavel_2) LIKE $template
                      OR UPPER(telefone) LIKE $template
                      OR UPPER(endereco) LIKE $template)";
        }
      };

      $queries = explode(",", $term);
      $mult = count($queries) < 2;
      
      if($mult){
        $terms = explode("=", $term);
        if(count($terms) == 2) {
          $param = $terms[0];
          $SQL .= addCond($param, "OR", $terms);  
        } else {
          $SQL .= " TRUE " . addCond($terms[0], "AND", $terms);
        }
      } else {
        $SQL .= " (TRUE ";
        foreach($queries as $v){
          $terms = explode("=", $v);
          if(count($terms) == 2) {
            $param = $terms[0];
            $SQL .= addCond($param, "AND", $terms);  
          } else {
            $SQL .= addCond($terms[0], "AND", $terms);
          }
        }
        $SQL .= ")";
      }

      $res = $conn->query($SQL);
      if($res){
        // echo "<div class='ui message'>$SQL</div>";
        return $res->fetchAll(PDO::FETCH_ASSOC);
      } else {
        // echo "<div class='ui message'>$SQL</div>";
        var_dump($conn->errorInfo());
      }

    }




  }



 ?>
