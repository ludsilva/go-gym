<?php
  include './src/service/protect.php';
  include './src/service/connect.php';

  $msg = array();

  try{
    if($_POST){
      $id = ($_POST['id']);
      $nome = filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      $sobrenome = filter_var($_POST['sobrenome'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      $cpf = $_POST['cpf'];
      $dataDeNascimento = $_POST['dataDeNascimento'];
      $email = $_POST['email'];
      $telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      $modalidade = filter_var($_POST['modalidade'], FILTER_SANITIZE_SPECIAL_CHARS);
      $salario = $_POST['salario'];

      $id = mysqli_real_escape_string($connect, $id);
      $nome = mysqli_real_escape_string($connect, $nome);
      $sobrenome = mysqli_real_escape_string($connect, $sobrenome);
      $cpf = mysqli_real_escape_string($connect, $cpf);
      $dataDeNascimento = mysqli_real_escape_string($connect, $dataDeNascimento);
      $email = mysqli_real_escape_string($connect, $email);
      $telefone = mysqli_real_escape_string($connect, $telefone);
      $modalidade = mysqli_real_escape_string($connect, $modalidade);
      $salario = mysqli_real_escape_string($connect, $salario);


      $sql_update = "UPDATE professores set nome='$nome', sobrenome='$sobrenome', dataDeNascimento='$dataDeNascimento', cpf='$cpf', email='$email', telefone='$telefone', modalidade='$modalidade', salario='$salario' WHERE id=$id";

      $resultado = mysqli_query($connect, $sql_update);

      if (!$resultado ||  mysqli_errno($connect)) {
        throw new Exception('Erro ao realizar operação no banco de dados: ' . $connect->error);
        echo json_encode ('Erro!');
      } else{
        $msg = array(
          'classe' => 'alert-success',
          'mensagem' => 'Professor editado com sucesso!'
        );
        header('Refresh:2; url=clientes.php');
      }
    }
    
    if(isset($_GET['id'])){
      $id = filter_var($_GET['id'], FILTER_VALIDATE_INT, [
        'options' => array(
            'min_range' => 1
        )
      ]);

      if ($id === false) {
        throw new Exception('ID fornecido é inválido!');
      }

      $sql_Select = "SELECT * FROM professores WHERE id = $id";
      $result = mysqli_query($connect, $sql_Select);

      if (!$result || mysqli_errno($connect)) {
          throw new Exception('Erro ao buscar informações na base de dados: ' . mysqli_error($connect));
      }

      // Caso queira usar os indíces de forma numérica basta usar mysqli_fetch_array()
      $professor = mysqli_fetch_array($result);

      if (!$professor) {
          throw new Exception('Dados do cliente não foram encontrados!');
      }

    }

  } catch(Exception $ex){
      echo $ex->getMessage();
  }

  //List
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
  <link rel="stylesheet" href="./assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Editar</title>
</head>
<body>
  <?php
    include './assets/includes/navbar.php';
  ?>

  <section class="container bg-white cadastro py-4 my-3">
    <h2 class="py-3">Editar Professor(a)</h2>
    
    <?php if ($msg) : ?>
      <div class="alert <?= $msg['classe'] ?>" role="alert">
        <?= $msg['mensagem']; ?>
      </div>
    <?php endif; ?>

    <p>Utilize o formulário abaixo para editar ou atualizar os dados de um(a) professor(a):</p>
    
    <div class="container bg-white">
      <form method="POST">
        <div class="mb-3 row-cols-2">
          <label for="" class="form-label">ID:</label>
          <input type="text" class="form-control" value="<?= $professor['id'] ?? '' ?>" name="id" id="id" readonly>
        </div>
        <div class="mb-3 row">
            <div class="col">
              <label for="exampleInputEmail1" class="form-label">Nome</label>
              <input type="text" class="form-control" name="nome" id="nome" value="<?= $professor['nome'] ?? '' ?>"
              aria-describedby="nome" placeholder="Nome" required>
            </div>
            <div class="col">
              <label for="exampleInputEmail1" class="form-label">Sobrenome</label>
              <input type="text" class="form-control" name="sobrenome" id="sobrenome" value="<?= $professor['sobrenome'] ?? '' ?>"
              aria-describedby="Sobrenome" placeholder="Sobrenome" required>
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col">
              <label for="" class="form-label">CPF</label>
              <input type="text" class="form-control" id="cpf" aria-describedby="cpf" value="<?= $professor['cpf'] ?? '' ?>"
              placeholder="000.000.000-00" pattern="^(\d{3}\.\d{3}\.\d{3}-\d{2})|(\d{11})$"  name="cpf">
              <div id="cpfMessage" class="pt-2"></div>
            </div>
            <div class="col">
              <label for="exampleInputEmail1" class="form-label">Data de Nascimento</label>
              <input type="date" class="form-control" id="dataDeNascimento" aria-describedby="nascimento" 
              name="dataDeNascimento" value="<?= $professor['dataDeNascimento'] ?? '' ?>" required>
              <div id="dateAlert" class="pt-2"></div>
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col">
              <label for="exampleFormControlInput1" class="form-label">Email </label>
              <input type="email" class="form-control" name="email" id="email" value="<?= $professor['email'] ?? '' ?>"
              placeholder="nomeemail@email.com" pattern='\w*@\w*\.\w*\.?\w*' required>
            </div>
            <div class="col">
              <label for="exampleInputEmail1" class="form-label">Telefone</label>
              <input type="tel" class="form-control" name="telefone" id="telefone" value="<?= $professor['telefone'] ?? '' ?>"
              aria-describedby="telefone" placeholder="(00) 000000000" maxlength="14" required>
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col">
              <div class="col">
                <label for="exampleInputEmail1" class="form-label">Modalidade</label>
                <select class="form-select" id="modalidade" name="modalidade" aria-label="select">
                  <option selected value="<?= $professor['modalidade'] ?? '' ?>"><?= $professor['modalidade'] ?? '' ?></option>
                  <?php foreach ($lista_modalidades as $modalidade) : ?>
                    <option value="<?= $modalidade['modalidade'] ?>"><?= $modalidade['modalidade'] ?></option>
                  <?php endforeach; ?> 
                </select>
              </div>
            </div>
            <div class="col">
              <label for="" class="form-label">Salário</label>
              <input class="form-control" type="text" name="salario" id="salario" value="<?= $professor['salario'] ?? '' ?>">
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

  <?php
    include './assets/includes/footer.php';
  ?>
</body>
</html>