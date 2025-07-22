<nav class="navbar navbar-expand-lg bg-light shadow-sm fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand d-md-none" href="#">ERP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="d-flex ms-auto align-items-center">
            <div class="dropdown ms-3">
                <button class="btn dropdown-toggle" type="button" id="dropdownConta" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i> Olá, <?= $usuario['nome'] ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownConta">
                    <li><a class="dropdown-item" href="<?= base_url('home') ?>">Ecommerce</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('perfil') ?>">Meu Perfil</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('pedidos') ?>">Meus Pedidos</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Sair</a></li>
                </ul>
            </div>
        </div>

        
    </div>
</nav>