<?php
  include ('../service/connect.php');

  try{
    if($_POST){
      $nome = filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      $sobrenome = filter_var($_POST['sobrenome'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      $cpf = $_POST['cpf'];
      $dataDeNascimento = $_POST['dataDeNascimento'];
      $email = $_POST['email'];
      $telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      $modalidade = filter_var($_POST['modalidade'], FILTER_SANITIZE_SPECIAL_CHARS);


      $nome = mysqli_real_escape_string($connect, $nome);
      $sobrenome = mysqli_real_escape_string($connect, $sobrenome);
      $cpf = mysqli_real_escape_string($connect, $cpf);
      $dataDeNascimento = mysqli_real_escape_string($connect, $dataDeNascimento);
      $email = mysqli_real_escape_string($connect, $email);
      $telefone = mysqli_real_escape_string($connect, $telefone);
      $modalidade = mysqli_real_escape_string($connect, $modalidade);

      $sql = "INSERT INTO alunos (nome, sobrenome, dataDeNascimento, cpf, email, telefone, modalidade) 
      VALUES('$nome', '$sobrenome', '$dataDeNascimento', '$cpf', '$email', '$telefone', '$modalidade')";

      $resultado = mysqli_query($connect, $sql);

      if ($resultado === false || mysqli_errno($connect)) {
        //throw new Exception('Erro ao realizar operação no banco de dados: ' . $connect->error);
        echo json_encode ('Erro!');
      } 
      
      echo json_encode('Foi!');
    }

  } catch(Exception $ex){
      echo $ex->getMessage();
  }

  //Closing connection
  $connect->close();
?>