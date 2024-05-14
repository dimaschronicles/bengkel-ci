<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Montir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Montir';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('created_at', 'DESC');
        $data['montir'] = $this->db->get('montir')->result_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/main_sidebar',);
        $this->load->view('templates/main_topbar', $data);
        $this->load->view('montir/index', $data);
        $this->load->view('templates/main_footer');
    }

    public function create()
    {
        $this->form_validation->set_rules('nama_montir', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('no_hp_montir', 'No HP', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat_montir', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah Montir';
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/main_sidebar',);
            $this->load->view('templates/main_topbar', $data);
            $this->load->view('montir/create', $data);
            $this->load->view('templates/main_footer');
        } else {
            $data = [
                'nama_montir' => htmlspecialchars($this->input->post('nama_montir')),
                'no_hp_montir' => htmlspecialchars($this->input->post('no_hp_montir')),
                'alamat_montir' => htmlspecialchars($this->input->post('alamat_montir')),
                'status_montir' => 'tersedia',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->insert('montir', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data created successfully!</div>');
            redirect('montir');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('nama_montir', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('no_hp_montir', 'No HP', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat_montir', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Montir';
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            $data['montir'] = $this->db->get_where('montir', ['id' => $id])->row_array();

            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/main_sidebar',);
            $this->load->view('templates/main_topbar', $data);
            $this->load->view('montir/edit', $data);
            $this->load->view('templates/main_footer');
        } else {
            $data = [
                'nama_montir' => htmlspecialchars($this->input->post('nama_montir')),
                'no_hp_montir' => htmlspecialchars($this->input->post('no_hp_montir')),
                'alamat_montir' => htmlspecialchars($this->input->post('alamat_montir')),
                'status_montir' => 'tersedia',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->where('id', $id);
            $this->db->update('montir', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data created successfully!</div>');
            redirect('montir');
        }
    }

    public function delete($id)
    {
        $montir = $this->db->get_where('montir', ['id' => $id])->row_array();

        if ($montir) {
            $this->db->where('id', $id);
            $this->db->delete('montir');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data deleted successfully!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Product not found!</div>');
        }

        // Redirect ke halaman produk
        redirect('montir');
    }
}
