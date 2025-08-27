<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CarrinhoModel extends CI_Model
{
    protected $tabela = 'carrinho';
    protected $carrinho_itens = 'carrinho_itens';

    public function criar($idUsuario, $idSession, $produtos)
    {
        $carrinho = $this->db->where('id_usuario', $idUsuario)
                ->or_where('session_id', $idSession)
                ->order_by('criado_em', 'DESC')
                ->get($this->tabela)->row_array();

        if (!$carrinho) {
            $this->db->insert($this->tabela, [
                'id_usuario' => $idUsuario,
                'session_id' => $idSession
            ]);
            $carrinho_id = $this->db->insert_id();
        } else {
            $carrinho_id = $carrinho['id_carrinho'];
        }

        $this->db->where('id_carrinho', $carrinho_id)->delete($this->carrinho_itens);

        foreach ($produtos as $produto) {
            $this->db->insert($this->carrinho_itens, [
                'id_carrinho' => $carrinho_id,
                'id_produto'  => $produto['id_produto'],
                'variacao'    => $produto['variacao'] ?? null,
                'quantidade'  => $produto['quantidade']
            ]);
        }

        return $carrinho_id;
    }

    public function produtos($id_carrinho)
    {
        $this->db->select('carrinho_itens.*, produtos.nome_produto, produtos.preco');
        $this->db->from('carrinho_itens');
        $this->db->join('produtos', 'produtos.id_produto = carrinho_itens.id_produto');
        $this->db->where('carrinho_itens.id_carrinho', $id_carrinho);

        return $this->db->get()->result();
    }

    public function retornarComProdutos($id_carrinho)
    {
        $pedido = $this->db->get_where($this->tabela, ['id_carrinho' => $id_carrinho])->row();

        if($pedido){
            $pedido->produtos = $this->produtos($id_carrinho);
        }

        return $pedido;
    }

    public function listarCarrinhoDoUsuario($id_usuario)
    {
        $carrinho = $this->db->get_where($this->tabela, ['id_usuario' => $id_usuario])->row();

        if($carrinho){
            $carrinho->produtos = $this->produtos($carrinho['id_carrinho']);
        }

        return $carrinho;
    }

    public function registrarCarrinhoUsuario($id_usuario, $id_carrinho)
    {
        return $this->db->where('id_carrinho', $id_carrinho)->update($this->tabela, ['id_usuario' => $id_usuario]);
    }
}