<script>
function validarSenha(senha) {
    // Regra: mínimo 8 caracteres, 1 maiúscula, 1 minúscula, 1 número, 1 especial
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    return regex.test(senha);
}

$(document).ready(function () {
    $('#senha').on('input', function () {
        const senha = $(this).val();
        const feedback = $('#senhaFeedback');
        if (!senha) {
            feedback.html('');
            return;
        }

        if (validarSenha(senha)) {
            feedback.html('<i class="fas fa-check-circle text-success"></i> Senha forte');
        } else {
            feedback.html('<i class="fas fa-exclamation-circle text-danger"></i> A senha deve ter pelo menos 8 caracteres, incluindo letra maiúscula, minúscula, número e caractere especial.');
        }
    });

    $('#confirmar_senha, #senha').on('input', function () {
        const senha = $('#senha').val();
        const confirmar = $('#confirmar_senha').val();
        const feedback = $('#confirmaFeedback');

        if (!confirmar) {
            feedback.html('');
            return;
        }

        if (senha === confirmar) {
            feedback.html('<i class="fas fa-check-circle text-success"></i> Senhas coincidem');
        } else {
            feedback.html('<i class="fas fa-exclamation-circle text-danger"></i> As senhas não coincidem');
        }
    });

    $('#formCadastro').on('submit', function (e) {
        const senha = $('#senha').val();
        const confirmar = $('#confirmar_senha').val();

        if (!validarSenha(senha)) {
            alert('A senha não atende aos requisitos.');
            e.preventDefault();
            return;
        }

        if (senha !== confirmar) {
            alert('As senhas não coincidem.');
            e.preventDefault();
        }
    });
});
</script>