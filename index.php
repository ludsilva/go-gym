<?php
  include './src/service/connect.php';

  $msg = array();

  if(isset($_POST['email']) || isset($_POST['senha'])) {

      if(strlen($_POST['email']) == 0) {
          echo "Preencha seu e-mail";
      } else if(strlen($_POST['senha']) == 0) {
          echo "Preencha sua senha";
      } else {

        $email = $connect->real_escape_string($_POST['email']);
        $senha = $connect->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $connect->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: cadastro.php");

        } else {
          $msg = array(
            'classe' => 'alert-danger',
            'mensagem' => 'Erro! E-mail ou senha incorretos'
          );
          header('Refresh:2; url=index.php');
        }
    }
  }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/main.css">
  <title>GoGym | Login</title>
</head>

<body>
<header class="header cabecalho">
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">        
      <a class="navbar-brand text-white fw-bold" href="index.php">
       <img src="./assets/img/logo_levantandoPeso.svg" class="logo" alt="">
        GoGym
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-uppercase" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-white" href="clientes.php">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="financeiro.php">Financeiro</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="relatorios.php">Relatórios</a>
          </li>
        </ul>
    </div>
  </nav>
</header>
  
  <main class="py-5">
    <section class="container text-center bg-white cadastro w-75">
      <h1 class="text-uppercase py-3 text-center">Login</h1>
      <?php if ($msg) : ?>
        <div class="alert <?= $msg['classe'] ?>" role="alert">
          <?= $msg['mensagem']; ?>
        </div>
      <?php endif; ?>
      <div class="container-fluid px-5">
        <form class="px-5" method="POST">
          <div class="mb-3 px-5">
            <label for="formGroupExampleInput" class="form-label">Login</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Seu e-mail">
          </div>
          <div class="mb-3 px-5">
            <label for="exampleInputPassword1" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha">
          </div>
            <button type="submit" class="btn btn-primary btn-lg py-2 my-3">
              Entrar
            </button>
        </form>
      </div>
    </section>
  </main>

  <?php
    include './assets/includes/footer.php';
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script>
    alert('Usuário: teste@email.com.br \n Senha: Pass123!');
  </script>
</body>

</html>