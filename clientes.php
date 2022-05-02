<?php
  include './src/service/protect.php';
  include './src/service/connect.php';

  $msg = array();
  $alunoUpdate;

  //Listar
  $sql_search = "SELECT * FROM alunos";

  $resultado = mysqli_query($connect, $sql_search);
  if($resultado){
    $lista_alunos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  }

  //Update
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
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e66da2c05e.js" crossorigin="anonymous"></script>
    <title>Clientes</title>
  </head>

  <body>
    <?php
      include './assets/includes/navbar.php';
    ?>

    <main class="py-3 px-4 mx-2">
      <section class="container-fluid bg-white mx-3 pt-4 pb-3 cadastro">
        <div class="container-fluid bg-white">
          <div class="row py-3 mx-4">
            <div class="col">
            <div class="">
              <button type="button" class="btn btn-primary">
                  <a href="cadastro.php" class="text-white text-decoration-none">Novo Cliente</a>
              </button>
            </div>
            </div>
            <div class="col">
              <div class="input-group rounded">
                <input disabled type="search" class="form-control rounded" placeholder="Pesquisar" aria-label="Search" aria-describedby="search-addon" />
                <span class="input-group-text border-0" id="search-addon">
                  <i class="fas fa-search"></i>
               </span>
              </div>
            </div>
          </div>
          <h2 class="text-uppercase text-center py-3">Clientes</h2>

            <div class="container-fluid">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-justify fw-bold">
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>Data de Nascimento</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Modalidade</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($lista_alunos as $aluno) : ?>
                        <tr>
                          <td><?= $aluno['id'] ?></td>
                          <td><?= $aluno['nome'] ?></td>
                          <td><?= $aluno['sobrenome'] ?></td>
                          <td><?= $aluno['dataDeNascimento'] ?></td>
                          <td><?= $aluno['cpf'] ?></td>
                          <td><?= $aluno['email'] ?></td>
                          <td><?= $aluno['telefone'] ?></td>
                          <td><?= $aluno['modalidade'] ?></td>
                          <td>
                            <a type="button" href="editar.php?id=<?= $aluno['id'] ?>" class="bt-lapis">
                              <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                          </td>
                          <td>
                            <a href="src/crud/delete.php?excluir=<?= $aluno['id'] ?>" onclick="return confirm('Deseja mesmo deletar?');" class="bt-lixo" type="button" id="delete">
                              <i class="fa-solid fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>                   
                    </tbody>
                </table>
            </div>
      </section>
    </main>
    
    <?php
    include './assets/includes/footer.php';
    ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


  </body>
</html>