<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produto extends CI_Controller {

    public function listar() 
    {
        $this->load->model('ProdutoModel');
        $produtos = $this->ProdutoModel->listarTodos();

        foreach ($produtos as &$produto) {
            $produto->id_produto = encriptar($produto->id_produto);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($produtos));
    }
}
