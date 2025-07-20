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
                <div class="list-group list-group-flush">
                    <!-- Produto 1 -->
                    <div class="list-group-item d-flex align-items-start">
                    <input class="form-check-input me-3 mt-2" type="checkbox" checked>
                    <img src="https://dummyimage.com/80x80/dee2e6/6c757d" class="me-3" alt="Produto" style="width: 80px; height: 80px; object-fit: cover;">
                    <div class="flex-grow-1">
                        <div class="fw-bold">Nome do Produto</div>
                        <a href="#" class="text-danger small">Excluir</a>
                        <div class="mt-2 d-flex align-items-center">
                        <button class="btn btn-outline-secondary btn-sm">-</button>
                        <span class="mx-2">1</span>
                        <button class="btn btn-outline-secondary btn-sm">+</button>
                        <span class="text-muted ms-3 small">+10 disponíveis</span>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="text-success small">-35% <span class="text-muted text-decoration-line-through">R$ 119,90</span></div>
                        <div class="fw-bold fs-6">R$ 77,93</div>
                    </div>
                    </div>

                    <!-- Duplicar o bloco acima para cada item -->

                </div>
                </div>
            </div>

            <!-- Coluna do Resumo -->
            <div class="col-lg-4">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resumo da compra</h5>
                    <ul class="list-unstyled mb-3">
                    <li class="d-flex justify-content-between"><span>Produtos (5)</span><span><del class="text-muted small">R$ 2.123,00</del> <strong>R$ 2.122,77</strong></span></li>
                    <li class="d-flex justify-content-between"><span>Fretes (3)</span><span>R$ 39,90</span></li>
                    <li><a href="#" class="text-primary small">Cupons (1 para aplicar)</a></li>
                    </ul>
                    <div class="d-flex justify-content-between border-top pt-2 mb-3">
                    <strong>Total</strong>
                    <strong class="fs-5">R$ 2.162,69</strong>
                    </div>
                    <button class="btn btn-primary w-100">Continuar a compra</button>
                </div>
                </div>
            </div>

            </div>
        </div>
        </section>

<?php
$this->load->view('templates/footer'); 
?>