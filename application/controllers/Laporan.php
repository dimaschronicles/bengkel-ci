<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // 
    }

    /**
     * Administrator Method
     */
    public function index()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_selesai = $this->input->get('tanggal_selesai');

        if (empty($tanggal_mulai) && empty($tanggal_selesai)) {
            $data['transaksi'] = '';
        } else {
            $this->db->select('transaksi.*, users.name, users.email');
            $this->db->from('transaksi');
            $this->db->join('users', 'transaksi.user_id = users.id');
            // Filter berdasarkan rentang tanggal_waktu
            $this->db->where('tanggal_waktu >=', $tanggal_mulai);
            $this->db->where('tanggal_waktu <=', $tanggal_selesai);
            $data['transaksi'] = $this->db->get()->result_array();
        }

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/main_sidebar',);
        $this->load->view('templates/main_topbar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/main_footer');
    }
}
