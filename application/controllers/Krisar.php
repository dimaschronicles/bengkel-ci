<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Krisar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Kritik & Saran';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->order_by('created_at', 'DESC');
        $data['krisar'] = $this->db->get('krisar')->result_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/main_sidebar',);
        $this->load->view('templates/main_topbar', $data);
        $this->load->view('krisar/index', $data);
        $this->load->view('templates/main_footer');
    }

    public function create()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('kritik', 'Kritik', 'required|trim');
        $this->form_validation->set_rules('saran', 'Saran', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Masukan Kritik & Saran Anda';
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/main_sidebar',);
            $this->load->view('templates/main_topbar', $data);
            $this->load->view('krisar/create', $data);
            $this->load->view('templates/main_footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'no_hp' => htmlspecialchars($this->input->post('no_hp')),
                'alamat' => htmlspecialchars($this->input->post('alamat')),
                'kritik' => htmlspecialchars($this->input->post('kritik')),
                'saran' => htmlspecialchars($this->input->post('saran')),
                'tanggal' =>  date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->insert('krisar', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data send successfully!</div>');
            redirect('krisar/create');
        }
    }
}
