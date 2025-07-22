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
        $this->form_validation->set_rules('cpf', 'CPF', 'exact_length[11]|is_unique[usuarios.cpf]');
        $this->form_validation->set_rules('data_nascimento', 'Data de nascimento', 'callback_validar_data');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('erro', validation_errors());
            redirect('usuario/cadastro');
        } else {
          $this->load->model('UsuarioModel');

                $dados = [
                    'nome' => $this->input->post('nome'),
                    'email' => $this->input->post('email'),
                    'senha_hash' => password_hash($this->input->post('senha'), PASSWORD_DEFAULT),
                    'telefone' => $this->input->post('telefone'),
                    'cpf' => $this->input->post('cpf'),
                    'genero' => $this->input->post('genero'),
                    'data_nascimento' => $this->input->post('data_nascimento'),
                    'preferencias_json' => json_encode([]),
                    'data_ultimo_login' => NULL,
                    'is_ativo' => 1
                ];

                if (!isset($dados['id_perfil'])) {
                    $dados['id_perfil'] = 1;
                }

                if ($this->UsuarioModel->inserir($dados)) {
                    $this->session->set_flashdata('sucesso', "Cadastro realizado com sucesso. Faça o login e aproveite o site.");
                    redirect('usuario/login');
                } else {
                    $this->session->set_flashdata('erro', 'Erro ao salvar o usuário no banco de dados. Tente novamente.');
                    redirect('usuario/cadastro');
                }
        }
    }

    public function validar_data($str)
    {
        if (empty($str)) {
            $this->form_validation->set_message('validar_data', 'O campo {field} é obrigatório.');
            return FALSE;
        }

        $d = DateTime::createFromFormat('Y-m-d', $str);

        if ($d && $d->format('Y-m-d') === $str) {
            return TRUE;
        }

        $this->form_validation->set_message('validar_data', 'O campo {field} não contém uma data válida no formato DD/MM/YYYY.');
        return FALSE;
    }

    public function autenticar() 
    {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
      $this->form_validation->set_rules('senha', 'Senha', 'required');

      if ($this->form_validation->run() == FALSE) {
          $this->session->set_flashdata('erro', validation_errors());
          redirect('usuario/login');
      } else {

        $email = $this->input->post('email');
        $senha = $this->input->post('senha');

        $this->load->model('UsuarioModel');

        $usuario = $this->UsuarioModel->login($email, $senha);

        if ($usuario) {
            $this->session->set_userdata('usuario_logado', [
                'id'     => $usuario->id_usuario,
                'nome'   => $usuario->nome,
                'email'  => $usuario->email,
                'perfil' => encriptar($usuario->id_perfil),
                'logado' => TRUE
            ]);

            $ip_address = $this->input->ip_address();
            $user_agent = $this->input->user_agent();
            $this->UsuarioModel->registrarLogin($usuario->id_usuario, $ip_address, $user_agent);

            redirect('home');
        } else {
            $this->session->set_flashdata('erro', 'Email ou senha inválidos.');
            redirect('usuario/login');
        }

      }

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
      $this->session->set_flashdata('sucesso', 'Você foi desconectado com sucesso.');
      redirect('usuario/login');
  }

  public function perfil() 
  {}

  public function cupons() 
  {}
}
