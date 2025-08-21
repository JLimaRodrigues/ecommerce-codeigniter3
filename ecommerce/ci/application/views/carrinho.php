<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Compre seu estilo</h1>
            <p class="lead fw-normal text-white-50 mb-0">Um ecommerce moderno</p>
        </div>
    </div>
</header>

        <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row">

            <!-- Coluna da Lista de Produtos -->
            <div class="col-lg-8">
                <div class="mb-3">
                <input class="form-check-input me-2" type="checkbox" id="selectAll">
                <label class="form-check-label" for="selectAll">Todos os produtos</label>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-white fw-bold">
                        Produtos <span class="text-success">&#9889; FULL</span>
                    </div>
                    <div id="listaDeProdutosCarrinho" class="list-group list-group-flush"></div>
                </div>
            </div>

            <!-- Coluna do Resumo -->
            <div class="col-lg-4">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resumo da compra</h5>
                    <ul class="list-unstyled mb-3">
                    <li class="d-flex justify-content-between"><span>Produtos <b><span id="total-itens-selecionados"></span></b><span>
                        <del class="text-muted small" id="original-total-display">R$ 0,00</del> 
                        <strong id="subtotal-display">R$ 0,00</strong></span></li>
                    <li><a href="#" class="text-primary small">Cupons (1 para aplicar)</a></li>
                    </ul>
                    <div class="d-flex justify-content-between border-top pt-2 mb-3">
                    <strong>Total</strong>
                    <strong id="total-display" class="fs-5">R$ 0,00</strong>
                    </div>
                    <button id="continuar-compra" class="btn btn-primary w-100">Continuar a compra</button>
                </div>
                </div>
            </div>

            </div>
        </div>
        </section>

<?php
$scripts = $this->load->view('scripts/carrinho', [], true);
$this->load->view('templates/footer', compact('scripts')); 
?>