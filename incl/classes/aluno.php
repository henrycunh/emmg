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

    public static function getByName($conn, $name){
      $res = $conn->query("SELECT * FROM aluno WHERE UPPER(nome) LIKE UPPER('%" . $name . "%')")->fetchAll(PDO::FETCH_ASSOC);
      return $res;
    }




  }



 ?>
