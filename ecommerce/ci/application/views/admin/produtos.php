<?php
$usuario = $this->session->userdata('usuario_logado');
$usuarioDecriptado = isset($usuario['perfil']) ? decriptar($usuario['perfil']) : 0;

$dados_comuns = [
  'usuario'           => $usuario,
  'usuarioDecriptado' => $usuarioDecriptado,
  'telaAtiva'         => 'produtos'
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
            <i class="bi bi-box-seam"></i> Produtos
          </h3>
        </div>
        <div class="content-body">
          <section class="card rounded-0 my-4">
            <div class="card-header">
              <h4>Lista de Produtos</h4>
              <p class="card-text sm">lista de produtos do ecommerce.</p>
            </div>
            <div class="card-body">
              <table id="tabela-produtos" class="display">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Preço</th>
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