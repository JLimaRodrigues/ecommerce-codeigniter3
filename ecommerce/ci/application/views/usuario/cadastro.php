<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h2>Cadastro de Usuário</h2>

        <?php $this->load->view('resultado'); ?>

        <form method="post" action="<?= base_url('usuario/salvar') ?>" id="formCadastro" autocomplete="off">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Telefone</label>
                <input type="text" name="telefone" class="form-control" maxlength="20" onkeypress="return somenteNumero(event);">
            </div>

            <div class="form-group">
                <label>CPF</label>
                <input type="text" name="cpf" class="form-control" maxlength="11" onkeypress="return somenteNumero(event);">
            </div>

            <div class="form-group">
                <label>Gênero</label>
                <select name="genero" class="form-control">
                    <option value="nao_informado">Prefiro não informar</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </div>

            <div class="form-group">
                <label>Data de nascimento</label>
                <input type="date" name="data_nascimento" class="form-control">
            </div>

            <div class="form-group position-relative">
                <label>Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" required>
                <small id="senhaFeedback" class="form-text text-muted"></small>
            </div>

            <div class="form-group position-relative">
                <label>Confirmar Senha</label>
                <input type="password" name="confirmar_senha" id="confirmar_senha" class="form-control" required>
                <small id="confirmaFeedback" class="form-text text-muted"></small>
            </div>

            <button type="submit" class="btn btn-primary m-3">Cadastrar</button>
        </form>
    </div>
</section>

<?php
$scripts = $this->load->view('scripts/cadastro', [], true);
$this->load->view('templates/footer', compact('scripts')); 
?>