<?php 
$usuario = $this->session->userdata('usuario_logado');
$usuarioDecriptado = isset($usuario['perfil']) ? decriptar($usuario['perfil']) : 0;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="<?= base_url('home') ?>">Ecommerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                <?php if(in_array($usuarioDecriptado, [2, 3, 4])){ ?>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= base_url('admin/dashboard') ?>">Admin</a></li>
                <?php } ?>
            </ul>
            <form class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartSidebar">
                    <i class="fa-solid fa-cart-shopping"></i> Carrinho <span class="badge bg-dark text-white ms-1 rounded-0" id="cart-count">0</span>
                </button>

                <div class="dropdown ms-3">
                    <button class="btn dropdown-toggle" type="button" id="dropdownConta" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i> <?= $usuario ? htmlspecialchars($usuario['nome']) : 'Conta' ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownConta">
                        <?php if ($usuario): ?>
                        <li><a class="dropdown-item" href="<?= base_url('perfil') ?>">Meu Perfil</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('pedidos') ?>">Meus Pedidos</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Sair</a></li>
                        <?php else: ?>
                        <li><a class="dropdown-item" href="<?= base_url('login') ?>">Entrar</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('usuario/cadastro') ?>">Cadastrar</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</nav>