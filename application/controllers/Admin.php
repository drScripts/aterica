<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        if ($data) {
            $datas['title'] = $this->session->userdata('username');
            $jumlah['jumlah'] = $this->db->get_where('users', ['active' => 1])->num_rows();

            $this->load->view('templates_admin/headers', $datas);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/index.php', $jumlah);
            $this->load->view('templates_admin/footers');
            $this->load->view('templates_admin/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please Login First!</div>');
            redirect('auth');
        }
    }


    public function users()
    {

        $data = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();



        if ($data) {
            $datas['title'] = $this->session->userdata('username');

            $this->load->view('templates_admin/headers', $datas);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/users');
            $this->load->view('templates_admin/footers');
            $this->load->view('templates_admin/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please Login First!</div>');
            redirect('auth');
        }
    }
    public function admins()
    {
        $data = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        if ($data) {
            $datas['title'] = $this->session->userdata('username');

            $this->load->view('templates_admin/headers', $datas);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/admins');
            $this->load->view('templates_admin/footers');
            $this->load->view('templates_admin/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please Login First!</div>');
            redirect('auth');
        }
    }

    public function Uspromo()
    {
        $data = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        if ($data) {

            $sql = "SELECT * FROM users JOIN promo_user ON promo_user.user = users.id WHERE code_prom != 'no_promo'";
            $waw = $this->db->query($sql)->result_array();
            // var_dump($waw);
            foreach ($waw as $w) {

                $email = $w['email'];
                $lama = $w['lama'];
                $time = $w['time'];
                $id = $w['id_prom_us'];
                // echo $time;


                if (time() - $time > (60 * 60 * 24 * $lama)) {
                    $this->promex($email, $id);
                }
            }
            $datas['title'] = $this->session->userdata('username');

            $this->load->view('templates_admin/headers', $datas);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/uspromo');
            $this->load->view('templates_admin/footers');
            $this->load->view('templates_admin/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please Login First!</div>');
            redirect('auth');
        }
    }
    public function deleteprom()
    {
        $data = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        if ($data) {
            $ids = $this->input->get('id');

            $data = $this->db->get_where('promo_user', ['id_prom_us' => $ids])->row_array();
            $idus = $data['user'];
            $code = $data['code_prom'];
            $user = $this->db->get_where('users', ['id' => $idus])->row_array();
            $email = $user['email'];

            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'atericajewelry@gmail.com',
                'smtp_pass' => 'Aterica_jewelry22',
                'mailtype' => 'html',
                'charset' => 'utf-8'
            );
            $this->load->library('email', $config);
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('atericajewelry@gmail.com', 'Aterica Jewelry');
            $this->email->to(' ' . $email . ' ');
            $this->email->subject('Your Promo Code Is Not Available Any More');
            $this->email->message(' <div align="center"><h1>Your Promo Code Is Not Available Any More</h1>  
            <br>
            
            <h3>Kode Promo Kamu dengan Kode' . '  ' . $code . ' Sudah Tidak Berlaku untuk keterangan Lebih lanjut anda bisa menghubungi kami di 081901235416 / 087724002900 atau anda bisa langsung menghubungi kamilewat DM di Instagram Kita</h3>
            <h3>Terima Kasih!</h3>
             
            <p style="margin-top:50px">Please Stay Tune For Our Update To Gate a Great Price at Aterica</p><br>
            </div> ');
            if (!$this->email->send()) {
                show_error($this->email->print_debugger());
            } else {
                $this->db->delete('promo_user', ['id_prom_us' => $ids]);
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Promo Sudah Di Hapus User Sudah di Beri Tahu Sumedang!</div>');
                redirect('admin/Uspromo');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please Login First!</div>');
            redirect('auth');
        }
    }
    public function event()
    {
        $data = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        if ($data) {
            $datas['title'] = $this->session->userdata('username');
            $id['ids'] = $this->input->get('id');
            $this->load->view('templates_admin/headers', $datas);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/event', $id);
            $this->load->view('templates_admin/footers');
            $this->load->view('templates_admin/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please Login First!</div>');
            redirect('auth');
        }
    }

    public function sende()
    {
        $data = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        if ($data) {

            // rules
            $this->form_validation->set_rules('users', 'Users', 'required|trim');
            $this->form_validation->set_rules('ket', 'Keterangan', 'required|trim');
            $this->form_validation->set_rules('promo', 'Promo', 'required|trim');
            $this->form_validation->set_rules('sub', 'Subject', 'required|trim');
            $this->form_validation->set_rules('lama', 'Lama', 'required|trim');
            $this->form_validation->set_rules('pes', 'Pesan', 'required|trim');
            //  /rules

            if ($this->form_validation->run() == false) {
                $datas['title'] = $this->session->userdata('username');
                $id['ids'] = $this->input->get('id');

                $this->load->view('templates_admin/headers', $datas);
                $this->load->view('templates_admin/sidebar');
                $this->load->view('admin/event', $id);
                $this->load->view('templates_admin/footers');
                $this->load->view('templates_admin/footer');
            } else {
                $imagename = $_FILES['fpro']['name'];



                if ($imagename) {
                    $config['upload_path'] = "./assets/promo/";
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']     = '2500';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('fpro')) {

                        $new_image = $this->upload->data('file_name');

                        // mengambil data inputan
                        $id = $this->input->post('users');
                        $keterangan = $this->input->post('ket');
                        $promo = $this->input->post('promo');
                        $subject = $this->input->post('sub');
                        $lama = $this->input->post('lama');
                        $pesan = $this->input->post('pes');
                        // mendapatkan cupon
                        $bytes = openssl_random_pseudo_bytes(3, $cstrong);
                        $hex   = strtoupper(bin2hex($bytes));
                        // / cupon
                        // /inputan
                        // masukan data ke database promuser
                        $tambahan = [
                            'subjek' => $subject,
                            'pesan' => $pesan
                        ];
                        $datas = [
                            'keterangan' => $keterangan,
                            'code_prom' => $hex,
                            'user'  => $id,
                            'time'  => time(),
                            'foto'  => $new_image,
                            'lama'  => $lama,
                            'promo' => $promo
                        ];
                        $this->db->insert('promo_user', $datas, $tambahan);

                        $this->_SendEmails($datas, $tambahan);
                        // redirect('admin/Uspromo');


                        // /masukan data promuser
                    } else {
                        echo $this->upload->display_errors();
                    }
                }
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please Login First!</div>');
            redirect('auth');
        }
    }


    private function _SendEmails($datas, $tambahan)
    {
        // var_dump($datas);
        // echo "</br>";
        // var_dump($tambahan);
        $ids = $datas['user'];

        $kupons = $this->db->get_where('promo_user', ['user' => $ids])->row_array();

        // echo $ids;

        $kupon = $kupons['code_prom'];
        $lama = $datas['lama'];
        $userdata = $this->db->get_where('users', ['id' => $ids])->row_array();
        // var_dump($userdata);
        $emailus = $userdata['email'];
        $namaus =  $userdata['name'];
        $subject = $tambahan['subjek'];
        $keterangan = $datas['keterangan'];
        $pesan = $tambahan['pesan'];


        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'atericajewelry@gmail.com',
            'smtp_pass' => 'Aterica_jewelry22',
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('atericajewelry@gmail.com', 'Aterica Jewelry');
        $this->email->to(' ' . $userdata['email'] . ' ');
        $this->email->subject($subject . $namaus . '');



        $this->email->message(' <div align="center"><h1>' . $subject  . '</h1> <h4>' . $namaus . '!</h4>' . '  
        <br>
        
        <h3>' . $keterangan . '</h3>
        <h4>' . $pesan . ' berlaku selama  ' . $lama  . ' hari</h4>
        <h5>Unttuk mengecheck kupon silahkan masukan kode berikut ke link di bawah beserta cara penggunaanya ' . $kupon . ' </h5>
        <h2>
        <a style="background:#2C97DF;
        color:white;
        width:500em;
        border-top:0;
        border-left:0;
        border-right:0;
        border-bottom:5px solid #2A80B9;
        padding:10px 20px;
        text-decoration:none;
        font-family:sans-serif;
        font-size:11pt;" href="' . base_url() . 'Check" >Check! </a></h2>
        <p style="margin-top:50px">Please Stay Tune For Our Update To Gate a Great Price at Aterica</p><br>
        </div> ');
        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Promo Sudah Di kirim kan!</div>');
            redirect('admin/event');
        }
    }



    public function user()
    {
        $data = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        if ($data) {
            $datas['title'] = $this->session->userdata('username');
            $id['ids'] = $this->input->get('id');
            $this->load->view('templates_admin/headers', $datas);
            $this->load->view('templates_admin/sidebar');
            $this->load->view('admin/user', $id);
            $this->load->view('templates_admin/footers');
            $this->load->view('templates_admin/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please Login First!</div>');
            redirect('auth');
        }
    }

    private function promex($email, $id)
    {

        $data = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        if ($data) {

            // kirim email 
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'atericajewelry@gmail.com',
                'smtp_pass' => 'Aterica_jewelry22',
                'mailtype' => 'html',
                'charset' => 'utf-8'
            );

            $this->load->library('email', $config);
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('atericajewelry@gmail.com', 'Aterica Jewelry');
            $this->email->to(' ' . $email . ' ');
            $this->email->subject('Expired Code Promo');



            $this->email->message(' <div align="center"><h1>Hello ' . $email . ' Your Code Promo Has Expired</h1>  
            <br>

            <h3>Selalu Check IG kita dan Pantengin Terus Email Kamu Biar Kamu ga ketinggalan Promo-Promo Yang Kita Kasih Ke kamu Yah! </h3>
            
            <p style="margin-top:50px">Please Stay Tune For Our Update To Gate a Great Price at Aterica</p><br>
            </div> ');
            if (!$this->email->send()) {
                show_error($this->email->print_debugger());
            } else {
                $this->db->where('id_prom_us', $id);
                $this->db->delete('promo_user');
                redirect('admin/uspromo');
            }



            // delete promuser
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please Login First!</div>');
            redirect('auth');
        }
    }
}