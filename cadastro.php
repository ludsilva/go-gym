<?php
  include './src/service/protect.php';
  require './src/service/connect.php';

  $sql_search = "SELECT * FROM modalidades";

  $resultado = mysqli_query($connect, $sql_search);
  if($resultado){
     $lista_modalidades = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./assets/css/main.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Cadastro de Cliente</title>
</head>

<body>
  <?php
    include './assets/includes/navbar.php';
  ?>

  <main class="py-3 px-4">
    <section class="container-fluid bg-white py-4 px-5 mx-2 my-3 cadastro">
      <h1 class="text-uppercase">Novo Cliente</h1>
      <div class="container bg-white">
        <form id="formulario">
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
              placeholder="000.000.000-00" pattern="^(\d{3}\.\d{3}\.\d{3}-\d{2})|(\d{11})$" name="cpf" required>
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
            <div class="col">
              <label for="exampleInputEmail1" class="form-label">Modalidade</label>
              <select class="form-select" id="modalidade" name="modalidade" aria-label="select" required>
                <option selected disabled>Escolha...</option>
                <?php foreach ($lista_modalidades as $modalidade) : ?>
                  <option value="<?= $modalidade['modalidade'] ?>"><?= $modalidade['modalidade'] ?></option>
                <?php endforeach; ?> 
              </select>
            </div>
          </div>
          <div class="mb-3 bg-white pb-4">
            <div class="float-start">
              <button type="submit" class="btn btn-success btn-lg" name="enviar" id="enviar">
                 Salvar
              </button>
            </div>
            <div class="float-end">
              <a type="button" href="clientes.php" class="btn btn-danger btn-lg text-white text-decoration-none">Cancelar</a>
            </div>
          </div>      
        </form>
      </div>
    </section>
  </main>
    
  <?php
    include './assets/includes/footer.php';
  ?>
   
   <script src="./assets/js/validacao.js"></script>
   <script src="./assets/js/alerts.js"></script>
   <script src="./assets/js/script.js"></script>
</body>

</html>