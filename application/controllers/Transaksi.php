<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
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
        $data['title'] = 'Transaksi';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        if ($data['user']['role_id'] == 1) { // Jika user adalah admin atau memiliki role 1
            $this->db->select('transaksi.*, users.name, users.email');
            $this->db->from('transaksi');
            $this->db->join('users', 'transaksi.user_id = users.id');
            $data['transaksi'] = $this->db->get()->result_array();
        } else { // Jika user bukan admin atau memiliki role 1
            $this->db->select('transaksi.*, users.name, users.email');
            $this->db->from('transaksi');
            $this->db->join('users', 'transaksi.user_id = users.id');
            $this->db->where('transaksi.user_id', $data['user']['id']);
            $data['transaksi'] = $this->db->get()->result_array();
        }

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/main_sidebar',);
        $this->load->view('templates/main_topbar', $data);
        $this->load->view('transaksi/index', $data);
        $this->load->view('templates/main_footer');
    }

    public function proses($id)
    {
        $transaksi = $this->db->get_where('transaksi', ['id' => $id])->row_array();

        $data = [
            'status' => 'diproses',
        ];

        $this->db->where('id', $id);
        $this->db->update('transaksi', $data);
        redirect('transaksi');
    }

    public function selesai($id)
    {
        $transaksi = $this->db->get_where('transaksi', ['id' => $id])->row_array();

        $data = [
            'status' => 'selesai',
        ];

        $this->db->where('id', $id);
        $this->db->update('transaksi', $data);
        redirect('transaksi');
    }

    public function nota($id)
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('transaksi.*, users.name, users.email');
        $this->db->from('transaksi');
        $this->db->join('users', 'transaksi.user_id = users.id');
        $this->db->where('transaksi.user_id', $data['user']['id']);
        $this->db->where('transaksi.id', $id);
        $data['transaksi'] = $this->db->get()->row_array();

        $this->load->view('transaksi/nota', $data);
    }
}
