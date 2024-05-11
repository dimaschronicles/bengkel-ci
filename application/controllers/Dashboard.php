<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['produk'] = $this->db->limit(10)->get('produk')->result_array();
        $data['transaksi_diproses'] = $this->db->get_where('transaksi', ['status' => 'diproses'])->num_rows();
        $data['transaksi_selesai'] = $this->db->get_where('transaksi', ['status' => 'selesai'])->num_rows();
        $data['customer'] = $this->db->get_where('users', ['role_id' => '2'])->num_rows();
        $data['jumlah_produk_layanan'] = $this->db->get('produk')->num_rows();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/main_sidebar',);
        $this->load->view('templates/main_topbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/main_footer');
    }
}
