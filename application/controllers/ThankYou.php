<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ThankYou extends CI_Controller
{

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('Check');
        $this->load->view('templates/footer');
    }
    public function dare()
    {
        $email = $this->input->get('em');
        $token = $this->input->get('tok');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        $tokens = $this->db->get_where('token', ['token' => $token])->row_array();

        if ($user) {


            if ($tokens) {
                if (time() - $tokens['time'] < (60 * 60 * 24)) {
                    $this->db->set('active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('users');
                    $this->db->delete('token', ['email'  =>  $email]);
                    $this->load->view('templates/header');
                    $this->load->view('ThankYou', $email);
                    $this->load->view('templates/footer');
                } else {
                    $erorr['title'] = ' Token Expired';
                    $this->load->view('templates/header');
                    $this->load->view('erorrt', $erorr);
                    $this->load->view('templates/footer');
                    $this->db->delete('users', ['email'  =>  $email]);
                    $this->db->delete('token', ['email'  =>  $email]);
                }
            } else {
                $erorr['title'] = ' Token Invalid';
                $this->load->view('templates/header');
                $this->load->view('erorrt', $erorr);
                $this->load->view('templates/footer');
            }
        } else {
            $this->load->view('templates/header');
            $this->load->view('erorre');
            $this->load->view('templates/footer');
        }
    }
}