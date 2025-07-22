<nav class="sidebar d-none d-md-block bg-dark">
    <div class="nav flex-column">
      <?php if ($usuarioDecriptado == 4): ?>
        <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= ($telaAtiva === 'dashboard' ? 'active' : '') ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
        <a href="<?= base_url('admin/produtos') ?>" class="nav-link <?= ($telaAtiva === 'produtos' ? 'active' : '') ?>"><i class="bi bi-box-seam me-2"></i> Produtos</a>
        <a href="<?= base_url('admin/pedidos') ?>" class="nav-link <?= ($telaAtiva === 'pedidos' ? 'active' : '') ?>" ><i class="bi bi-cart-check me-2"></i> Pedidos</a>
        <a href="<?= base_url('admin/usuarios') ?>" class="nav-link  <?= ($telaAtiva === 'usuarios' ? 'active' : '') ?>" ><i class="bi bi-people me-2"></i> Usuários</a>
        <a href="<?= base_url('admin/relatorios') ?>" class="nav-link <?= ($telaAtiva === 'relatorios' ? 'active' : '') ?>" ><i class="bi bi-bar-chart-line me-2"></i> Relatórios</a>
        <a href="#" class="nav-link"><i class="bi bi-layout-text-sidebar-reverse"></i> Logs</a>
      <?php elseif($usuarioDecriptado == 3): ?>
        <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= ($telaAtiva === 'dashboard' ? 'active' : '') ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
        <a href="<?= base_url('admin/produtos') ?>" class="nav-link <?= ($telaAtiva === 'produtos' ? 'active' : '') ?>"><i class="bi bi-box-seam me-2"></i> Produtos</a>
        <a href="<?= base_url('admin/pedidos') ?>" class="nav-link <?= ($telaAtiva === 'pedidos' ? 'active' : '') ?>" ><i class="bi bi-cart-check me-2"></i> Pedidos</a>
        <a href="<?= base_url('admin/usuarios') ?>" class="nav-link <?= ($telaAtiva === 'usuarios' ? 'active' : '') ?>" ><i class="bi bi-people me-2"></i> Usuários</a>
        <a href="<?= base_url('admin/relatorios') ?>" class="nav-link <?= ($telaAtiva === 'relatorios' ? 'active' : '') ?>" ><i class="bi bi-bar-chart-line me-2"></i> Relatórios</a>
      <?php elseif($usuarioDecriptado == 2): ?>
        <a href="<?= base_url('admin/produtos') ?>" class="nav-link" <?= ($telaAtiva === 'produtos' ? 'active' : '') ?>><i class="bi bi-box-seam me-2"></i> Produtos</a>
        <a href="<?= base_url('admin/pedidos') ?>" class="nav-link" <?= ($telaAtiva === 'pedidos' ? 'active' : '') ?>><i class="bi bi-cart-check me-2"></i> Pedidos</a>
        <?php endif; ?>
    </div>
  </nav>