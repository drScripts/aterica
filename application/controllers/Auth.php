<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        $email = $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $email = $this->form_validation->set_rules('pass', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Login";
            $this->load->view('templates_admin/header', $data);
            $this->load->view('admin/login');
            $this->load->view('templates_admin/footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $pass =  $this->input->post('pass');

        $user = $this->db->get_where('admin', ['email' => $email])->row_array();
        if ($user) {
            $passv = $user['password'];
            if ($user['active'] == 1) {
                if (password_verify($pass, $passv)) {
                    $data = [
                        'email' => $user['email'],
                        'username' => $user['username']
                    ];
                    $this->session->set_userdata($data);
                    redirect('Admin');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your Account Is Not Activated!</div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invalid Email Please Register First!</div>');
            redirect('Auth');
        }
    }

    public function register()
    {
        $data['title'] = "Register";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('admin/register');
        $this->load->view('templates_admin/footer');
    }
    public function regis()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[admin.email]', [
            'is_unique' => 'This Username Already Used Please Use Another Username'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[admin.email]', [
            'is_unique' => 'This Email Already Used Please Use Another Email'
        ]);
        $this->form_validation->set_rules('pass1', 'Password1', 'required|trim|min_length[8]|matches[pass2]');
        $this->form_validation->set_rules('pass2', 'Password2', 'required|trim|matches[pass1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Register";
            $this->load->view('templates_admin/header', $data);
            $this->load->view('admin/register');
            $this->load->view('templates_admin/footer');
        } else {

            $username = $this->input->post('name');
            $email = $this->input->post('email');
            $pass = $this->input->post('pass1');
            $active = 0;

            $data = [
                'username' => htmlspecialchars($username),
                'password' => password_hash($pass, PASSWORD_DEFAULT),
                'email'    => htmlspecialchars($email),
                'active'   => $active
            ];
            $this->db->insert('admin', $data);
            $token = base64_encode(random_bytes(32));
            $tokens = [
                'token' => $token,
                'email' => $email,
                'time' => time()
            ];
            $this->db->insert('token', $tokens);
            $this->_sendEmaila($tokens, 'verify');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your Register Is Successful! Please Check Your Email To Activate Your Account!</div>');
            redirect('Auth');
        }
    }
    private function _sendEmaila($token, $type)
    {
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
        $this->email->to(' ' . $this->input->post('email') . ' ');
        if ($type == 'verify') {
            $this->email->subject('Aterica Jewelry - Admin Activate ' . $this->input->post('name') . '');


            $this->email->message(' <div align="center"><h1>Admin Activate</h1> <h4>' . $this->input->post('name') . '!</h4>' . '  
        <br>
        
        <h3 style="color:red">Pelase Click Confirm Button</h3>
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
        font-size:11pt;" href="' . base_url() . 'Auth/verify?em=' . $this->input->post('email') . '&tok=' . urlencode($token['token']) . '" >Activate! </a></h2>
        <p style="margin-top:50px">Please Activate Under 15 min</p><br>
        </div> ');
        }
        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Your Register Is Successful! Please Check Your Email To Activate Your Account!</div>');
            redirect('Auth');
        }
    }

    public function verify()
    {
        $email = $this->input->get('em');
        $token = $this->input->get('tok');

        $user = $this->db->get_where('admin', ['email' => $email])->row_array();
        $tokens = $this->db->get_where('token', ['token' => $token])->row_array();

        if ($user) {


            if ($tokens) {
                if (time() - $tokens['time'] < (60 * 15)) {
                    $this->db->set('active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('admin');
                    $this->db->delete('token', ['email'  =>  $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your Account ' . $email . ' is Successfully Activated Please login</div>');
                    redirect('Auth', $email);
                } else {
                    $data['title'] = 'Erorr - Token Expired';
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to Activate Your Account! Token Expired!</div>');
                    redirect('admin');
                    $this->db->delete('admin', ['email'  =>  $email]);
                    $this->db->delete('token', ['email'  =>  $email]);
                }
            } else {
                $data['title'] = 'Erorr - Invalid Token';
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to Activate Your Account! Invalid Token!</div>');
                redirect('Auth');
            }
        } else {
            $data['title'] = 'Erorr - Invalid Email';
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to Activate Your Account! Invalid Email!</div>');
            redirect('Auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('username');

        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Yout Have Been Logged Out!</div>');
        redirect('auth');
    }
}