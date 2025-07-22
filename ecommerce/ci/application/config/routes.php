<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['home']               = 'home/index';
$route['carrinho']           = 'home/carrinho';
$route['login']              = 'usuario/login';
$route['logout']             = 'usuario/logout';

// rotas de usuario
$route['usuario/cadastro']           = 'usuario/cadastro';
$route['usuario/salvar']['POST']     = 'usuario/salvar';
$route['usuario/autenticar']['POST'] = 'usuario/autenticar';

//rotas de administração
$route['admin/dashboard']  = 'admin/index';
$route['admin/produtos']   = 'admin/produtos';
$route['admin/pedidos']    = 'admin/pedidos';
$route['admin/usuarios']   = 'admin/usuarios';
$route['admin/relatorios'] = 'admin/relatorios';
$route['admin/logs']       = 'admin/logs';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
