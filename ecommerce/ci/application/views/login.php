<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Section-->
<section class="py-5">
    <div class="container mt-5" style="max-width: 500px;">
        <h3 class="mb-4 text-center">Entrar na sua conta</h3>
        <form method="post" action="<?= base_url('usuario/autenticar') ?>">
            <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Entrar</button>
            <p class="text-center mt-3">Não tem conta? <a href="<?= base_url('usuario/cadastro') ?>">Cadastre-se</a></p>
        </form>
    </div>
</section>

<?php
$this->load->view('templates/footer'); 
?>