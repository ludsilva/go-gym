<?php
  include ('../service/connect.php');

  $msg = array();

  try {
    if($_GET['excluir']){

      $id = filter_var($_GET['excluir'], FILTER_VALIDATE_INT);

      if($id == false){
        throw new Exception("ID inválido!");
      }
    
      $sql_delete = "DELETE from alunos WHERE id = $id";

      $resultado = mysqli_query($connect, $sql_delete);
      if($resultado === false || mysqli_errno($connect)) {
        throw new Exception ('Erro ao realizar a exclusão no banco de dados: ' . mysqli_error($connect));
      } else {
        header ('Location: http://localhost/projeto2/clientes.php');
      }
    }
  } catch(Exception $ex){
    $msg = array(
      'classe' => 'alert-danger',
      'mensagem' => $ex->getMessage()
    );
  }

?>