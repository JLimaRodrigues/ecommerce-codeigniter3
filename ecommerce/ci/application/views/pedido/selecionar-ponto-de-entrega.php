<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>


<section class="py-5">
    <div class="container px-4 px-lg-5">
        <a class="btn btn-primary" href="<?= base_url('pedido/continuar_compra') ?>">Voltar</a>
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-12 p-4">
                <h2 class="mb-3">Selecione um ponto de retirada</h2>
                
                <div class="alert alert-light border-0" role="alert" style="background-color: #f8f9fa;">
                    <p class="mb-0 text-muted">A agência deve estar localizada no mesmo estado do seu endereço de faturamento.</p>
                </div>
                
                <div class="my-4 search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" class="form-control" placeholder="Busque uma localização">
                </div>

            </div>
            
            <div class="col-lg-7 col-md-6 col-sm-12 p-0">
                <div class="w-100 h-100 d-flex justify-content-center align-items-center text-white" style="min-height: 600px;">
                    <div class="col-lg-7 col-md-6 col-sm-12 p-0">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$scripts = $this->load->view('scripts/selecionar-ponto-entrega', [], true);
$this->load->view('templates/footer', compact('scripts')); 
?>