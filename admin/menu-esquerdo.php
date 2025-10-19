<div class="navbar-nav w-100">
    <a href="index.php" class="nav-item nav-link fw-bold fs-5 mb-2 <?php print_active($page, 'home') ?> ">
        <i class="fa fa-tachometer-alt me-2"></i>Dashboard
    </a>

    <!-- <a href="?page=encontristas" class="nav-item nav-link <?php print_active($page, "encontristas") ?> ">
        <i class="fa fa-keyboard me-2"></i>Encontristas
    </a> -->

    <div class="nav-item dropdown">
        <a href="?page=encontristas" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fa fa-laptop me-2"></i>Encontristas
        </a>
        <!-- <div class="dropdown-menu bg-transparent border-0"> -->
            <a href="?page=encontristas" class="dropdown-item">Listagem geral</a>
            <a href="?page=encontristas" class="dropdown-item">Listagem por círculo</a>
            <a href="?page=encontristas&operacao=inserir" class="dropdown-item">Novo casal</a>
        <!-- </div> -->
    </div>    


    <!-- <a href="?page=equipes" class="nav-item nav-link <?php print_active($page, "equipes") ?> ">
        <i class="fa fa-keyboard me-2"></i>Equipes
    </a> -->

    <div class="nav-item dropdown">
        <a href="?page=equipes" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fa fa-laptop me-2"></i>Equipes
        </a>
        <!-- <div class="dropdown-menu bg-transparent border-0"> -->
            <a href="?page=equipes" class="dropdown-item">Listagem geral</a>
            <a href="?page=equipes" class="dropdown-item">Listagem por equipe</a>
            <a href="?page=equipes&operacao=inserir" class="dropdown-item">Novo casal</a>
        <!-- </div> -->
    </div>        

    <div class="mt-3 mb-2 text-uppercase text-muted small ps-3">Funcionalidades</div>
    <div class="nav-item dropdown">
        <a href="?page=encontristas" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fa fa-users me-2"></i>Encontristas
        </a>
        <a href="?page=encontristas" class="dropdown-item">Listagem geral</a>
        <a href="?page=encontristas" class="dropdown-item">Listagem por círculo</a>
        <a href="?page=encontristas&operacao=inserir" class="dropdown-item">Novo casal</a>
    </div>
    <div class="nav-item dropdown">
        <a href="?page=equipes" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fa fa-people-carry me-2"></i>Equipes
        </a>
        <a href="?page=equipes" class="dropdown-item">Listagem geral</a>
        <a href="?page=equipes" class="dropdown-item">Listagem por equipe</a>
        <a href="?page=equipes&operacao=inserir" class="dropdown-item">Novo casal</a>
    </div>
    <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-puzzle-piece me-2"></i>Elementos</a>
        <div class="dropdown-menu bg-transparent border-0">
            <a href="button.html" class="dropdown-item">Buttons</a>
            <a href="typography.html" class="dropdown-item">Typography</a>
            <a href="element.html" class="dropdown-item">Other Elements</a>
        </div>
    </div>
    <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
    <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
    <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tabelas</a>
    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Gráficos</a>
    <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Páginas</a>
        <div class="dropdown-menu bg-transparent border-0">
            <a href="signin.html" class="dropdown-item">Sign In</a>
            <a href="signup.html" class="dropdown-item">Sign Up</a>
            <a href="404.html" class="dropdown-item">404 Error</a>
            <a href="blank.html" class="dropdown-item">Blank Page</a>
        </div>
    </div>
    <div class="mt-3 mb-2 text-uppercase text-muted small ps-3">Sistema</div>
    <a href="config-cartao-form.php" class="nav-item nav-link"><i class="fa fa-cog me-2"></i>Configurações</a>
</div>