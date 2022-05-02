<?php
  include './src/service/protect.php';
  include './src/service/connect.php';

   //Read
   $sql_search = "SELECT * FROM financeiro";

   $resultado = mysqli_query($connect, $sql_search);
   if($resultado){
      $fluxoDeCx = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
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

    <title>Relatórios</title>
</head>

<body>
  <?php
    include './assets/includes/navbar.php';
  ?>

  <main class="">
    <section class="container bg-white cadastro py-4 my-3">
      <h1 class="text-center">Gerar Relatórios</h1>
      <div class="container py-3">
        <h4 class="py-2">Clique no botão para gerar um relatório em pdf</h4>
        <button class="btn btn-primary btn-lg" onclick="convert()">Gerar</button>
      </div>

      <h3 class="text-center">Fluxo de Caixa</h3>
      <div class="container" id="content">
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
        <div id="elementH"></div>
    </section>
  </main>


  <?php
   include './assets/includes/footer.php';
  ?>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
  <script src="./assets/js/convert.js"></script>
</body>

</html>