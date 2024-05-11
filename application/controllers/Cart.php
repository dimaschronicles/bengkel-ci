<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
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

    public function checkout()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data['title'] = 'Checkout';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        // mengambil data pada keranjang
        $this->db->select('cart.*, users.name, users.email, produk.nama_produk, produk.harga, produk.jenis,');
        $this->db->from('cart');
        $this->db->join('users', 'cart.user_id = users.id');
        $this->db->join('produk', 'cart.produk_id = produk.id');
        $this->db->where('cart.user_id', $data['user']['id']);
        $query = $this->db->get();
        $data['keranjang'] = $query->result_array();

        $total_harga = 0; // Inisialisasi total harga
        foreach ($data['keranjang'] as $item) {
            $total_harga += $item['jumlah'] * $item['harga']; // Menghitung total harga
        }
        $data['total_harga'] = $total_harga; // semua total harga barang yang akan dibeli
        $data['jumlah_barang'] = $query->num_rows();

        // validasi form
        $this->form_validation->set_rules('plat_nomor', 'Plat Nomor', 'required|trim');
        $this->form_validation->set_rules('jenis_pembayaran', 'Jenis Pembayaran', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/main_sidebar',);
            $this->load->view('templates/main_topbar', $data);
            $this->load->view('cart/checkout', $data);
            $this->load->view('templates/main_footer');
        } else {
            // buat nomor pesanan
            $no_pemesanan = 'INV-' . date('YmdHis') . '-' . mt_rand(1000, 9999);

            // mulai proses transaksi
            $this->db->trans_start();

            $dataTransaksi = [
                'no_pemesanan' => $no_pemesanan,
                'user_id' => $data['user']['id'],
                'plat_nomor' => htmlspecialchars($this->input->post('plat_nomor')),
                'keterangan' => !empty($this->input->post('keterangan')) ? htmlspecialchars($this->input->post('keterangan')) : null,
                'jenis_pembayaran' => htmlspecialchars($this->input->post('jenis_pembayaran')),
                'status' => 'dipesan',
                'total' => $total_harga,
                'tanggal_waktu' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('transaksi', $dataTransaksi);
            $transaksi_id = $this->db->insert_id(); // Ambil ID transaksi yang baru saja dimasukkan

            // Insert ke tabel transaksi_detail
            foreach ($data['keranjang'] as $item) {
                // kurangi stok pada tabel produk apabila jenisnya sparepart
                if ($item['jenis'] == 'sparepart') {
                    $this->db->set('stok', 'stok - ' . $item['jumlah'], FALSE);
                    $this->db->where('id', $item['produk_id']);
                    $this->db->update('produk');
                }

                $dataTransaksiDetail = [
                    'transaksi_id' => $transaksi_id,
                    'produk_id' => $item['produk_id'],
                    'jumlah' => $item['jumlah'],
                    'total_harga' => $item['jumlah'] * $item['harga'],
                ];
                $this->db->insert('transaksi_detail', $dataTransaksiDetail);
            }

            // Kosongkan keranjang belanja setelah berhasil checkout
            $this->db->delete('cart', ['user_id' => $data['user']['id']]);

            // selesai
            $this->db->trans_complete();

            // Redirect atau lakukan operasi lain setelah checkout sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Checkout successfully!</div>');
            redirect('cart');
        }
    }
}
