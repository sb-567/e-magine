<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("Auth_model",'am');
	}

	public function index()
	{
		if(isset($_POST['submit'])){
			$username = $this->input->post("username");
			$password = $this->input->post("password");

			$res = $this->am->getAdminByUsername($username);
			if($res){
				if(password_verify($password, $res['password'])){
					$this->session->set_userdata('id',$res['id']);
					$this->session->set_userdata('name',$res['name']);
					$this->session->set_userdata('username',$res['username']);
					redirect(base_url("Dashboard"));

				}else{
					$this->session->set_flashdata('error','You have entered wrong password.');
					redirect(base_url());
				}
			}else{
				$this->session->set_flashdata('error','You have entered wrong username.');
				redirect(base_url());
			}
		}
		if($this->session->userdata('id') && !empty($this->session->userdata('id'))){
			redirect(base_url("Dashboard"));
		}
		$this->load->view('auth/login');
	}

	public function logout(){
					$this->session->unset_userdata('id');
					$this->session->unset_userdata('name');
					$this->session->unset_userdata('username');
					redirect(base_url("Auth"));
	}
}
