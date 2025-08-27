<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdutoModel extends CI_Model
{
    protected $tabela = 'produtos';

    public function listarTodos()
    {
        return $this->db->get($this->tabela)->result();
    }

    public function pedidos($id_produto)
    {
        $this->db->select('pedidos.*, pedido_produtos.quantidade, pedido_produtos.preco_unitario');
        $this->db->from('pedidos');
        $this->db->join('pedido_produtos', 'pedido_produtos.id_produto = pedidos.id_produto');
        $this->db->where('pedido_produtos.id_produto', $id_produto);

        return $this->db->get()->result();
    }
}