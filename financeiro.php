<?php
  include './src/service/protect.php';
  require './src/service/connect.php';

  $msg = array();

  //Create
  try{
    if($_POST){
      $tipo = filter_var($_POST['tipo'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      $valor = $_POST['valor'];
      $forma = filter_var($_POST['forma'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      
      $tipo = mysqli_real_escape_string($connect, $tipo);
      $usuario = mysqli_real_escape_string($connect, $usuario);
      $valor = mysqli_real_escape_string($connect, $valor);
      $forma = mysqli_real_escape_string($connect, $forma);

      $sql = "INSERT INTO financeiro (tipo, usuario, valor, forma) 
      VALUES('$tipo', '$usuario', '$valor', '$forma')";

      $resultado = mysqli_query($connect, $sql);

      if ($resultado === false || mysqli_errno($connect)) {
        throw new Exception('Erro ao realizar operação no banco de dados: ' . $connect->error);
        //echo ('Erro!');
      } 
      $msg = array(
        'classe' => 'alert-success',
        'mensagem' => 'Transação cadastrada com sucesso!'
      );
     
    }
  } catch(Exception $ex){
    $msg = array(
      'classe' => 'alert-danger',
      'mensagem' => $ex->getMessage()
    );
  }

  //Read
  $sql_search = "SELECT * FROM financeiro";

  $resultado = mysqli_query($connect, $sql_search);
  if($resultado){
     $fluxoDeCx = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  }

  //Somas
  /* $sqlSaida = "SELECT SUM(valor) as FROM financeiro WHERE tipo = Pagamento";
  $sqlEntrada = "SELECT SUM(valor) FROM financeiro WHERE tipo = Mensalidade";

  $resultadoSaida = mysqli_query($connect, $sqlSaida);
  $resultadoEntrada = mysqli_query($connect, $sqlEntrada);

  $total = $resultadoEntrada - $resultadoSaida; */

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <title>Financeiro</title>
</head>

<body>
  <?php
    include './assets/includes/navbar.php';
  ?>

    <main class="py-3 my-2">
      <section class="container bg-white cadastro">
      <h1 class="text-uppercase py-3 text-center">Controle Financeiro</h1>
      
      <div class="container-fluid bg-white py-3 px-5">
        <h2 class="text-center py-2">Inserir transação</h2>

        <?php if ($msg) : ?>
          <div class="alert <?= $msg['classe'] ?>" role="alert">
            <?= $msg['mensagem']; ?>
          </div>
        <?php endif; ?>
        <form method="POST">
          <div class="mb-3 row">
            <div class="col">
              <label class="form-label" for="">Tipo</label>
              <select name="tipo" id="tipo" class="form-select">
                <option selected disabled>Escolha...</option>
                <option value="Mensalidade">Mensalidade</option>
                <option value="Salário">Salário de professor</option>
                <option value="Pagamento">Pagamento de conta</option>
              </select>
            </div>
            <div class="col">
              <label class="form-label" for="">Usuário</label>
              <input type="text" name="usuario" id="usuario" class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label class="form-label" for="">Valor</label>
              <input class="form-control" type="text" name="valor" id="valor">
            </div>
            <div class="col">
              <label class="form-label" for="">Forma de Pagamento</label>
              <select name="forma" id="forma" class="form-select">
                <option selected disabled>Escolha...</option>
                <option value="Dinheiro">Dinheiro</option>
                <option value="Cartão">Cartão</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="float-start">
              <button type="submit" class="btn btn-success btn-lg" name="enviar" id="enviar">
                 Salvar
              </button>
            </div>
          </div>
        </form>
      </div>
      </section>

      <section class="container bg-white cadastro">
        <h2 class="text-center">Fluxo de Caixa</h2>

        <div class="container py-2 my-2" id="financeiro">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="text-justify fw-bold">
                <th>ID</th>
                <th>Tipo</th>
                <th>Usuário</th>
                <th>Valor</th>
                <th>Forma de Pagamento</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($fluxoDeCx as $fluxo) : ?>
                <tr class="text-justify">
                    <td><?= $fluxo['id'] ?></td>
                    <td><?= $fluxo['tipo'] ?></td>
                    <td><?= $fluxo['usuario'] ?></td>
                    <td><?= $fluxo['valor'] ?> </td>
                    <td><?= $fluxo['forma'] ?></td>
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
</body>

</html>