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

    public function static createAluno(
      $nome, $id, $dataNasc, $sexo, $responsavel_1, $responsavel_2, $telefone,
      $endereco, $bolsaFamilia, $serie, $turma, $turno, $foto, $anoLetivo){
        $this->nome = $nome;
        $this->id = $id;
        $this->dataNasc = $dataNasc;
        $this->sexo = $sexo;
        $this->responsavel_1 = $responsavel_1;
        $this->responsavel_2 = $responsavel_2;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->bolsaFamilia = $bolsaFamilia;
        $this->serie = $serie;
        $this->turma = $turma;
        $this->turno = $turno;
        $this->foto = $foto;
        $this->anoLetivo = $anoLetivo;
    }

    public function insertIntoDB($conn){
      $sqlQuery =
        "INSERT INTO aluno VALUES(:nome, :id, :dataNasc, :sexo,
        :responsavel_1, :responsavel_2, :telefone, :endereco, :bolsaFamilia,
        :serie, :turma, :turno, :foto, :anoLetivo)";
      $stmt = $conn->prepare($sqlQuery);
      // Bidding params
      $stmt->bindParam(':nome',$nome);
      $stmt->bindParam(':id',$id);
      $stmt->bindParam(':dataNasc',$dataNasc);
      $stmt->bindParam(':sexo',$sexo);
      $stmt->bindParam(':responsavel_1',$responsavel_1);
      $stmt->bindParam(':responsavel_2',$responsavel_2);
      $stmt->bindParam(':telefone',$telefone);
      $stmt->bindParam(':endereco',$endereco);
      $stmt->bindParam(':bolsaFamilia',$bolsaFamilia);
      $stmt->bindParam(':serie',$serie);
      $stmt->bindParam(':turma',$turma);
      $stmt->bindParam(':turno',$turno);
      $stmt->bindParam(':foto',$foto);
      $stmt->bindParam(':anoLetivo',$anoLetivo);
      // executing stmt
      $stmt->execute();
    }






  }



 ?>
