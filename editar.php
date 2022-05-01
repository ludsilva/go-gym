<?php
  include './src/service/connect.php';

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

      $sql_update = "UPDATE alunos set nome = '$nome', sobrenome = '$sobrenome', dataDeNascimento = '$dataDeNascimento', cpf = '$cpf', email = '$email', telefone = '$telefone', modalidade = '$modalidade' WHERE id = $id";

      $resultado = mysqli_query($connect, $sql_update);

      if (!$resultado ||  mysqli_errno($connect)) {
        throw new Exception('Erro ao realizar operação no banco de dados: ' . $connect->error);
        echo json_encode ('Erro!');
      } 
      
      echo json_encode('Foi!');
    }

  } catch(Exception $ex){
      echo $ex->getMessage();
  }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    include './assets/includes/navbar.php';
  ?>

<section class="container">
    <h2 class="py-3">Editar Clientes</h2>
    
    <?php if ($msg) : ?>
      <div class="alert <?= $msg['classe'] ?>" role="alert">
        <?= $msg['mensagem']; ?>
      </div>
    <?php endif; ?>

    <p>Utilize o formulário abaixo para editar ou atualizar os dados de um cliente:</p>
    
    <div class="container bg-white">
      <form method="POST">
        <div class="row mb-3">
          <div class="col-3">
            <label for="" class="form-label">ID:</label>
            <input type="text" name="id" class="form-control" readonly value="<?= $cliente['id'] ?? '' ?>">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="inputName" class="form-label">Nome:</label>
            <input type="text" class="form-control" name="nome" value="<?= $cliente['nome'] ?? '' ?>">
          </div>
          <div class="col mb-3">
            <label for="inputEmail" class="form-label">E-mail:</label>
            <input type="email" class="form-control" name="email" value="<?= $cliente['email'] ?? '' ?>">
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <label for="inputTel" class="form-label">Telefone:</label>
            <input type="tel" class="form-control" name="telefone" pattern="[0-9]{2}[0-9]{5}[0-9]{4}" value="<?= $cliente['telefone'] ?? '' ?>">
          </div>
          <div class="col">
            <label for="inputCity" class="form-label">Cidade:</label>
            <input type="text" class="form-control" name="cidade" value="<?= $cliente['cidade'] ?? '' ?>">
          </div>
        </div>            
        <button type="submit" name="enviar" class="btn btn-primary">Atualizar</button>
        
      </form>
    </div>
  </section>

  <?php
    include './assets/includes/footer.php';
  ?>
</body>
</html>