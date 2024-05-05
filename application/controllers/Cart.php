<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // 
    }

    public function index()
    {
        $data['title'] = 'Keranjang';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('cart.*, users.name, users.email, produk.nama_produk, produk.harga, produk.jenis,');
        $this->db->from('cart');
        $this->db->join('users', 'cart.user_id = users.id');
        $this->db->join('produk', 'cart.produk_id = produk.id');
        $this->db->where('cart.user_id', $data['user']['id']);
        $data['keranjang'] = $this->db->get()->result_array();

        $total_harga = 0; // Inisialisasi total harga
        foreach ($data['keranjang'] as $item) {
            $total_harga += $item['jumlah'] * $item['harga']; // Menghitung total harga
        }
        $data['total_harga'] = $total_harga; // Simpan total harga ke dalam data

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/main_sidebar',);
        $this->load->view('templates/main_topbar', $data);
        $this->load->view('cart/index', $data);
        $this->load->view('templates/main_footer');
    }

    public function store($id)
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $produk = $this->db->get_where('produk', ['id' => $id])->row_array();

        $data = [
            'user_id' => $user['id'],
            'produk_id' => $produk['id'],
            'jumlah' => 1,
        ];

        $this->db->insert('cart', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Cart created successfully!</div>');
        redirect('produk/list');
    }

    public function increase($id)
    {
        $cart = $this->db->get_where('cart', ['id' => $id])->row_array();

        $data = [
            'jumlah' => $cart['jumlah'] + 1,
        ];

        $this->db->where('id', $id);
        $this->db->update('cart', $data);
        redirect('cart');
    }

    public function decrease($id)
    {
        $cart = $this->db->get_where('cart', ['id' => $id])->row_array();

        $data = [
            'jumlah' => $cart['jumlah'] - 1,
        ];

        $this->db->where('id', $id);
        $this->db->update('cart', $data);
        redirect('cart');
    }

    public function delete($id)
    {
        $cart = $this->db->get_where('cart', ['id' => $id])->row_array();

        $this->db->where('id', $id);
        $this->db->delete('cart');

        redirect('cart');
    }
}
