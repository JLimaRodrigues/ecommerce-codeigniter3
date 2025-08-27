<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrinho extends CI_Controller {

    public function salvar_carrinho()
    {
        $json_data = $this->input->raw_input_stream;
        $carrinho  = json_decode($json_data, true);

        if(!$carrinho || empty($carrinho['produtos'])){
            $erro = array(
                'status' => 400,
                'mensagem' => 'Carrinho vazio.'
            );

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($erro));
        }

        $idUsuario  = $carrinho['id_usuario'] ?? null;
        $session_id = random_int(1000000000, 9999999999);

        $produtos = [];
        foreach ($carrinho['produtos'] as $produto){
            $produtos[] = [
                'id_produto'   => decriptar($produto['id_produto']),
                'nome_produto' => $produto['nome_produto'],
                'preco'        => $produto['preco'],
                'quantidade'   => $produto['quantidade']
            ];
        }

        $this->load->model('CarrinhoModel');
        $idCarrinho = $this->CarrinhoModel->criar($idUsuario, $session_id, $produtos);

        $sucesso = array(
            'status' => 200,
            'id_carrinho' => encriptar($idCarrinho)
        );

        $this->session->set_userdata('id_carrinho', encriptar($idCarrinho));

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($sucesso));
    }
}
