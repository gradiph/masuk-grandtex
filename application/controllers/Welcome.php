<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function login() {
		$user = $this->input->post('user',true);
		$pass = $this->input->post('pass',true);
		$cek = $this->login_model->prosesLogin($user,$pass);
		$hasil = count($cek);
		if($hasil > 0){
			$select = $this->db->get_where('user', array('username' => $user, 'password => $pass'))->row();
			$data = array('logged_in' => true,
						'loger'=> $select->username,
						'id_user' => $select->id_user);
			$this->session->set_userdata($data);
			redirect('welcome/pageUser');
		}else{
			$this->session->set_flashdata('err','username dan password salah');
			redirect('welcome/index');
		}
	}
	public function pageUser(){
		$this->load->view('user');
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('welcome/index');
	}
}
