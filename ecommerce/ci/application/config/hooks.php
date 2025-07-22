<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
    'class'    => '',
    'function' => 'checar_permissao',
    'filename' => 'PermissaoHook.php',
    'filepath' => 'hooks'
);