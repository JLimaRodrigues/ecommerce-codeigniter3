<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function login() 
    {
        $this->load->view('login');
    }

    public function cadastro() 
    {
        $this->load->view('usuario/cadastro');
    }

    public function salvar()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]');
        $this->form_validation->set_rules('cpf', 'CPF', 'exact_length[14]|is_unique[usuarios.cpf]');
        $this->form_validation->set_rules('data_nascimento', 'Data de nascimento', 'callback_validar_data');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('erro', validation_errors());
            redirect('usuario/cadastro');
        }

        // $this->load->model('Usuario_model');

        // $dados = [
        //     'nome' => $this->input->post('nome'),
        //     'email' => $this->input->post('email'),
        //     'senha_hash' => password_hash($this->input->post('senha'), PASSWORD_DEFAULT),
        //     'telefone' => $this->input->post('telefone'),
        //     'cpf' => $this->input->post('cpf'),
        //     'genero' => $this->input->post('genero'),
        //     'data_nascimento' => $this->input->post('data_nascimento'),
        //     'preferencias_json' => json_encode([]),
        //     'data_ultimo_login' => NULL,
        //     'is_ativo' => 1
        // ];
    }

    public function autenticar() 
    {
    $email = $this->input->post('email');
    $senha = $this->input->post('senha');

    $this->load->model('Usuario_model');
    $usuario = $this->Usuario_model->login($email, $senha);

    if ($usuario) {
      $this->session->set_userdata('usuario_logado', [
          'id' => $usuario->id,
          'nome' => $usuario->nome,
          'email' => $usuario->email
      ]);
      redirect('home');
    } else {
      $this->session->set_flashdata('erro', 'Email ou senha inválidos');
      redirect('usuario/login');
    }
  }

  public function logout() {
    $this->session->unset_userdata('usuario_logado');
    redirect('usuario/login');
  }

  public function perfil() {
    // Aqui você pode mostrar dados do usuário logado
  }

  public function cupons() {
    // Listagem de cupons disponíveis
  }
}
