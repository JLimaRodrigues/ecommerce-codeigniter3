<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>


<section class="py-5">
    <div class="container px-4 px-lg-5">
        <div class="row">
            <div class="col-md-8">
                <h5 class="mb-4">Confira a forma de entrega</h5>

                <div class="card mb-3">
                    <?php if($endereco): ?>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="entrega" id="entregaEndereco" checked>
                                <label class="form-check-label fw-bold" for="entregaEndereco">
                                    Enviar no meu endereço <span class="text-success">Grátis</span>
                                </label>
                            </div>
                            <p class="mb-0 mt-2">
                                Rua Alguma coisa nº 1 - Bairro, Cidade - CEP Nº CEP
                                <br>
                                <small class="text-muted">Residencial</small>
                            </p>
                            <a href="#" class="link-primary small mt-2 d-block">Alterar ou escolher outro endereço</a>
                        </div>

                    <?php else: ?>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="entrega" id="entregaEndereco" checked>
                                <label class="form-check-label fw-bold" for="entregaEndereco">
                                    Enviar no meu endereço <span class="text-success">Grátis</span>
                                </label>
                            </div>
                            <a href="#" class="link-primary small mt-2 d-block">Adicionar um endereço</a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="entrega" id="retiradaAgencia">
                            <label class="form-check-label fw-bold" for="retiradaAgencia">
                                Retirada em Alguma Agência do Ecommerce <span class="text-dark">R$ 11,99</span>
                            </label>
                        </div>
                        <p class="mb-0 mt-2">
                            SELECIONE UMA AGÊNCIA PARA RETIRADA
                            <br>
                            <small class="text-muted">Segunda à sábado das 9 à 18:30 hs.</small>
                        </p>
                        <a href="<?= base_url('pedido/selecionar_ponto_entrega') ?>" class="link-primary small mt-2 d-block">Ver agência no mapa ou selecionar outra</a>
                    </div>
                </div>

                <button class="btn btn-primary">Continuar</button>
            </div>

            <div class="col-md-4">
                <div class="card p-3">
                    <h6 class="fw-bold">Resumo da compra</h6>
                    <div class="d-flex justify-content-between">
                        <span>Produto</span>
                        <span>R$ 0,00</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Frete</span>
                        <span class="text-success fw-bold">GRÁTIS</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>R$ 0,00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
