<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Profil';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('templates/main_sidebar',);
        $this->load->view('templates/main_topbar', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/main_footer');
    }

    public function editprofile()
    {
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Data Profil';
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/main_sidebar',);
            $this->load->view('templates/main_topbar', $data);
            $this->load->view('profile/edit_profil', $data);
            $this->load->view('templates/main_footer');
        } else {
            $dataUser = [
                'name' => htmlspecialchars($this->input->post('name')),
                'no_hp' => htmlspecialchars($this->input->post('no_hp')),
                'alamat' => htmlspecialchars($this->input->post('alamat')),
            ];

            $this->db->where('id', $this->input->post('user_id'));
            $this->db->update('users', $dataUser);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil updated successfully!</div>');
            redirect('profile');
        }
    }

    public function changepassword()
    {
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password_conf]', [
            'matches' => 'Password does not match',
            'min_length' => 'Password at least 6 characters',
        ]);
        $this->form_validation->set_rules('password_conf', 'Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ganti Password';
            $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/main_header', $data);
            $this->load->view('templates/main_sidebar',);
            $this->load->view('templates/main_topbar', $data);
            $this->load->view('profile/change_password', $data);
            $this->load->view('templates/main_footer');
        } else {
            $dataUser = [
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            ];

            $this->db->where('id', $this->input->post('user_id'));
            $this->db->update('users', $dataUser);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password updated successfully!</div>');
            redirect('profile');
        }
    }
}
