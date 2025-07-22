<?php
$usuario = $this->session->userdata('usuario_logado');
$usuarioDecriptado = isset($usuario['perfil']) ? decriptar($usuario['perfil']) : 0;

$dados_comuns = [
  'usuario'           => $usuario,
  'usuarioDecriptado' => $usuarioDecriptado,
  'telaAtiva'         => 'dashboard'
];

$this->load->view('templates/admin/header', $dados_comuns);
$this->load->view('templates/admin/sidebar', $dados_comuns); 
$this->load->view('templates/admin/navbar', $dados_comuns); 
$this->load->view('templates/admin/sidebar-mobile', $dados_comuns); 
?>

<main class="mt-5 pt-3">
    <div class="container-fluid">
      <h4 class="mb-4">Dashboard</h4>

      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h6 class="card-title text-muted">Faturamento</h6>
              <h3 class="card-text">R$ 7.560,00</h3>
              <small class="text-success"><i class="bi bi-arrow-up-right"></i> +12% este mês</small>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h6 class="card-title text-muted">Pedidos</h6>
              <h3 class="card-text">83</h3>
              <small class="text-success"><i class="bi bi-arrow-up-right"></i> +8 novos</small>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h6 class="card-title text-muted">Clientes</h6>
              <h3 class="card-text">2.132</h3>
              <small class="text-primary"><i class="bi bi-people"></i> ativos</small>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card shadow-sm border-0">
            <div class="card-body">
              <h6 class="card-title text-muted">Estoque Baixo</h6>
              <h3 class="card-text">12</h3>
              <small class="text-danger"><i class="bi bi-exclamation-circle"></i> urgente</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

<?php
$this->load->view('templates/admin/footer'); 
?>