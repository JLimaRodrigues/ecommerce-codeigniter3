<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index() {
        $this->load->view('admin/dashboard');
    }

    public function pedidos() {
        $this->load->view('admin/pedidos');
    }

    public function produtos() {
        $this->load->view('admin/produtos');
    }

    public function relatorios() {
        $this->load->view('admin/relatorios');
    }

    public function usuarios() {
        $this->load->view('admin/usuarios');
    }
}
