<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Kitchen extends CI_Controller {

	public function index()
	{

		$data = [
			'title' => 'Kitchen'
		];


		
		$this->load->view('includes/main_header' , $data);
		$this->load->model('Kitchen_Model');
		$order['order']=$this->Kitchen_Model->current_order();
		$this->load->view('Kitchen/kitchen',$order);
		$this->load->view('includes/main_footer');

	}

	public function status_change(){
		$data=$this->input->post();
		$table=$this->input->post('table_no');
		$this->load->model('Kitchen_Model');
		$status =$this->Kitchen_Model->status_change($table);
		//print_r($status);
		$this->session->set_userdata('status',$status);
		redirect('kitchen/Kitchen');

	}

	public function status_change_ready(){
		$data=$this->input->post();
		//print_r($data);
		$table=$this->input->post('table_no');
		$this->load->model('Kitchen_Model');
		$status =$this->Kitchen_Model->status_change_ready($table);
		//print_r($status);
		$this->session->set_userdata('status',$status);
		redirect('kitchen/Kitchen');
	}


}
