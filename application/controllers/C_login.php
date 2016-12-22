<?php
/* defined('BASEPATH') OR exit('No direct script access allowed'); */

class C_login extends CI_Controller {
	
	public function index()
	{		
		if($this->session->userdata('is_logged_in')){			
			redirect('home',$data);
		}else{
			redirect('formlogin');
			//redirect('formlogin', 'formlogin', 301);
		//$this->load->view('formlogin');		
		}
	}
	
	public function Login()
	{
		$this->load->view('formlogin');		
	}
	
	public function validasi()
	{
	        $this->load->model('m_login');
		$user_name = $this->input->post('email');
		$password = $this->input->post('password');

		$is_valid = $this->m_login->validateuser($user_name, $password);
		
		if(strcmp($is_valid,"gagal") == 1)
		{
			$data = array(
				'user_name' => $user_name,
				'is_logged_in' => true,
			);
			$this->session->set_userdata($data);
			redirect('home',$data);
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			redirect('formlogin',$data);
			//$this->load->view('formlogin');	
		} 
		 	
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		$this->load->helper('url');
		redirect('formlogin');
	}
	
}
