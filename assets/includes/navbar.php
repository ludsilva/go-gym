<header class="header cabecalho">
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">        
      <a class="navbar-brand text-white fw-bold">
       <img src="./assets/img/logo_levantandoPeso.svg" class="logo" alt="">
        GoGym
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-uppercase" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white" href="clientes.php">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="professores.php">Professores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="modalidades.php">Modalidades</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="financeiro.php">Financeiro</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="relatorios.php">Relatórios</a>
          </li>
        </ul>
        <div class="d-flex text-white pe-2">
          Bem vindo ao Painel, <?php echo $_SESSION['nome']; ?>.
        </div>
        <div>
          <a type="button" class="text-white text-uppercase text-decoration-none btn btn-primary" href="./src/service/logout.php">Sair</a>
        </div>
      </div>
    </div>
  </nav>
</header>