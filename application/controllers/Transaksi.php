<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    /**
     * Administrator Method
     */
    public function index()
    {
        $data['title'] = 'Transaksi';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        if ($data['user']['role_id'] == 1) { // Jika user adalah admin atau memiliki role 1
            $this->db->select('transaksi.*, users.name, users.email, montir.nama_montir, montir.no_hp_montir, montir.alamat_montir');
            $this->db->from('transaksi');
            $this->db->join('montir', 'transaksi.montir_id = montir.id', 'left');
            $this->db->join('users', 'transaksi.user_id = users.id');
            $this->db->order_by('created_at', 'DESC');
            $data['transaksi'] = $this->db->get()->result_array();
        } else { // Jika user bukan admin atau memiliki role 1
            $this->db->select('transaksi.*, users.name, users.email, montir.nama_montir, montir.no_hp_montir, montir.alamat_montir');
            $this->db->from('transaksi');
            $this->db->join('montir', 'transaksi.montir_id = montir.id', 'left');
            $this->db->join('users', 'transaksi.user_id = users.id');
            $this->db->order_by('created_at', 'DESC');
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
        $data['title'] = 'Transaksi Proses';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['transaksi'] = $this->db->get_where('transaksi', ['id' => $id])->row_array();

        $this->db->select('transaksi_detail.*, produk.nama_produk, produk.harga, produk.jenis');
        $this->db->from('transaksi_detail');
        $this->db->join('produk', 'transaksi_detail.produk_id = produk.id');
        $this->db->where('transaksi_detail.transaksi_id', $data['transaksi']['id']);
        $data['transaksiDetail'] = $this->db->get()->result_array();

        $data['montir'] = $this->db->get('montir')->result_array();
        $data['transaksiId'] = $id;

        $this->form_validation->set_rules('montir_id', 'Montir', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/main_sidebar');
            $this->load->view('templates/main_topbar', $data);
            $this->load->view('transaksi/proses', $data);
            $this->load->view('templates/main_footer');
        } else {
            // Update transaksi table
            $update_data = [
                'montir_id' => htmlspecialchars($this->input->post('montir_id')),
                'status' => 'diproses',
            ];

            $this->db->where('id', $id);
            $this->db->update('transaksi', $update_data);

            // Calculate new total including jasa
            $total_harga_jasa = 0;

            // Update transaksi_detail table
            foreach ($data['transaksiDetail'] as $td) {
                if ($td['jenis'] == 'jasa') {
                    $input_name = 'total_harga_' . $td['id'];
                    $total_harga = htmlspecialchars($this->input->post($input_name));

                    $update_detail_data = [
                        'total_harga' => $total_harga
                    ];

                    $this->db->where('id', $td['id']);
                    $this->db->update('transaksi_detail', $update_detail_data);

                    // Accumulate total jasa
                    $total_harga_jasa += $total_harga;
                }
            }

            // Update the total column in transaksi table
            $new_total = $data['transaksi']['total'] + $total_harga_jasa;

            $this->db->where('id', $id);
            $this->db->update('transaksi', ['total' => $new_total]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data updated successfully!</div>');
            redirect('transaksi');
        }
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
        $this->db->select('transaksi.*, users.name, users.email, users.no_hp, users.alamat, montir.nama_montir, montir.no_hp_montir, montir.alamat_montir');
        $this->db->from('transaksi');
        $this->db->join('montir', 'transaksi.montir_id = montir.id', 'left');
        $this->db->join('users', 'transaksi.user_id = users.id');
        $this->db->where('transaksi.id', $id);
        $data['transaksi'] = $this->db->get()->row_array();

        $this->load->view('transaksi/nota', $data);
    }

    /**
     * copy kode ini $data['transaksiId'] = $id; pada function proses letakan diatas title
     * -----------------------------------
     * Tambahkan kode dibawah ini kemudian buat file baru dengan nama add_produk.php pada folder views/transaksi/
     * copy kan isinya sesuaikan
     */
    public function addProduk($id)
    {
        $data['title'] = 'Tambah Produk';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['produk'] = $this->db->get('produk')->result_array();
        $data['transaksi'] = $this->db->get_where('transaksi', ['id' => $id])->row_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/main_sidebar',);
        $this->load->view('templates/main_topbar', $data);
        $this->load->view('transaksi/add_produk', $data);
        $this->load->view('templates/main_footer');
    }

    public function storeProduk($produkId, $transaksiId)
    {
        // Ambil data produk berdasarkan produkId
        $produk = $this->db->get_where('produk', ['id' => $produkId])->row_array();

        if ($produk) {
            // insert ke transaksi detail sesuai transaksi id
            $data = [
                'transaksi_id' => $transaksiId,
                'produk_id' => $produkId,
                'jumlah' => 1,
                'total_harga' => $produk['harga'],
            ];
            $this->db->insert('transaksi_detail', $data);

            // Kurangi stok produk
            $stokBaru = $produk['stok'] - 1;
            if ($stokBaru < 0) {
                $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Stok produk tidak mencukupi!</div>');
                redirect('transaksi/proses/' . $transaksiId);
            }

            $this->db->where('id', $produkId);
            $this->db->update('produk', ['stok' => $stokBaru]);

            // Ambil total saat ini dari transaksi
            $transaksi = $this->db->get_where('transaksi', ['id' => $transaksiId])->row_array();

            if ($transaksi) {
                // Hitung total baru
                $totalBaru = $transaksi['total'] + $produk['harga'];

                // Update tabel transaksi dengan total yang baru
                $this->db->where('id', $transaksiId);
                $this->db->update('transaksi', ['total' => $totalBaru]);
            } else {
                // Jika transaksi tidak ditemukan, beri pesan error atau redirect
                $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Transaksi tidak ditemukan!</div>');
                redirect('transaksi');
            }
        } else {
            // Jika produk tidak ditemukan, beri pesan error atau redirect
            $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Produk tidak ditemukan!</div>');
            redirect('transaksi');
        }

        // Redirect ke halaman transaksi detail
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data updated successfully!</div>');
        redirect('transaksi/proses/' . $transaksiId);
    }
}
