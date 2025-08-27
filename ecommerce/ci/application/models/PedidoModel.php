<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PedidoModel extends CI_Model
{
    protected $tabela = 'pedidos';
    protected $historico_status = 'historico_status';

    public function criar($data, $produtos = [])
    {
        $this->db->insert($this->tabela, $data);
        $idPedido = $this->db->insert_id();

        if(!empty($produtos)){
            foreach ($produtos as $produto){
                $this->db->insert('pedido_produtos', [
                    'id_pedido'      => $idPedido,
                    'id_produto'     => decriptar($produto['id_produto']),
                    'variacao'       => isset($produto['variacao']) ? $produto['variacao'] : null,
                    'quantidade'     => $produto['quantidade'],
                    'preco_unitario' => $produto['preco'],
                ]);
            }
        }

        $this->db->insert($this->historico_status, [
                'id_pedido' => $idPedido,
                'status'    => $data['status']
        ]);

        return $idPedido;
    }

    public function produtos($id_pedido)
    {
        $this->db->select('pedido_produtos.*, produtos.nome_produto, produtos.preco');
        $this->db->from('pedido_produtos');
        $this->db->join('produtos', 'produtos.id_produto = pedido_produtos.id_produto');
        $this->db->where('pedido_produtos.id_pedido', $id_pedido);

        return $this->db->get()->result();
    }

    public function retornarComProdutos($id_pedido)
    {
        $pedido = $this->db->get_where($this->tabela, ['id_pedido' => $id_pedido])->row();

        if($pedido){
            $pedido->produtos = $this->produtos($id_pedido);
        }

        return $pedido;
    }
}