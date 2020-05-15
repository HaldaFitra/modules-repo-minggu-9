<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct(){
    parent::__construct(); 
    $this->load->library(array('form_validation')); 
    $this->load->helper(array('url','form')); 
    $this->load->model('m_account'); 
    //call model
    }

    public function index() {
        $this->form_validation->set_rules('name', 'NAME','required');
        $this->form_validation->set_rules('username', 'USERNAME','required');
        $this->form_validation->set_rules('email','EMAIL','required|valid_email');
        $this->form_validation->set_rules('password','PASSWORD','required'); $this->form_validation->set_rules('password_conf','PASSWORD','required|matches[password] ');
        if($this->form_validation->run() == FALSE) { 
            if($this->session->userdata('username') == '') {
                $this->load->view('account/v_register');
            } else {
                redirect(site_url('dashboard'));
            }
        }else{
            $data['nama'] = $this->input->post('name');
            $data['username'] = $this->input->post('username');
            $data['email'] = $this->input->post('email');
            $data['password'] = md5($this->input->post('password'));
            $this->m_account->daftar($data);
            $pesan['message'] = "Pendaftaran berhasil";
            $this->load->view('account/v_success',$pesan);
        }
    }
}
function sendForgot($token, $email){
    $config = {
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'protocol'  => 'smtp',
        'smtp_host' => 'ssl:/smtp.googlemail.com',
        'smtp_user' => 'lucaslowenhart@gmail.com',
        'smtp_pass' => '122dims7v',
        'smtp_port' => '465',
        'newline'   => "\r\n"
    };

    $message = " Maaf, akun yang anda gunakan telah tidak dapat diakses..
                <br><br>
                Gunakan link dibawah untuk mendapatkan kembali akun anda:
                <br><br>
                <p><a href='".base_url()."member/resetpassword?email=".$email."&token=".$token."'>".base_url()."member/resetpassword?email=".$email."&token=".$token."</a></p>
                <br><br>
                Terima Kasih,<p>
                RollinCIgar Team.
    ";

    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    $this->email->from($config['smtp_user'], 'RollinCigar Dev');
    $this->email->to($email);
    $this->email->subject('[RollinCigar] Reset Your Password');
    $this->email->message($message);

    if($this->email->send()){
        return true;
    }else{
        echo $this->email->print_debugger();
        die;
    }
}