<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdutoModel extends CI_Model
{

    public function listarTodos()
    {
        return $this->db->get('produtos')->result();
    }
}