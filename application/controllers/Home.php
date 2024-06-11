<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['sparepart'] = $this->db->get_where('produk', ['jenis' => 'sparepart'])->result_array();

        $this->load->view('home/index', $data);
    }
}
