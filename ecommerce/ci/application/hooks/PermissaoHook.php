<?php

function checar_permissao() {
    $CI =& get_instance();

    $rota_atual = strtolower($CI->router->class . '/' . $CI->router->method);

    $rotas_livres = [
        'home/index',
        'carrinho/index',
        'usuario/login',
        'usuario/logout',
        'usuario/cadastro',
        'usuario/salvar',
        'usuario/autenticar',
        'produto/listar',
        'carrinho/salvar_carrinho'
    ];

    if (in_array($rota_atual, $rotas_livres)) {
        return;
    }

    $usuario = $CI->session->userdata('usuario_logado');
    if (!$usuario || !isset($usuario['logado']) || !$usuario['logado']) {
        $CI->session->set_flashdata('erro', "Você precisa estar logado para acessar essa parte do sistema.");
        redirect('usuario/login');
    }

    // 1 - usuario, 2 - vendedor, 3 - admin, 4 - superadmin
    $perfis_autorizados = [
        'admin/index'   => [3, 4],
        'produto/cadastrar' => [2, 3, 4]
    ];

    if (isset($perfis_autorizados[$rota_atual])) {
        $usuario_perfil = (int) decriptar($usuario['perfil']);

        if (!in_array($usuario_perfil, $perfis_autorizados[$rota_atual])) {
            show_error('Você não tem permissão para acessar esta funcionalidade.', 403);
        }
    }
}
