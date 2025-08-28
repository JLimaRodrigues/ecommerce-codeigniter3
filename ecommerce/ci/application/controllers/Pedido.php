<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Controller {

    public function continuar_compra()
    {
        $this->load->view('pedido/continuar-compra');
    }

    public function cadastrar_pedido()
    {
        $data_json = $this->input->post('data');
        $pedido    = json_decode($data_json, true);

        $this->load->model('PedidoModel');
        $id_pedido = $this->PedidoModel->criar([
            'id_usuario'  => $pedido['id_usuario'],
            'valor_total' => $pedido['valor_total'],
            'status'      => $pedido['status']
        ], $pedido['produtos']);

        redirect('pedido/continuar_compra');
    }

    public function selecionar_ponto_entrega()
    {
        $this->load->view('pedido/selecionar-ponto-de-entrega');
    }
}
