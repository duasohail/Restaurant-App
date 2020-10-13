<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {

	public function index()
	{

		$data = [
			'title' => 'Admin'
		];

		
		$this->load->view('includes/main_header' , $data);
		$this->load->view('Admin/admin');
		$this->load->view('includes/main_footer');

	}


}
