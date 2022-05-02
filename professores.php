<?php
  include './src/service/protect.php';
  require './src/service/connect.php';

  $msg = array();

  //Create
  try{
    if($_POST){
      $nome = filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      $sobrenome = filter_var($_POST['sobrenome'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      $cpf = $_POST['cpf'];
      $dataDeNascimento = $_POST['dataDeNascimento'];
      $email = $_POST['email'];
      $telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      $modalidade = filter_var($_POST['modalidade'], FILTER_SANITIZE_SPECIAL_CHARS);
      $salario = $_POST['salario'];

      $nome = mysqli_real_escape_string($connect, $nome);
      $sobrenome = mysqli_real_escape_string($connect, $sobrenome);
      $cpf = mysqli_real_escape_string($connect, $cpf);
      $dataDeNascimento = mysqli_real_escape_string($connect, $dataDeNascimento);
      $email = mysqli_real_escape_string($connect, $email);
      $telefone = mysqli_real_escape_string($connect, $telefone);
      $modalidade = mysqli_real_escape_string($connect, $modalidade);
      $salario = mysqli_real_escape_string($connect, $salario);

      $sql = "INSERT INTO professores (nome, sobrenome, dataDeNascimento, cpf, email, telefone, modalidade, salario) 
      VALUES('$nome', '$sobrenome', '$dataDeNascimento', '$cpf', '$email', '$telefone', '$modalidade', '$salario')";

      $resultado = mysqli_query($connect, $sql);

      if ($resultado === false || mysqli_errno($connect)) {
        throw new Exception('Erro ao realizar operação no banco de dados: ' . $connect->error);
        //echo ('Erro!');
      } 
      $msg = array(
        'classe' => 'alert-success',
        'mensagem' => 'Professor(a) cadastrado(a) com sucesso!'
      );
      header('Refresh:2; url=http://localhost/projeto2/professores.php');
    }

    //Delete
    if(isset($_GET['excluir'])){

      $id = filter_var($_GET['excluir'], FILTER_VALIDATE_INT);

      if($id == false){
        throw new Exception("ID inválido!");
      }
    
      $sql_delete = "DELETE from professores WHERE id = $id";

      $resultado = mysqli_query($connect, $sql_delete);
      if($resultado === false || mysqli_errno($connect)) {
        throw new Exception ('Erro ao realizar a exclusão no banco de dados: ' . mysqli_error($connect));
      } else {
        header ('Location: professores.php');
      }
    }

  } catch(Exception $ex){
      $msg = array(
        'classe' => 'alert-danger',
        'mensagem' => $ex->getMessage()
      );
  }

  //List - Professores
  $sql_search = "SELECT * FROM professores";

  $resultado = mysqli_query($connect, $sql_search);
  if($resultado){
     $lista_professores = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  }

  //List - options
  $sql_searchModalidade = "SELECT * FROM modalidades";

  $resultadoModalidade = mysqli_query($connect, $sql_searchModalidade);
  if($resultadoModalidade){
     $lista_modalidades = mysqli_fetch_all($resultadoModalidade, MYSQLI_ASSOC);
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/e66da2c05e.js" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="./assets/css/main.css">
  <title>Cadastro de Professores</title>
</head>
<body>
  <?php
    include './assets/includes/navbar.php';
  ?>

  <main class="py-3 px-4">
  <section class="container-flud bg-white py-5 px-5 mx-2 my-5 cadastro">
      <h1 class="text-uppercase">Novo Professor</h1>
      <div class="container-fluid bg-white px-5">
      <?php if ($msg) : ?>
        <div class="alert <?= $msg['classe'] ?>" role="alert">
          <?= $msg['mensagem']; ?>
        </div>
      <?php endif; ?>
        <form method="POST">
          <div class="mb-3 row">
            <div class="col">
              <label for="exampleInputEmail1" class="form-label">Nome</label>
              <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nome" placeholder="Nome" required>
            </div>
            <div class="col">
              <label for="exampleInputEmail1" class="form-label">Sobrenome</label>
              <input type="text" class="form-control" name="sobrenome" id="sobrenome" aria-describedby="Sobrenome" placeholder="Sobrenome" required>
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col">
              <label for="" class="form-label">CPF</label>
              <input type="text" class="form-control" id="cpf" aria-describedby="cpf" 
              placeholder="000.000.000-00" pattern="^(\d{3}\.\d{3}\.\d{3}-\d{2})|(\d{11})$"  name="cpf">
              <div id="cpfMessage" class="pt-2"></div>
            </div>
            <div class="col">
              <label for="exampleInputEmail1" class="form-label">Data de Nascimento</label>
              <input type="date" class="form-control" id="dataDeNascimento" aria-describedby="nascimento" name="dataDeNascimento" required>
              <div id="dateAlert" class="pt-2"></div>
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col">
              <label for="exampleFormControlInput1" class="form-label">Email </label>
              <input type="email" class="form-control" name="email" id="email" 
              placeholder="nomeemail@email.com" pattern='\w*@\w*\.\w*\.?\w*' required>
            </div>
            <div class="col">
              <label for="exampleInputEmail1" class="form-label">Telefone</label>
              <input type="tel" class="form-control" name="telefone" id="telefone" aria-describedby="telefone" placeholder="(00) 000000000" maxlength="14" required>
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col">
              <div class="col">
                <label for="exampleInputEmail1" class="form-label">Modalidade</label>
                <select class="form-select" id="modalidade" name="modalidade" aria-label="select">
                  <option selected disabled>Escolha...</option>
                  <?php foreach ($lista_modalidades as $modalidade) : ?>
                    <option value="<?= $modalidade['modalidade'] ?>"><?= $modalidade['modalidade'] ?></option>
                  <?php endforeach; ?> 
                </select>
              </div>
            </div>
            <div class="col">
              <label for="" class="form-label">Salário</label>
              <input class="form-control" type="text" name="salario" id="salario">
            </div>
          </div>
          <div class="mb-3 bg-white pb-4">
            <div class="float-start">
              <button type="submit" class="btn btn-success" name="enviar" id="enviar">
                 Salvar
              </button>
            </div>
            <div class="float-end">
              <button type="button" class="btn btn-danger ">
                <a href="clientes.php" class="text-white text-decoration-none">Cancelar</a>
              </button>
            </div>
          </div>      
        </form>
      </div>
    </section>

    <section class="container-fluid lista py-5 mx-2 bg-white cadastro">
      <div class="container">
        <h1 class="text-uppercase py-3 text-center">Lista de Professores</h1>
      </div>
      <div class="container-fluid px-4 mx-2">
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
              <th>Salário</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($lista_professores as $professor) : ?>
              <tr class="text-justify">
                  <td><?= $professor['id'] ?></td>
                  <td><?= $professor['nome'] ?></td>
                  <td><?= $professor['sobrenome'] ?></td>
                  <td><?= $professor['dataDeNascimento'] ?></td>
                  <td><?= $professor['cpf'] ?></td>
                  <td><?= $professor['email'] ?></td>
                  <td><?= $professor['telefone'] ?></td>
                  <td><?= $professor['modalidade'] ?></td>
                  <td><?= $professor['salario'] ?></td>
                  <td>
                    <a href="editarprofessores.php?id=<?= $professor['id'] ?>" class="bt-lapis">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                  </td>
                  <td>
                    <a href="professores.php?excluir=<?= $professor['id'] ?>" onclick="return confirm('Deseja mesmo deletar?');" class="bt-lixo" type="button" id="delete">
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

  <script src="./assets/js/validacao.js"></script>
  <script src="./assets/js/alerts.js"></script>
</body>
</html>