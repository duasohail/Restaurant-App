<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

	public function index()
	{

		$data = [
			'title' => 'Login Page'
		];

		$this->load->view('includes/main_header' , $data);
		$this->load->view('login');
		$this->load->view('includes/main_footer');

	}



	public function user_login(){
		$email = $this->input->post('email', TRUE);
		$password = $this->input->post('password', TRUE);

		$this->form_validation->set_rules('email' , 'Email' , 'required');
		$this->form_validation->set_rules('password' , 'Password' , 'required');


		if($this->form_validation->run() == TRUE){
			$this->load->model('Login_Model');

			$result = $this->Login_Model->login($email , $password);

			if($result->num_rows() > 0){
				$data = $result->row_array();

				if($data['roll'] == 1){
					redirect('Admin/Admin');
				}else if($data['roll'] == 2){
					$this->session->set_userdata('waiter_email' , $email);
					redirect('Waiter/Waiter');
				}else if($data['roll'] == 3){
					redirect('Kitchen/Kitchen');
				}else{
					redirect('Counter/Counter');
				}
			}else{
				echo 'not a user';
			}
			
		}else{

			$data = [
				'title' => 'Login Page'
			];		
			$this->load->view('includes/main_header' , $data);
			$this->load->view('login');
			$this->load->view('includes/main_footer');
		}
		

	}
}
