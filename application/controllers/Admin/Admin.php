<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Admin extends CI_Controller
{

	public function index()
	{
		$this->load->model('Admin_Model');
		$tables = $this->Admin_Model->show_table();
		$cat = $this->Admin_Model->show_category();
		$this->load->helper('form');
		$data = [
			'title' => 'Admin',
			'table' => $tables,
			'category' => $cat
		];


		$this->load->view('includes/main_header', $data);
		$this->load->view('Admin/admin');
		$this->load->view('includes/main_footer');
	}

	public function add_table()
	{
		$table = $this->input->post("table_no");
		$this->load->model('Admin_Model');
		$result = $this->Admin_Model->add_table($table);
		$this->session->set_userdata('isAdded', $result);
		redirect('Admin/Admin');
	}

	public function cancel_view()
	{
		$this->load->model('Admin_Model');
		$this->load->helper('form');
		$data = [
			'title' => 'Admin'

		];
		$this->load->view('includes/main_header', $data);
		$this->load->view('Admin/cancel_orders_report');
		$this->load->view('includes/main_footer');
	}

	public function reports_view()
	{
		$this->load->model('Admin_Model');
		$this->load->helper('form');
		$data = [
			'title' => 'Reports'

		];
		$this->load->view('includes/main_header', $data);
		$this->load->view('Admin/reports');
		$this->load->view('includes/main_footer');
	}


	public function print_sales()
	{
		$this->load->view('Admin/print_sales');
	}
	public function print_cancle()
	{
		$this->load->view('Admin/print_cancle');
	}

	public function get_sales_report()
	{
		$s_d = $this->input->post("s_d");
		$e_d = $this->input->post("e_d");
		$this->load->model('Admin_Model');

		$result = $this->Admin_Model->get_sales_report($s_d, $e_d);

		$mydata = '
		<tr>
        <th>ID</th>
        <th>Table No</th>
        <th>Item Name</th>
        <th>Size</th>
        <th>Quantity</th>
        <th>Items Amount</th>
        <th>Discount</th>
        <th>Total</th>
    </tr>
    ';
		$i = 1;
		$totalSales = 0;
		$totalDiscount = 0;
		foreach ($result as $row) {

			$itemss = $row['items'];
			$items = explode(',', $itemss);

			$sizes = explode(',', $row['size']);
			$quantities = explode(',', $row['quantity']);
			$items_amount = explode(',', $row['items_amount']);


			$table = $row['table_no'];

			if ($table == 0) {
				$table_no = '' . $row['type'];
			} else {
				$table_no = '' . $row['table_no'];
			}

			$mydata .= '
            <tr>
				<td>' . $i++ . '</td>
				<td>' . $table_no . '</td>
				<td>';

			foreach ($items as $item) {
				$mydata .= $item . '<br>';
			}

			$mydata .= '</td><td>';

			foreach ($sizes as $size) {
				$mydata .= $size . '<br>';
			}

			$mydata .= '</td><td>';

			foreach ($quantities as $qty) {
				$mydata .= $qty . '<br>';
			}

			$mydata .= '</td><td>';

			foreach ($items_amount as $i_amnt) {
				$mydata .= 'Rs.' . $i_amnt . '<br>';
			}

			$mydata .= '</td>
				<td>' . $row['discount'] . '</td>
				<td>Rs.' . $row['total_amount'] . ' <br></td>
			</tr>
			';


			$temp = $row['total_amount'] / 100;
			$discount_amount = $temp * $row['discount'];
			$totalSales += $row['total_amount'] - $discount_amount;
			$totalDiscount += $discount_amount;
		}


		$totalSaless = $totalSales + $totalDiscount;

		$mydata .= '
		<tr>
        <th colspan="8" style="text-align:center">Total Sales Amount = Rs.' . $totalSaless . '</th>
    </tr>
	
	<tr>
	<th colspan="8" style="text-align:center">Total Discount = Rs.' . $totalDiscount . '</th>
	</tr>

<tr>

<th colspan="8" style="text-align:center">Net Sales Amount = Rs.' . $totalSales . '</th>
</tr>

    ';
		$this->session->set_userdata('sales_report', $mydata);
		echo $mydata;
	}
	public function get_cancle_report()
	{
		$s_d = $this->input->post("s_d");
		$e_d = $this->input->post("e_d");
		$this->load->model('Admin_Model');

		$result = $this->Admin_Model->get_cancle_report($s_d, $e_d);

		$mydata = '
		<tr>
        <th>ID</th>
        <th>Table No</th>
        <th>Item Name</th>
        <th>Size</th>
        <th>Quantity</th>
        <th>Items Amount</th>
        <th>Discount</th>
        <th>Total</th>
    </tr>
    ';
		$i = 1;
		$totalSales = 0;
		$totalDiscount = 0;
		foreach ($result as $row) {

			$itemss = $row['items'];
			$items = explode(',', $itemss);

			$sizes = explode(',', $row['size']);
			$quantities = explode(',', $row['quantity']);
			$items_amount = explode(',', $row['items_amount']);


			$table = $row['table_no'];

			if ($table == 0) {
				$table_no = '' . $row['type'];
			} else {
				$table_no = '' . $row['table_no'];
			}

			$mydata .= '
            <tr>
				<td>' . $i++ . '</td>
				<td>' . $table_no . '</td>
				<td>';

			foreach ($items as $item) {
				$mydata .= $item . '<br>';
			}

			$mydata .= '</td><td>';

			foreach ($sizes as $size) {
				$mydata .= $size . '<br>';
			}

			$mydata .= '</td><td>';

			foreach ($quantities as $qty) {
				$mydata .= $qty . '<br>';
			}

			$mydata .= '</td><td>';

			foreach ($items_amount as $i_amnt) {
				$mydata .= 'Rs.' . $i_amnt . '<br>';
			}

			$mydata .= '</td>
				<td>' . $row['discount'] . '</td>
				<td>Rs.' . $row['total_amount'] . ' <br></td>
			</tr>
			';


			$temp = $row['total_amount'] / 100;
			$discount_amount = $temp * $row['discount'];
			$totalSales += $row['total_amount'] - $discount_amount;
			$totalDiscount += $discount_amount;
		}


		$totalSaless = $totalSales + $totalDiscount;


		$mydata .= '
		<tr>
        <th colspan="8" style="text-align:center">Total Sales Amount = Rs.' . $totalSaless . '</th>
    </tr>
	
	<tr>
	<th colspan="8" style="text-align:center">Total Discount = Rs.' . $totalDiscount . '</th>
	</tr>

<tr>

<th colspan="8" style="text-align:center">Net Sales Amount = Rs.' . $totalSales . '</th>
</tr>


    ';

		// 		$mydata .='
		// 		<tr>
		//         <th></th>
		//         <th></th>
		//         <th></th>
		//         <th></th>
		//         <th></th>
		//         <th></th>
		//         <th></th>
		//         <th>Total Sales Amount</th>
		//     </tr>
		// 		<tr>
		//         <th></th>
		//         <th></th>
		//         <th></th>
		//         <th></th>
		//         <th></th>
		//         <th></th>
		//         <th></th>
		// 			<th >Rs.'.$totalSaless.'</th>
		// 	</tr>
		// 	<tr>
		// 	<th></th>
		// 	<th></th>
		// 	<th></th>
		// 	<th></th>
		// 	<th></th>
		// 	<th></th>
		// 	<th></th>
		// 	<th>Total Discount</th>
		// </tr>
		// 	<tr>
		// 	<th></th>
		// 	<th></th>
		// 	<th></th>
		// 	<th></th>
		// 	<th></th>
		// 	<th></th>
		// 	<th></th>
		// 	<th >Rs.'.$totalDiscount.'</th>
		// </tr>
		// <tr>
		// <th></th>
		// <th></th>
		// <th></th>
		// <th></th>
		// <th></th>
		// <th></th>
		// <th></th>
		// <th>Net Sales Amount</th>
		// </tr>
		// <tr>
		// <th></th>
		// <th></th>
		// <th></th>
		// <th></th>
		// <th></th>
		// <th></th>
		// <th></th>
		// 	<th >Rs.'.$totalSales.'</th>
		// </tr>
		//     ';
		$this->session->set_userdata('cancle_report', $mydata);
		echo $mydata;
	}

	public function dlt_table()
	{
		$id = $this->input->post('id');
		$this->load->model('Admin_Model');
		$result = $this->Admin_Model->dlt_table($id);
		$this->session->set_userdata('isAdded', $result);
		redirect('Waiter/Waiter');
	}

	public function add_category()
	{
		$cat = $this->input->post("category");
		//print_r($cat);
		$this->load->model('Admin_Model');
		$result = $this->Admin_Model->add_category($cat);
		$this->session->set_userdata('isAdded', true);
		redirect('Admin/Admin');
	}
	public function get_menu_items()
	{
		$id = $this->input->post("id");

		$this->load->model('Admin_Model');
		$result = $this->Admin_Model->show_menu($id);

		$data = '';

		foreach ($result as $row) {
			$data .= '<option value="' . $row['id'] . '" >' . $row['item_name'] . '</option>';
		}
		echo $data;
	}
	public function add_price_size()
	{
		$id = $this->input->post("id");
		$price = $this->input->post("price");
		$size = $this->input->post("size");
		$this->load->model('Admin_Model');
		$result = $this->Admin_Model->add_price_size($id, $price, $size);

		// $data = '';

		// foreach($result as $row){
		// 	$data .= '<option value="'.$row['id'].'" >'.$row['item_name'].'</option>';
		// }
		// echo $result;

	}
	public function edit_category()
	{
		$cat_id = $this->input->post("id");
		$cat_name = $this->input->post("name");
		// //print_r($cat);
		$this->load->model('Admin_Model');
		$result = $this->Admin_Model->edit_category($cat_id, $cat_name);
		// $this->session->set_userdata('isAdded',true);
		// redirect('Admin/Admin');

	}
	public function edit_menu_item()
	{
		$id = $this->input->post("id");
		$item_name = $this->input->post("item_name");
		// //print_r($cat);
		$this->load->model('Admin_Model');
		$result = $this->Admin_Model->edit_item($id, $item_name);
		// $this->session->set_userdata('isAdded',true);
		// redirect('Admin/Admin');

	}
	public function dlt_category()
	{
		$cat_id = $this->input->post("id");
		//print_r($cat);
		$this->load->model('Admin_Model');
		$result = $this->Admin_Model->dlt_category($cat_id);
		// redirect('Admin/Admin');

	}

	public function dlt_menu_item()
	{
		$id = $this->input->post("id");
		//print_r($cat);
		$this->load->model('Admin_Model');
		$result = $this->Admin_Model->dlt_menu_item($id);
		// $this->session->set_userdata('isAdded',true);
		// redirect('Admin/Admin');

	}


	public function get_menu()
	{

		if ($this->input->post('admin')) {
			$this->load->model('Admin_Model');
			$item = $this->input->post('new_item');
			$id = $this->input->post('category_name');
			$data = $this->input->post();
			$path = 'assets/img/'.$id;

			$image = $_FILES['item_image']['name'];

			$imgExt = pathinfo($image , PATHINFO_EXTENSION);

			$uid = uniqid().'.'.$imgExt;

			$file_store_area = "http://127.0.0.1/Restaurant/assets/img/$id/";


			$folder_dir = "http://127.0.0.1/Restaurant/assets/img/$id/";

			$fileDir = $folder_dir.$uid;


			

			$data=$this->Admin_Model->add_menu($id,$item,$fileDir);
			// echo $img_link;





			$config['upload_path']          = 'assets/img/'.$id;
			$config['allowed_types']        = 'gif|jpg|png';
			
			$config['file_name']            = $uid;
			
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('item_image')) {
				// echo 'if';
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			} else {
				
				$this->session->set_userdata('isAdded',true);

				redirect('Admin/Admin');
				
				$data = array('upload_data' => $this->upload->data());
			}

			// echo $item;
		} else {
			echo "failed";
		}
	}
	public function show_menu()
	{
		$this->load->model('Admin_Model');
		$id = $this->input->post('id');

		$data = $this->Admin_Model->show_menu($id);

		$myData = '';
		foreach ($data as $item) {
			$myData .= '<div class="text-left ml-5 mr-5 pl-2 bt-2 pb-2 mt-2 bg-white text-dark" id="item_' . $item['id'] . '">' . $item['item_name'] . '
			<button type="button" value="' . $item['id'] . '" class="btn btn-sm btn-danger mr-1 edit_item" style="float:right;">
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square text-white" style="font-size:18px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
			<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
			</svg>
			</button>
			<button type="button" value="' . $item['id'] . '" style="float:right;" class="btn btn-sm btn-danger mr-1 dlt_item">
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash text-white" style="font-size:18px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
			<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
			</svg>
			</button></div>';
		}
		echo $myData;
	}
}
