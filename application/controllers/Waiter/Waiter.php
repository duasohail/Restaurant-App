<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Waiter extends CI_Controller
{

	public function index()
	{
		$this->session->set_userdata('uid', 1);

		$data = [
			'title' => 'Waiter'
		];
		$this->load->view('includes/main_header', $data);

		$this->load->model('Waiter_Model');
		// //Main menu
		$categories_data = $this->Waiter_Model->get_categories();
		$employees_data = $this->Waiter_Model->get_employees();
		$tables_data = $this->Waiter_Model->get_tables();
		$first_main_category = $categories_data['0']['id'];
		$first_menu = $this->Waiter_Model->get_first_menu($first_main_category);

		$data = [
			'categories_data' => $categories_data,
			'tables_data' => $tables_data,
			'first_menu' => $first_menu,
			'employees_data' => $employees_data,
		];

		$this->load->view('Waiter/waiter', $data);
		$this->load->view('includes/main_footer');
	}

	public function get_price()
	{
		$this->load->model('Waiter_Model');

		$id = $this->input->post('id', TRUE);
		$currentSize = $this->input->post('currentSize', TRUE);

		$result = $this->Waiter_Model->get_item_price($id, $currentSize);

		echo $result[0]['price'];
	}

	public function update_current_order()
	{
		// $uniqueId = 1;

		$id = $this->input->post('id', TRUE);



		$this->load->model('Waiter_Model');
		$menu_item  = $this->Waiter_Model->get_menu_item_info($id);
		$price  = $this->Waiter_Model->get_price_info($id);

		$pp = $price[0]['price'];

		$uid = $this->session->userdata('uid');

		$start =  '<tr class=" item_to_delete item_unique_' . $uid . '" title="' . $uid . '"  id="menu_item_' . $id . '" >
		<td class=" p-2 mt-1 text-center item_name_' . $uid . '" id="item_name_' . $id . '">' . $menu_item[0]['item_name'] . '</td>
		<td class="p-2">
		<select class="  form-control item_size_' . $uid . '" id="item_size_' . $id . '" title="' . $uid . '" name="" id="">';

		foreach ($price as $p) {
			$start = $start . '<option class="text-center" id="' . $p['price'] . '"  value="' . $p['size'] . '">' . $p['size'] . '</option>';
		}

		$start = $start . '</select>
		</td>
		<td class="p-2">
		<input class="  form-control item_qty_' . $uid . '" id="item_qty_' . $id . '"  title="' . $uid . '" autocomplete="false"  type="text" size="3" value="1" maxlength="3">
		</td>
		<td class="p-2 text-center mt-1 item_amount_' . $uid . '" id="item_amount_' . $id . '"  title="' . $uid . '">' . $pp . '</td>
		<td class=" p-2 text-center "><Button class="form-control btn-sm btn-danger btn_delete_' . $uid . '"  title="' . $uid . '"  id="btn_delete_' . $id . '" class="btn-sm btn-danger">Delete</Button></td>
		</tr>';

		$uid = $uid + 1;
		$this->session->set_userdata('uid', $uid);

		echo $start;

		$start = '';
	}

	public function update_menu()
	{
		$this->load->model('Waiter_Model');

		$id = $this->input->post('id', TRUE);

		$complete_menu = $this->Waiter_Model->get_first_menu($id);

		// if($complete_menu.sizeof())
		// $menu =  $complete_menu[0]['item_name'];

		if (sizeof($complete_menu) > 0) {
			$menu = '';
			foreach ($complete_menu as $menu_item) {
				$menu .= '<div class="col-md-3  col-sm-6 col-6 center" align="center" style="text-align: center;height:70%" disabled id="item_' . $menu_item['id'] . '"><img class="rounded shadow" src="' . $menu_item['item_image'] . '" width="125px" height="125px" ><p class="mt-2" style="color:#fff;font-size:12px;">' . $menu_item['item_name'] . '</p></div>';
			}
			echo $menu;
		} else {
			echo '<h1 class="text-white">No Data Found...</h1>';
		}
	}


	public function edit_order()
	{
		$uid = $this->session->userdata('uid');
		$this->load->model('Waiter_Model');
		$table_no = $this->input->post('table_no', TRUE);

		$current_order = $this->Waiter_Model->get_current_order($table_no);

		
		$echo_data = '';

		$total_amount = $current_order[0]['total_amount'];
		$discount = $current_order[0]['discount'];

		$this->session->set_userdata('discount', $discount);
		//items to explode
		$items = $current_order[0]['items'];
		$items = explode(',', $items);

		$quantities = $current_order[0]['quantity'];
		$quantities = explode(',', $quantities);

		$sizes = $current_order[0]['size'];
		$sizes = explode(',', $sizes);

		$items_amounts = $current_order[0]['items_amount'];
		$items_amounts = explode(',', $items_amounts);


		$items_length = sizeof($sizes);

		$this->session->set_userdata('beforeEditLen', $items_length);

		for ($i = 0; $i < $items_length; $i++) {

			$result = $this->Waiter_Model->get_item_id($items[$i]);

			$id = $result[0]['id'];

			$echo_data .= '<tr class=" item_to_delete item_unique_' . $uid . '" title="' . $uid . '"  id="menu_item_' . $id . '" >
						<td class=" p-2 mt-1 text-center item_name_' . $uid . '" id="item_name_' . $id . '">' . $items[$i] . '</td>
						<td class="p-2">
						<input class=" disabled  form-control item_size_' . $uid . '" id="item_size_' . $id . '" title="' . $uid . '" autocomplete="false" disabled  type="text" size="3" value="' . $sizes[$i] . '">
						</td>
						<td class="p-2">
						<input class=" disabled  form-control item_qty_' . $uid . '" id="item_qty_' . $id . '" title="' . $uid . '" autocomplete="false" disabled  type="text" size="3" value="' . $quantities[$i] . '" maxlength="3">
						</td>
						<td class="p-2 text-center  mt-1 item_amount_' . $uid . '" id="item_amount_' . $id . '" title="' . $uid . '">' . $items_amounts[$i] . '</td>
						<td class=" p-2 text-center "><Button  class="form-control btn-sm btn-danger btn_delete_' . $uid . '"  title="' . $uid . '"  id="btn_delete_' . $id . '" class="btn-sm btn-danger">Delete</Button></td>
						</tr>';


			$uid = $uid + 1;
			$this->session->set_userdata('uid', $uid);
		}





		echo $echo_data;
	}


	public function insert_current_order()
	{
		$this->load->model('Waiter_Model');
		$current_table = $this->input->post('current_table', TRUE);
		$itemNameData = $this->input->post('itemNameData', TRUE);
		$sizeData = $this->input->post('sizeData', TRUE);
		$qtyData = $this->input->post('qtyData', TRUE);
		$amountData = $this->input->post('amountData', TRUE);
		$totalAmount = $this->input->post('totalAmount', TRUE);
		$waiter = $this->input->post('waiter_name', TRUE);
		$discount = $this->input->post('discount', TRUE);
		$type = $this->input->post('type', TRUE);



		$result = $this->Waiter_Model->insert_current_order_data($current_table, $itemNameData, $sizeData, $qtyData, $amountData, $totalAmount, $waiter, $discount, $type);

		$qty_array = explode(",", $qtyData);
		$size_array = explode(",", $sizeData);
		$item_array = explode(",", $itemNameData);

		$this->session->set_userdata('waiter', $waiter);
		$this->session->set_userdata('table', $current_table);
		$this->session->set_userdata('type', $type);
		$this->session->set_userdata('order_no', $result);
		$this->session->set_userdata('fullTable', true);
		$this->session->set_userdata('qty_array', $qty_array);
		$this->session->set_userdata('size_array', $size_array);
		$this->session->set_userdata('item_array', $item_array);


		$items_length = sizeof($qty_array);
		$this->session->set_userdata('len', $items_length);


		echo $result;
	}


	public function printFullOrder()
	{
		$this->load->view('printFullOrder');
	}
}
