<?php
$usuario = $this->session->userdata('usuario_logado');
$usuarioDecriptado = isset($usuario['perfil']) ? decriptar($usuario['perfil']) : 0;

$dados_comuns = [
  'usuario'           => $usuario,
  'usuarioDecriptado' => $usuarioDecriptado,
  'telaAtiva'         => 'relatorios'
];

$this->load->view('templates/admin/header', $dados_comuns);
$this->load->view('templates/admin/sidebar', $dados_comuns); 
$this->load->view('templates/admin/navbar', $dados_comuns); 
$this->load->view('templates/admin/sidebar-mobile', $dados_comuns); 
?>

<main class="mt-5 pt-3">
    <div class="container-fluid">
    <div class="content-wrapper">
        <div class="content-header">
          <h3 class="content-header-title">
            <i class="bi bi-bar-chart-line"></i> Relatórios
          </h3>
        </div>
        <div class="content-body">
          <section class="card rounded-0 my-4">
            <div class="card-header">
              <h4>Lista de relatórios</h4>
              <p class="card-text sm">lista de relatórios do ecommerce.</p>
            </div>
            <div class="card-body">
              <table id="tabela-relatorios" class="display">
              <thead>
                <tr>
                  <th>relatorio</th>
                  <th>data</th>
                </tr>
              </thead>
              </table>
            </div>
          </section>
        </div>
      </div>
    </div>
  </main>

<?php
$this->load->view('templates/admin/footer'); 
?>