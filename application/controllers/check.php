<?php
defined('BASEPATH') or exit('No direct script access allowed');

class check extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {

        $this->load->view('templates/header');
        $this->load->view('checks');
        $this->load->view('templates/footer');
    }
    public function search()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('cupon', 'Cupon Code', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('checks');
            $this->load->view('templates/footer');
        } else {
            $this->_search();
        }
    }
    private function _search()
    {
        $email = $this->input->post('email');
        $cupon = $this->input->post('cupon');


        $data = $this->db->get_where('users', ['email' => $email])->row_array();
        // var_dump($data);
        if ($data) {
            $ids = $data['id'];

            $prom = $this->db->get_where('promo_user', ['user' => $ids])->row_array();

            if ($prom) {
                $cupons = $prom['code_prom'];
                // var_dump($prom);
                // echo $cupon;
                if ($cupons != $cupon) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invalid Promo Code!</div>');
                    redirect('check');
                } else {
                    $this->_hasil($data, $prom);
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You Dont Have A Promo Code!</div>');
                redirect('check');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invalid Email!</div>');
            redirect('check');
        }
    }
    private function _hasil($data, $prom)
    {
        // var_dump($data);
        // echo "</br>";
        // var_dump($prom);

        $email = $data['email'];
        $foto = $prom['foto'];
        $code = $prom['code_prom'];
        $keterangan = $prom['keterangan'];

        $data = [
            'email' => $email,
            'foto' => $foto,
            'code' => $code,
            'keterangan' => $keterangan
        ];

        // die;
        $this->load->view('templates/headers');
        $this->load->view('hasil', $data);
        $this->load->view('templates/footer');
    }
}