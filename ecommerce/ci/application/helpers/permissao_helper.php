<?php 

function usuario_logado() 
{
    $CI =& get_instance();
    $usuario = $CI->session->userdata('usuario_logado');
    return isset($usuario['logado']) && $usuario['logado'] === TRUE;
}

function tem_perfil($perfis) 
{
    $CI =& get_instance();
    $usuario = $CI->session->userdata('usuario_logado');
    if (!isset($usuario['perfil'])) {
        return FALSE;
    }

    $perfil_id = (int) decriptar($usuario['perfil']);
    return in_array($perfil_id, $perfis);
}