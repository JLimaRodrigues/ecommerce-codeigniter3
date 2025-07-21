<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function listar()
    {
        return $this->db->get('usuarios')->result();
    }

    public function inserir(array $dados): bool
    {
        return $this->db->insert('usuarios', $dados);
    }

    public function atualizar(array $dados): bool
    {
        $this->db->update('usuarios', $dados, array('id_usuario' => $dados['id_usuario']));
        return $this->db->affected_rows() > 0;
    }

    public function login(string $email, string $senha)
    {
        $this->db->where('email', $email);
        $query   = $this->db->get('usuarios');
        $usuario = $query->row();

        if ($usuario) {
            if (password_verify($senha, $usuario->senha_hash)) {
                return $usuario;
            }
        }
        return FALSE;
    }

    public function registrarLogin(int $id_usuario, string $ip, string $user_agent): bool
    {
        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usuarios', ['data_ultimo_login' => date('Y-m-d H:i:s')]);

        $atualizado = ($this->db->affected_rows() > 0);

        $log_data = [
            'id_usuario' => $id_usuario,
            'ip'         => $ip,
            'user_agent' => $user_agent,
            'data_hora'  => date('Y-m-d H:i:s')
        ];
        $log = $this->db->insert('log_acesso', $log_data);

        return $atualizado && $log;
    }
}