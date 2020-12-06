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
        $this->load->view('templates/header');
        $this->load->view('index');
        $this->load->view('templates/footer');
    }
    public function check()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[users.name]', [
            'is_unique' => 'This Name Already Used Please Use Another Name'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'The Email Account Already Exists Please Use Another Email Account'
        ]);
        $this->form_validation->set_rules('birth', 'Birth', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim');
        $this->form_validation->set_rules('insta', 'Instagram Username', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('indexs');
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name', true);
            $email = $this->input->post('email', true);
            $birth = $this->input->post('birth', true);
            $address = $this->input->post('address', true);
            $phone = $this->input->post('phone', true);
            $insta = $this->input->post('insta', true);
            $data = [
                'name' => htmlspecialchars($name),
                'email' => htmlspecialchars($email),
                'birth' => htmlspecialchars($birth),
                'address' => htmlspecialchars($address),
                'phone' => htmlspecialchars($phone),
                'insta' => htmlspecialchars($insta),
                'active' => 0,

            ];
            $token = base64_encode(random_bytes(32));
            $tokens = [
                'token' => $token,
                'email' => $email,
                'time' => time()
            ];
            $this->db->insert('users', $data);
            $this->db->insert('token', $tokens);
            $this->_sendEmail($tokens, $data);
        }
    }

    private function _sendEmail($token, $data)
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
        $this->email->subject('ThankYou ' . $this->input->post('name') . '');


        $this->email->message(' <div align="center"><h1>Thank You</h1> <h4>' . $this->input->post('name') . '!</h4>' . '  
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
        font-size:11pt;" href="' . base_url() . 'ThankYou/dare?em=' . $data['email'] . '&tok=' . urlencode($token['token']) . '" >Confirm! </a></h2>
        <p style="margin-top:50px">Please Stay Tune For Our Update To Gate a Great Price at Aterica</p><br>
        </div> ');
        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        } else {
            redirect('ThankYou');
        }
    }
}