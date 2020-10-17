<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {

	public function index()
	{
		$this->load->model('Admin_Model');
		$tables=$this->Admin_Model->show_table();
		$cat=$this->Admin_Model->show_category();
		$this->load->helper('form');
		$data = [
			'title' => 'Admin',
			'table' => $tables,
			'category'=>$cat
		];

		
		$this->load->view('includes/main_header' , $data);
		$this->load->view('Admin/reports');
		$this->load->view('includes/main_footer');

	}
	public function vendor_view()
	{
		$this->load->model('Admin_Model');
		$this->load->helper('form');
		$data = [
			'title' => 'Admin'
			
		];

		
		$this->load->view('includes/main_header' , $data);
		$this->load->view('Admin/vendors_report');
		$this->load->view('includes/main_footer');

	}
	public function cancel_view()
	{
		$this->load->model('Admin_Model');
		$this->load->helper('form');
		$data = [
			'title' => 'Admin'
			
		];

		
		$this->load->view('includes/main_header' , $data);
		$this->load->view('Admin/cancel_orders_report');
		$this->load->view('includes/main_footer');

	}
	public function Profit_view()
	{
		$this->load->model('Admin_Model');
		$this->load->helper('form');
		$data = [
			'title' => 'Admin'
			
		];

		
		$this->load->view('includes/main_header' , $data);
		$this->load->view('Admin/profit_report');
		$this->load->view('includes/main_footer');

	}public function Expanse_view()
	{
		$this->load->model('Admin_Model');
		$this->load->helper('form');
		$data = [
			'title' => 'Admin'
			
		];

		
		$this->load->view('includes/main_header' , $data);
		$this->load->view('Admin/expanse_report');
		$this->load->view('includes/main_footer');

	}


	public function add_table()
	{
		$table=$this->input->post("table_no");
		$this->load->model('Admin_Model');
		$result=$this->Admin_Model->add_table($table);
		$this->session->set_userdata('isAdded',$result);
		redirect('Admin/Admin');

	}
	
	public function get_sales_report()
	{
		$s_d=$this->input->post("s_d");
		$e_d=$this->input->post("e_d");
		$this->load->model('Admin_Model');
		
		$result=$this->Admin_Model->get_sales_report($s_d , $e_d);
		
		$mydata='';
        foreach($result as $row){
            $mydata .= '
            <tr>
        <td>ID</td>
        <td>Table No</td>
        <td>Item Name</td>
        <td>Size</td>
        <td>Quantity</td>
        <td>Items Amount</td>
        <td>Discount</td>
        <td>Total</td>
    </tr>
            
            ';
        }

		echo $mydata;
	}

	public function dlt_table(){
		$id=$this->input->post('id');
		$this->load->model('Admin_Model');
		$result=$this->Admin_Model->dlt_table($id);
		$this->session->set_userdata('isAdded',$result);
		redirect('Waiter/Waiter');

	}

	public function add_category()
	{
		$cat=$this->input->post("category");
		//print_r($cat);
		$this->load->model('Admin_Model');
		$result=$this->Admin_Model->add_category($cat);
		$this->session->set_userdata('isAdded',true);
		redirect('Admin/Admin');

	}
	public function edit_category()
	{
		$cat_id=$this->input->post("id");
		$cat_name=$this->input->post("name");
		// //print_r($cat);
		$this->load->model('Admin_Model');
		$result=$this->Admin_Model->edit_category($cat_id,$cat_name);
		// $this->session->set_userdata('isAdded',true);
		// redirect('Admin/Admin');

	}
	public function dlt_category()
	{
		$cat_id=$this->input->post("id");
		//print_r($cat);
		$this->load->model('Admin_Model');
		$result=$this->Admin_Model->dlt_category($cat_id);
		// $this->session->set_userdata('isAdded',true);
		// redirect('Admin/Admin');
		
	}
	

	public function get_menu(){
		
		if($this->input->post('admin')){
		//$this->load->model('Admin_Model');
		$item = $this->input->post('new_item');
		$id = $this->input->post('category_name');
		 $data = $this->input->post();
		// $path = 'assets/img/'.$id;

		// // $image = $_FILES['item_image']['name'];

		// $imgExt = pathinfo($image , PATHINFO_EXTENSION);

		// $file = uniqid().'.'.$imgExt;

		// $file_store_area = "http://127.0.0.1/Restaurant/assets/img/$id/";


		// $folder_dir = "http://127.0.0.1/Restaurant/assets/img/$id/";

		// $fileDir = $folder_dir.$file;


		// // $res = move_uploaded_file( $_FILES['item_image']['tmp_name'], $file_store_area);
		// $this->load->library('upload');
		// $this->upload->do_upload('item_image');
		// $img_link =  $path.'/'.$this->upload->data('file_name');


		// $data=$this->Admin_Model->add_menu($id,$item,$fileDir);
		// echo $img_link;





		$config['upload_path']          = 'assets/img/9';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['file_name']            = uniqid();
		$config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('item_image'))
		{
				$error = array('error' => $this->upload->display_errors());

		}
		else
		{
				$data = array('upload_data' => $this->upload->data());

				

		}
		
	}else{
		echo "failed";
	}
	}
	public function show_menu(){
		$this->load->model('Admin_Model');
		$id = $this->input->post('id');

		 $data=$this->Admin_Model->show_menu($id);

		$myData = '';
		foreach($data as $item){
			$myData .= '<div class="text-left ml-5 mr-5 pl-2 bt-2 pb-2 mt-2 bg-white text-dark">'.$item['item_name'].'
			<button type="button" class="btn btn-sm btn-danger mr-1" style="float:right;">
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square text-white" style="font-size:18px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
			<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
			</svg>
			</button>
			<button type="button" style="float:right;" class="btn btn-sm btn-danger mr-1">
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash text-white" style="font-size:18px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
			<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
			</svg>
			</button></div>';
		}
		echo $myData;
	}


}
