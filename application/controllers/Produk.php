<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
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
        $data['title'] = 'Produk';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['produk'] = $this->db->get('produk')->result_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/main_sidebar',);
        $this->load->view('templates/main_topbar', $data);
        $this->load->view('produk/index', $data);
        $this->load->view('templates/main_footer');
    }

    public function create()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'trim|numeric');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah Produk';
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/main_sidebar',);
            $this->load->view('templates/main_topbar', $data);
            $this->load->view('produk/create', $data);
            $this->load->view('templates/main_footer');
        } else {
            // Jika ada file yang diunggah
            if (!empty($_FILES['foto']['name'])) {
                $config['upload_path'] = './assets/upload/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = 'produk_' . time(); // Penamaan file gambar
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    // Jika upload gagal
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
                    redirect('produk/create');
                } else {
                    // Jika upload berhasil
                    $upload_data = $this->upload->data();
                    $foto = $upload_data['file_name'];
                }
            } else {
                $foto = null; // Foto diatur menjadi null jika tidak ada file yang diunggah
            }

            $data = [
                'nama_produk' => htmlspecialchars($this->input->post('nama_produk')),
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi')),
                'jenis' => htmlspecialchars($this->input->post('jenis')),
                'stok' => $this->input->post('stok') != '' ? htmlspecialchars($this->input->post('stok')) : null,
                'harga' => htmlspecialchars($this->input->post('harga')),
                'foto' => $foto, // Nama file gambar disimpan ke database
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->insert('produk', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data created successfully!</div>');
            redirect('produk');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'trim|numeric');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Produk';
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $data['produk'] = $this->db->get_where('produk', ['id' => $id])->row_array();

            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/main_sidebar');
            $this->load->view('templates/main_topbar', $data);
            $this->load->view('produk/edit', $data);
            $this->load->view('templates/main_footer');
        } else {
            // Memeriksa apakah ada file yang diunggah
            if (!empty($_FILES['foto']['name'])) {
                // Menghapus gambar sebelumnya jika ada
                $old_image = $this->db->get_where('produk', ['id' => $id])->row_array()['foto'];
                if ($old_image) {
                    unlink(FCPATH . 'assets/upload/' . $old_image);
                }

                $config['upload_path'] = './assets/upload/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = 'produk_' . time(); // Penamaan file gambar
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    // Jika upload gagal
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
                    redirect('produk/edit/' . $id);
                } else {
                    // Jika upload berhasil
                    $upload_data = $this->upload->data();
                    $foto = $upload_data['file_name'];
                }
            } else {
                $foto = null; // Foto diatur menjadi null jika tidak ada file yang diunggah
            }

            $data = [
                'nama_produk' => htmlspecialchars($this->input->post('nama_produk')),
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi')),
                'jenis' => htmlspecialchars($this->input->post('jenis')),
                'stok' => $this->input->post('stok') != '' ? htmlspecialchars($this->input->post('stok')) : null,
                'harga' => htmlspecialchars($this->input->post('harga')),
                'foto' => $foto, // Nama file gambar disimpan ke database
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->where('id', $id);
            $this->db->update('produk', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data updated successfully!</div>');
            redirect('produk');
        }
    }


    public function delete($id)
    {
        // Dapatkan informasi produk berdasarkan ID
        $produk = $this->db->get_where('produk', ['id' => $id])->row_array();

        if ($produk) {
            // Hapus hardfile foto jika ada
            if (!empty($produk['foto'])) {
                $file_path = FCPATH . 'assets/upload/' . $produk['foto'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            // Hapus data produk dari database
            $this->db->where('id', $id);
            $this->db->delete('produk');

            // Set pesan flashdata
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data deleted successfully!</div>');
        } else {
            // Jika produk tidak ditemukan
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Product not found!</div>');
        }

        // Redirect ke halaman produk
        redirect('produk');
    }

    /**
     * Customer Method
     */
    public function list()
    {
        $data['title'] = 'Daftar Produk & Layanan';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['sparepart'] = $this->db->get_where('produk', ['jenis' => 'sparepart'])->result_array();
        $data['jasa'] = $this->db->get_where('produk', ['jenis' => 'jasa'])->result_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/main_sidebar',);
        $this->load->view('templates/main_topbar', $data);
        $this->load->view('produk/list', $data);
        $this->load->view('templates/main_footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Produk';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['produk'] = $this->db->get_where('produk', ['id' => $id])->row_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/main_sidebar');
        $this->load->view('templates/main_topbar', $data);
        $this->load->view('produk/show', $data);
        $this->load->view('templates/main_footer');
    }

    public function cart($id)
    {
        $user = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $produk = $this->db->get_where('produk', ['id' => $id])->row_array();

        $data = [
            'user_id' => $user['id'],
            'produk_id' => $produk['id'],
            'jumlah' => htmlspecialchars($this->input->post('jumlah')),
        ];

        $this->db->insert('cart', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Cart created successfully!</div>');
        redirect('produk/list');
    }
}
