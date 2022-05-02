<?php
  include './src/service/protect.php';
  require './src/service/connect.php';

  $msg = array();

  //Create
  try{
    if($_POST){
      $modalidade = filter_var($_POST['modalidade'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
      $preco = $_POST['preco'];
      $cargaHoraria = $_POST['cargaHoraria'];
      $professor = filter_var($_POST['professor'], FILTER_SANITIZE_SPECIAL_CHARS);
      
      $modalidade = mysqli_real_escape_string($connect, $modalidade);
      $preco = mysqli_real_escape_string($connect, $preco);
      $cargaHoraria = mysqli_real_escape_string($connect, $cargaHoraria);
      $professor = mysqli_real_escape_string($connect, $professor);

      $sql = "INSERT INTO modalidades (modalidade, preco, cargaHoraria, professor) 
      VALUES('$modalidade', '$preco', '$cargaHoraria', '$professor')";

      $resultado = mysqli_query($connect, $sql);

      if ($resultado === false || mysqli_errno($connect)) {
        throw new Exception('Erro ao realizar operação no banco de dados: ' . $connect->error);
      } 
      $msg = array(
        'classe' => 'alert-success',
        'mensagem' => 'Modalidade cadastrada com sucesso!'
      );
      header('Refresh:2; url=http://localhost/projeto2/modalidades.php');
    } 
    //Delete
    if(isset($_GET['excluir'])){

      $id = filter_var($_GET['excluir'], FILTER_VALIDATE_INT);

      if($id == false){
        throw new Exception("ID inválido!");
      }
    
      $sql_delete = "DELETE from modalidades WHERE id = $id";

      $resultado = mysqli_query($connect, $sql_delete);
      if($resultado === false || mysqli_errno($connect)) {
        throw new Exception ('Erro ao realizar a exclusão no banco de dados: ' . mysqli_error($connect));
      } else {
        header ('Location: http://localhost/projeto2/modalidades.php');
      }
    }

  } catch(Exception $ex){
    $msg = array(
      'classe' => 'alert-danger',
      'mensagem' => $ex->getMessage()
    );
  }

  //List
  $sql_search = "SELECT * FROM modalidades";

  $resultado = mysqli_query($connect, $sql_search);
  if($resultado){
     $lista_modalidades = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  }

  //List - professores
  $sql_searchProfessores = "SELECT * FROM professores";

  $resultadoProfessores = mysqli_query($connect, $sql_searchProfessores);
  if($resultadoProfessores){
     $lista_professores = mysqli_fetch_all($resultadoProfessores, MYSQLI_ASSOC);
  }

  //Update

  
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
  <title>Cadastro de Modalidades</title>
</head>
<body>
  <?php
    include './assets/includes/navbar.php';
  ?>
  
  <main class="py-3 px-4">
    <section class="container-flud bg-white py-5 px-5 mx-2 my-5 cadastro">
      <h1 class="text-uppercase pb-2">Nova Modalidade</h1>
      <div class="container-fluid bg-white px-5">
        <?php if ($msg) : ?>
          <div class="alert <?= $msg['classe'] ?>" role="alert">
            <?= $msg['mensagem']; ?>
          </div>
        <?php endif; ?>
        <form method="POST">
          <div class="mb-3 row">
            <div class="col">
              <label for="exampleInputEmail1" class="form-label">Modalidade</label>
              <input type="text" class="form-control" name="modalidade" id="modalidade" aria-describedby="modalidade" placeholder="Modalidade">
            </div>
            <div class="col">
              <label for="exampleInputEmail1" class="form-label">Preço</label>
              <input type="text" class="form-control" name="preco" id="preco" aria-describedby="preco" placeholder="Preço">
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col">
              <label for="" class="form-label">Carga Horária</label>
              <input type="text" class="form-control" id="cargaHoraria" aria-describedby="cargaHoraria" name="cargaHoraria">
            </div>
            <div class="col">
              <label for="exampleInputEmail1" class="form-label">Professor</label>
              <select class="form-select" id="modalidade" name="modalidade" aria-label="select">
                <option selected disabled>Escolha...</option>
                <?php foreach ($lista_professores as $professor) : ?>
                  <option value="<?= $professor['nome'] ?> <?= $professor['sobrenome'] ?>">
                  <?= $professor['nome'] ?> <?= $professor['sobrenome'] ?>
                </option>
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
              <button type="button" class="btn btn-danger btn-lg">
                <a href="modalidades.php" class="text-white text-decoration-none">Cancelar</a>
              </button>
            </div>
          </div>      
        </form>
      </div>
    </section>

    <section class="lista py-5 bg-white cadastro">
      <div class="container">
        <h1 class="text-uppercase py-3 text-center">Lista de Modalidades</h1>
      </div>
      <div class="container-fluid px-4 mx-3">
        <table class="table table-striped table-hover">
          <thead>
            <tr class="text-justify fw-bold">
              <th>ID</th>
              <th>Modalidade</th>
              <th>Preço</th>
              <th>Carga Horária</th>
              <th>Professor(a)</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($lista_modalidades as $modalidade) : ?>
              <tr class="text-ustify">
                  <td><?= $modalidade['id'] ?></td>
                  <td><?= $modalidade['modalidade'] ?></td>
                  <td><?= $modalidade['preco'] ?></td>
                  <td><?= $modalidade['cargaHoraria'] ?> horas</td>
                  <td><?= $modalidade['professor'] ?></td>

                  <td>
                    <a href="modalidades.php?excluir=<?= $modalidade['id'] ?>" onclick="return confirm('Deseja mesmo deletar?');" class="bt-lixo" type="button" id="delete">
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
</body>

</html>