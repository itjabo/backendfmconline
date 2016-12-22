<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {
	
	public function add_user()
	{			
		if($this->session->userdata('is_logged_in')){
			$this->load->model('m_login'); $data = $this->m_login->loadData($this->session->userdata('user_name'));	
			$this->load->model('m_user'); $data2 = $this->m_user->loadUser();
			$this->load->model('m_models'); 
			$data3 = $this->m_models->getKapal();
			$datas = array(
				'username'  => $data["username"],
				'email' 	=> $data["email"],
				'unit' 		=> $data["unit"],
				'level' 	=> $data["level"],
				'tgl_create'=> $data["tgl_create"],
				'data2' => $data2,
				'kapal'		=> $data3,
			);
			if (strcmp($data["level"],"super admin")==0) {
				$this->load->view('add_user', $datas);
			}else{
				redirect('home');
			}
		}else{
			redirect('formlogin');
		}
	}
	
	public function user_management()
	{				
		if($this->session->userdata('is_logged_in')){
			$this->load->model('m_login'); $data = $this->m_login->loadData($this->session->userdata('user_name'));
			if (strcmp($data["level"],"super admin")==0) {
				$this->load->view('user_management', $data);
			}else{
				redirect('home');
			}
		}else{
			redirect('formlogin');
		}
	}
	
	public function insert()
	{
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_user');
		$user_name = $this->input->post('username');
		$password  = $this->input->post('password');
		$unit 	   = $this->input->post('unit');
		$level 	   = $this->input->post('level');
		$nama	   = $this->input->post('nama');
		$zona      = $this->input->post('zona');

		$this->m_user->insertUser($nama, $user_name, $password, $unit, $level,$zona);
		
		redirect('add_user');	
		}else{
			redirect('formlogin');
		}		
	}
	
	public function updatepass()
	{
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_login'); $data = $this->m_login->loadData($this->session->userdata('user_name'));	
			
		$this->load->model('m_user');
		$oldpassword= $this->input->post('oldpassword');
		$newpassword= $this->input->post('newpassword');
		$emails= $this->input->post('emails');
		$oldpass = $this->m_user->getpass($emails);
		
	    $this->load->model('m_login');
		$user_name = $this->input->post('emails');
		$password = $this->input->post('oldpassword');

		$is_valid = $this->m_login->validateuser($user_name, $password);
		$error = "";	
		if(strcmp($is_valid,"gagal") == 1){
			$this->m_user->updatepassword($user_name, $newpassword);
			$error = "Password berhasil diperbaharui";
		}else{
			$error = "Password Lama tidak valid";			
		}
		
			$this->load->model('m_models'); 
			$data2 = $this->m_models->getKapal();
			$datas = array(
			'username'  => $data["username"],
				'email' 	=> $data["email"],
				'unit' 		=> $data["unit"],
				'level' 	=> $data["level"],
				'tgl_create'=> $data["tgl_create"],
				'data'	=> $data, 
				'kapal'		=> $data2,
				'error'		=> $error,
			);		
			$this->load->view('profile',$datas);
		}else{
			redirect('formlogin');
		}
	}
	
	public function delete_user(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_user');
		$id_user = $this->input->post('id_user');
		$this->m_user->deleteUser($id_user);		
			
		redirect('add_user');	
		}else{redirect('formlogin');}
	}
}
