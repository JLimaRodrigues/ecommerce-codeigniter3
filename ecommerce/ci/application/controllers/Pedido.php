<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Controller {

    public function continuar_compra()
    {
        $data_json = $this->input->post('data');

        $carrinho = json_decode($data_json, true);

        echo "<pre>";
        var_dump($carrinho);
        echo "</pre>";

        redirect('confirmar-compra'); 
    }
}
