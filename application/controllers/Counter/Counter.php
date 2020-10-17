<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Counter extends CI_Controller
{

	public function index()
	{
		$this->load->model('Waiter_Model');


		$tables_data = $this->Waiter_Model->get_tables();
		//print_r($tables_data);
		$data = [
			'title' => 'Counter',
			'tables_data' => $tables_data
		];


		$this->load->model('Counter_Model');
		$this->load->view('includes/main_header', $data);
		$this->load->view('Counter/counter');
		$this->load->view('includes/main_footer');
	}
	public function del_order()
	{
		$table = $this->input->post('table', true);
		$dis = $this->input->post('dis', true);
		$this->load->model('Counter_Model');
		$this->Counter_Model->deleteCurrentOrder($table , $dis);
	}
	public function del_order_by_order_number()
	{
		$order_no = $this->input->post('order_no', true);
		$dis = $this->input->post('dis', true);

		$this->load->model('Counter_Model');
		$this->Counter_Model->deleteCurrentOrder_byorder($order_no , $dis);
	}


	public function open_print($table_no)
	{
		redirect('PagePrint');
	}
	
	public function cancle_order_by_table()
	{
		date_default_timezone_set("Asia/Karachi");
		$table_no = $this->input->post('table_no', TRUE);
		$this->load->model('Counter_Model');

		
		$order = $this->Counter_Model->table_order($table_no);
		$this->Counter_Model->cancle_CurrentOrder($table_no);

		if (sizeof($order) > 0) {
			$current_bill = '<table   align="center" border="1"  cellpadding="2" style="border-collapse:collapse;border:#D3D3D3"  width="290" class="table w-25 m-0 p-0 text-center text-dark bg-light table_to_print" >
		<tr class="mb-2 " style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff" >
			<td  colspan="6" align="center">
			
			<img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />

			
			</td>
		</tr>
		
		<tr >
		<td  colspan="6" class="text-dark text-center order_recipt_text" id="table_head" style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-top: 1px inset #fff;text-align:center;"><h3>Cancled Order</h3></td>
		</tr>
		<tr >
		<td  colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">' . date("d M, Y") . '</td>
		<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . date("h:ia") . '</td>
		</tr>
		<tr>
		<td colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">Server</td>
		<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . $order[0]['waiter'] . '</td>
		</tr>
		
		<tr>
		<td colspan="2" class="text-dark text-left " style="border-right: 1px inset #fff" id="table_head">Order #' . $order[0]['id'] . '</td><br>
		<td colspan="4" class="text-dark text-right " style="text-align:right;"  id="table_head">Table #' . $order[0]['table_no'] . '</td><br>
		</tr>
		<tr>
			<th class="text-dark" style="text-align:left"><br>Items</th>
			<th class="text-dark" style="text-align:center"><br>Qty</th>
			<th class="text-dark" style="text-align:center"><br>Size</th>
			<th class="text-dark" style="text-align:center"><br>Price</th>
		</tr>';


			$total = 0;
			foreach ($order as $row) {
				$r_id = $row['id'];
				$it = $row['items'];
				$items = explode(",", $it);
				$quan = $row['quantity'];
				$quantities = explode(",", $quan);
				$sz = $row['size'];
				$sizes = explode(",", $sz);
				$it_pr = $row['items_amount'];
				$item_prices = explode(",", $it_pr);


				$items_length = sizeof($items);



				for ($i = 0; $i < $items_length; $i++) {
					if($sizes[$i] == 1){
						$size = '';
					}else{
						$size =$sizes[$i];
					}
					$total += $item_prices[$i];

					$current_bill .= '<tr>
					<td class="text-left " style="text-align:left">' . $items[$i] . '</td>
					<td class="text-center" style="text-align:center"> ' . $quantities[$i] . '</td>
					<td class="text-center" style="text-align:center">' . $size . '</td>
					<td class="text-center" style="text-align:center">Rs.' . $item_prices[$i] . '</td>
					</tr>';
				}


				$current_bill .= '<br></td> </tr>';
			}

			$discount = $order[0]['discount'];


			$temp = $total / 100;
			$discount_amount = $temp * $discount;
			$discount_total = $total - $discount_amount;


			// $current_bill .= '<tr ><td></td><td class="text-center" style="text-align:center"><b>Discount</b></td><td></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_amount . '</b>';
			// $current_bill .= '</td></tr>';
			$current_bill .= '<tr ><td></td><td class="text-center" style="text-align:center"><b>Total</b></td><td></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_total . '</b>';
			$current_bill .= '</td></tr>';

			$current_bill .= "<tr style='border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff'><td colspan='6'><h4 class='text-center' style='text-align:center'>____________________________</h4><div  class='text-dark bg-light text-center' style='text-align:center'>Powered By XCL Technologies<br>022-6111826 <br>www.xcltechnologies.com</div></td> </tr>";

			$current_bill .= "</table>";

			$this->session->set_userdata('bill', $current_bill);
			echo $current_bill;
		}

	}
	public function cancle_order_by_order_number()
	{
		$this->session->set_userdata('isCancled' , true);

		date_default_timezone_set("Asia/Karachi");
		$order_no = $this->input->post('order_no', TRUE);
		$this->load->model('Counter_Model');

		$order = $this->Counter_Model->get_order($order_no);

		$this->Counter_Model->cancle_CurrentOrder_byorder($order_no);


		

		if (sizeof($order) > 0) {
			$current_bill = '<table   align="center" border="1"  cellpadding="2" style="border-collapse:collapse;border:#D3D3D3"  width="290" class="table w-25 m-0 p-0 text-center text-dark bg-light table_to_print" >
			<tr class="mb-2 " style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff" >
				<td  colspan="6" align="center">
				
	
			<img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />
				
				</td>
			</tr>
			
			<tr >
			<td  colspan="6" class="text-dark text-center order_recipt_text" id="table_head" style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-top: 1px inset #fff;text-align:center;"><h3>Cancled Order</h3></td>
			</tr>
			<tr >
			<td  colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">' . date("d M, Y") . '</td>
			<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . date("h:ia") . '</td>
			</tr>
			<tr>
			<td colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">Server</td>
			<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . $order[0]['waiter'] . '</td>
			</tr>
		
		<tr>
		<td colspan="2" class="text-dark text-left " style="border-right: 1px inset #fff" id="table_head">Order #' . $order[0]['id'] . '</td><br>
		<td colspan="4" class="text-dark text-right " style="text-align:right"  id="table_head">'.$order[0]['type'].'</td><br>
		</tr>
		<tr>
			<th class="text-dark" style="text-align:left"><br>Items</th>
			<th class="text-dark" style="text-align:center"><br>Qty</th>
			<th class="text-dark" style="text-align:center"><br>Size</th>
			<th class="text-dark" style="text-align:center"><br>Price</th>
		</tr>';


			$total = 0;
			foreach ($order as $row) {
				$r_id = $row['id'];
				$it = $row['items'];
				$items = explode(",", $it);
				$quan = $row['quantity'];
				$quantities = explode(",", $quan);
				$sz = $row['size'];
				$sizes = explode(",", $sz);
				$it_pr = $row['items_amount'];
				$item_prices = explode(",", $it_pr);


				$items_length = sizeof($items);



				for ($i = 0; $i < $items_length; $i++) {
					$total += $item_prices[$i];

					if($sizes[$i] == 1){
						$size = '';
					}else{
						$size =$sizes[$i];
					}
					$current_bill .= '<tr>
					<td class="text-left " style="text-align:left">' . $items[$i] . '</td>
					<td class="text-center" style="text-align:center"> ' . $quantities[$i] . '</td>
					<td class="text-center" style="text-align:center">cancle' . $size . '</td>
					<td class="text-center" style="text-align:center">Rs.' . $item_prices[$i] . '</td>
					</tr>';
				}


				$current_bill .= '<br></td> </tr>';
			}

			$discount = $order[0]['discount'];


			$temp = $total / 100;
			$discount_amount = $temp * $discount;
			$discount_total = $total - $discount_amount;


			// $current_bill .= '<tr><td></td><td class="text-center" style="text-align:center"><b>Discount</b></td><td></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_amount . '</b>';
			// $current_bill .= '</td></tr>';
			$current_bill .= '<tr><td></td><td class="text-center" style="text-align:center"><b>Total</b></td><td></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_total . '</b>';
			$current_bill .= '</td></tr>';

			$current_bill .= "<tr  style='border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff'><td colspan='6'><h4 class='text-center' style='text-align:center'>____________________________</h4><div class='text-dark bg-light text-center' style='text-align:center'>Powered By XCL Technologies<br>022-6111826 <br>www.xcltechnologies.com</div></td> </tr>";

			$current_bill .= "</table>";

			$this->session->set_userdata('bill', $current_bill);
			echo $current_bill;
		}
	
	}

	public function update_table_order()
	{
		date_default_timezone_set("Asia/Karachi");
		$id = $this->input->post('id', TRUE);
		$this->load->model('Counter_Model');
		$order = $this->Counter_Model->table_order($id);

		if (sizeof($order) > 0) {
			if($order[0]['table_no'] <= 25){
				$area = 'Dinning';
			}else if($order[0]['table_no'] <= 50){
				$area = 'Roof';
			}else if($order[0]['table_no'] <= 75){
				$area = 'Lounge';
			}else if($order[0]['table_no'] <= 78){
				$area = 'Complimentry';
			}else if($order[0]['table_no'] <= 81){
				$area = 'Boss';
			} 
			$current_bill = '<table   align="center" border="1"  cellpadding="2" style="border-collapse:collapse;border:#D3D3D3"  width="290" class="table w-25 m-0 p-0 text-center text-dark bg-light table_to_print" >
		<tr class="mb-2 " style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff" >
			<td  colspan="6" align="center">
			

		<img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />
			
			</td>
		</tr>
		
		<tr >
		<td  colspan="6" class="text-dark text-center order_recipt_text" id="table_head" style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-top: 1px inset #fff;text-align:center;"><h3>Order Receipt</h3></td>
		</tr>
		<tr >
		<td  colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">' . date("d M, Y") . '</td>
		<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . date("h:ia") . '</td>
		</tr>
		<tr>
		<td colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">Server</td>
		<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . $order[0]['waiter'] . '</td>
		</tr>
		
		<tr>
		<td colspan="2" class="text-dark text-left " style="border-right: 1px inset #fff" id="table_head">' . $area . '</td><br>
		<td colspan="4" class="text-dark text-right " style="text-align:right;"  id="table_head">Table #' . $order[0]['table_no'] . '</td><br>
		</tr>
		<tr>
			<th class="text-dark" style="text-align:left"><br>Items</th>
			<th class="text-dark" style="text-align:center"><br>Qty</th>
			<th class="text-dark" style="text-align:center"><br>Size</th>
			<th class="text-dark" style="text-align:center"><br>Price</th>
		</tr>';


			$total = 0;
			foreach ($order as $row) {
				$r_id = $row['id'];
				$it = $row['items'];
				$items = explode(",", $it);
				$quan = $row['quantity'];
				$quantities = explode(",", $quan);
				$sz = $row['size'];
				$sizes = explode(",", $sz);
				$it_pr = $row['items_amount'];
				$item_prices = explode(",", $it_pr);


				$items_length = sizeof($items);



				for ($i = 0; $i < $items_length; $i++) {
					$total += $item_prices[$i];
					if($sizes[$i] == 1){
						$size = '';
					}else{
						$size =$sizes[$i];
					}
					$current_bill .= '<tr>
					<td class="text-left " style="text-align:left">' . $items[$i] . '</td>
					<td class="text-center" style="text-align:center"> ' . $quantities[$i] . '</td>
					<td class="text-center" style="text-align:center">' . $size . '</td>
					<td class="text-center" style="text-align:center">Rs.' . $item_prices[$i] . '</td>
					</tr>';
				}


				$current_bill .= '<br></td> </tr>';
			}

			$discount = $order[0]['discount'];


			$temp = $total / 100;
			$discount_amount = $temp * $discount;
			$discount_total = $total - $discount_amount;




			// $current_bill .= '<tr ><td></td><td class="text-center" style="text-align:center"><b>Discount</b></td><td></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_amount . '</b>';
			// $current_bill .= '</td></tr>';
			$current_bill .= '<tr ><td></td><td class="text-center" style="text-align:center"><b>Total</b></td><td></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_total . '</b>';
			$current_bill .= '</td></tr>';

			$current_bill .= "<tr style='border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff'><td colspan='6'><h4 class='text-center' style='text-align:center'>____________________________</h4><div  class='text-dark bg-light text-center' style='text-align:center'>Powered By XCL Technologies<br>022-6111826 <br>www.xcltechnologies.com</div></td> </tr>";

			$current_bill .= "</table>";

			$this->session->set_userdata('bill', $current_bill);
			echo $current_bill;
		}
	}
	public function updated_table_order()
	{
		date_default_timezone_set("Asia/Karachi");
		$id = $this->input->post('id', TRUE);
		$amountPaid = $this->input->post('amountPaid', TRUE);
		$this->load->model('Counter_Model');
		$order = $this->Counter_Model->table_order($id);

		if (sizeof($order) > 0) {
			if($order[0]['table_no'] <= 25){
				$area = 'Dinning';
			}else if($order[0]['table_no'] <= 50){
				$area = 'Roof';
			}else if($order[0]['table_no'] <= 75){
				$area = 'Lounge';
			}else if($order[0]['table_no'] <= 78){
				$area = 'Complimentry';
			}else if($order[0]['table_no'] <= 81){
				$area = 'Boss';
			}
			$current_bill = '<table   align="center" border="1"  cellpadding="2" style="border-collapse:collapse;border:#D3D3D3"  width="290" class="table w-25 m-0 p-0 text-center text-dark bg-light table_to_print" >
		<tr class="mb-2 " style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff" >
			<td  colspan="6" align="center">
			

		<img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />
			
			</td>
		</tr>
		
		<tr >
		<td  colspan="6" class="text-dark text-center order_recipt_text" id="table_head" style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-top: 1px inset #fff;text-align:center;"><h3>Order Receipt</h3></td>
		</tr>
		<tr >
		<td  colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">' . date("d M, Y") . '</td>
		<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . date("h:ia") . '</td>
		</tr>
		<tr>
		<td colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">Server</td>
		<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . $order[0]['waiter'] . '</td>
		</tr>
		
		<tr>
		<td colspan="2" class="text-dark text-left " style="border-right: 1px inset #fff" id="table_head">' . $area . '</td><br>
		<td colspan="4" class="text-dark text-right " style="text-align:right;"  id="table_head">Table #' . $order[0]['table_no'] . '</td><br>
		</tr>
		<tr>
			<th class="text-dark" style="text-align:left"><br>Items</th>
			<th class="text-dark" style="text-align:center"><br>Qty</th>
			<th class="text-dark" style="text-align:center"><br>Size</th>
			<th class="text-dark" style="text-align:center"><br>Price</th>
		</tr>';


			$total = 0;
			foreach ($order as $row) {
				$r_id = $row['id'];
				$it = $row['items'];
				$items = explode(",", $it);
				$quan = $row['quantity'];
				$quantities = explode(",", $quan);
				$sz = $row['size'];
				$sizes = explode(",", $sz);
				$it_pr = $row['items_amount'];
				$item_prices = explode(",", $it_pr);


				$items_length = sizeof($items);



				for ($i = 0; $i < $items_length; $i++) {
					$total += $item_prices[$i];
					if($sizes[$i] == 1){
						$size = '';
					}else{
						$size =$sizes[$i];
					}
					$current_bill .= '<tr>
					<td class="text-left " style="text-align:left">' . $items[$i] . '</td>
					<td class="text-center" style="text-align:center"> ' . $quantities[$i] . '</td>
					<td class="text-center" style="text-align:center">' . $size . '</td>
					<td class="text-center" style="text-align:center">Rs.' . $item_prices[$i] . '</td>
					</tr>';
				}


				$current_bill .= '<br></td> </tr>';
			}

			$discount = $order[0]['discount'];


			$temp = $total / 100;
			$discount_amount = $temp * $this->input->post('discount', TRUE);;
			$discount_total = $total - $discount_amount;



			$remainAmount = $amountPaid - $discount_total;

			
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Total</b></td><td class="text-center" style="text-align:center"><b>Rs.' . $total . '</b>';
			$current_bill .= '</td></tr>';
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Discount</b></td><<td class="text-center" style="text-align:center"><b>Rs.' . $discount_amount . '</b>';
			$current_bill .= '</td></tr>';
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Net Total</b></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_total . '</b>';
			$current_bill .= '</td></tr>';
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Amount Paid</b></td><td class="text-center" style="text-align:center"><b>Rs.' . $amountPaid . '</b>';
			$current_bill .= '</td></tr>';
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Remaing</b></td><td class="text-center" style="text-align:center"><b>Rs.' . $remainAmount . '</b>';
			$current_bill .= '</td></tr>';

			$current_bill .= "<tr style='border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff'><td colspan='6'><h4 class='text-center' style='text-align:center'>____________________________</h4><div  class='text-dark bg-light text-center' style='text-align:center'>Powered By XCL Technologies<br>022-6111826 <br>www.xcltechnologies.com</div></td> </tr>";

			$current_bill .= "</table>";

			$this->session->set_userdata('bill', $current_bill);
			echo $current_bill;
		}
	}
	
	
	
	public function update_delivery_order()
	{
		date_default_timezone_set("Asia/Karachi");
		$order_id = $this->input->post('order_id', TRUE);
		$this->load->model('Counter_Model');
		$order = $this->Counter_Model->get_order($order_id);
		//echo $id;

		// <h2 class="text-center mt-1 " style="text-align:center;">Paratha & Karak</h2>


		if (sizeof($order) > 0) {
			
			$current_bill = '<table   align="center" border="1"  cellpadding="2" style="border-collapse:collapse;border:#D3D3D3"  width="290" class="table w-25 m-0 p-0 text-center text-dark bg-light table_to_print" >
			<tr class="mb-2 " style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff" >
				<td  colspan="6" align="center">
				
	
			<img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />
				
				</td>
			</tr>
			
			<tr >
			<td  colspan="6" class="text-dark text-center order_recipt_text" id="table_head" style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-top: 1px inset #fff;text-align:center;"><h3>Order Receipt</h3></td>
			</tr>
			<tr >
			<td  colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">' . date("d M, Y") . '</td>
			<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . date("h:ia") . '</td>
			</tr>
			<tr>
			<td colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">Server</td>
			<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . $order[0]['waiter'] . '</td>
			</tr>
		
		<tr>
		<td colspan="2" class="text-dark text-left " style="border-right: 1px inset #fff" id="table_head">Order #' . $order[0]['id'] . '</td><br>
		<td colspan="4" class="text-dark text-right " style="text-align:right"  id="table_head">Delivery</td><br>
		</tr>
		<tr>
			<th class="text-dark" style="text-align:left"><br>Items</th>
			<th class="text-dark" style="text-align:center"><br>Qty</th>
			<th class="text-dark" style="text-align:center"><br>Size</th>
			<th class="text-dark" style="text-align:center"><br>Price</th>
		</tr>';


			$total = 0;
			foreach ($order as $row) {
				$r_id = $row['id'];
				$it = $row['items'];
				$items = explode(",", $it);
				$quan = $row['quantity'];
				$quantities = explode(",", $quan);
				$sz = $row['size'];
				$sizes = explode(",", $sz);
				$it_pr = $row['items_amount'];
				$item_prices = explode(",", $it_pr);


				$items_length = sizeof($items);



				for ($i = 0; $i < $items_length; $i++) {
					$total += $item_prices[$i];
					if($sizes[$i] == 1){
						$size = '';
					}else{
						$size =$sizes[$i];
					}
					$current_bill .= '<tr>
					<td class="text-left " style="text-align:left">' . $items[$i] . '</td>
					<td class="text-center" style="text-align:center"> ' . $quantities[$i] . '</td>
					<td class="text-center" style="text-align:center">' . $size . '</td>
					<td class="text-center" style="text-align:center">Rs.' . $item_prices[$i] . '</td>
					</tr>';
				}


				$current_bill .= '<br></td> </tr>';
			}

			$discount = $order[0]['discount'];


			$temp = $total / 100;
			$discount_amount = $temp * $discount;
			$discount_total = $total - $discount_amount;


			// $current_bill .= '<tr><td></td><td class="text-center" style="text-align:center"><b>Discount</b></td><td></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_amount . '</b>';
			// $current_bill .= '</td></tr>';
			$current_bill .= '<tr><td></td><td class="text-center" style="text-align:center"><b>Total</b></td><td></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_total . '</b>';
			$current_bill .= '</td></tr>';

			$current_bill .= "<tr  style='border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff'><td colspan='6'><h4 class='text-center' style='text-align:center'>____________________________</h4><div class='text-dark bg-light text-center' style='text-align:center'>Powered By XCL Technologies<br>022-6111826 <br>www.xcltechnologies.com</div></td> </tr>";

			$current_bill .= "</table>";

			$this->session->set_userdata('bill', $current_bill);
			echo $current_bill;
		}
	}
	public function updated_delivery_order()
	{
		date_default_timezone_set("Asia/Karachi");
		$order_id = $this->input->post('order_id', TRUE);
		$amountPaid = $this->input->post('amountPaid', TRUE);
		

		$this->load->model('Counter_Model');
		$order = $this->Counter_Model->get_order($order_id);
		//echo $id;

		// <h2 class="text-center mt-1 " style="text-align:center;">Paratha & Karak</h2>


		if (sizeof($order) > 0) {
			$current_bill = '<table   align="center" border="1"  cellpadding="2" style="border-collapse:collapse;border:#D3D3D3"  width="290" class="table w-25 m-0 p-0 text-center text-dark bg-light table_to_print" >
			<tr class="mb-2 " style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff" >
				<td  colspan="6" align="center">
				
	
			<img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />
				
				</td>
			</tr>
			
			<tr >
			<td  colspan="6" class="text-dark text-center order_recipt_text" id="table_head" style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-top: 1px inset #fff;text-align:center;"><h3>Order Receipt</h3></td>
			</tr>
			<tr >
			<td  colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">' . date("d M, Y") . '</td>
			<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . date("h:ia") . '</td>
			</tr>
			<tr>
			<td colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">Server</td>
			<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . $order[0]['waiter'] . '</td>
			</tr>
		
		<tr>
		<td colspan="2" class="text-dark text-left " style="border-right: 1px inset #fff" id="table_head">Order #' . $order[0]['id'] . '</td><br>
		<td colspan="4" class="text-dark text-right " style="text-align:right"  id="table_head">Delivery</td><br>
		</tr>
		<tr>
			<th class="text-dark" style="text-align:left"><br>Items</th>
			<th class="text-dark" style="text-align:center"><br>Qty</th>
			<th class="text-dark" style="text-align:center"><br>Size</th>
			<th class="text-dark" style="text-align:center"><br>Price</th>
		</tr>';


			$total = 0;
			foreach ($order as $row) {
				$r_id = $row['id'];
				$it = $row['items'];
				$items = explode(",", $it);
				$quan = $row['quantity'];
				$quantities = explode(",", $quan);
				$sz = $row['size'];
				$sizes = explode(",", $sz);
				$it_pr = $row['items_amount'];
				$item_prices = explode(",", $it_pr);


				$items_length = sizeof($items);



				for ($i = 0; $i < $items_length; $i++) {
					$total += $item_prices[$i];
					if($sizes[$i] == 1){
						$size = '';
					}else{
						$size =$sizes[$i];
					}
					$current_bill .= '<tr>
					<td class="text-left " style="text-align:left">' . $items[$i] . '</td>
					<td class="text-center" style="text-align:center"> ' . $quantities[$i] . '</td>
					<td class="text-center" style="text-align:center">' . $size . '</td>
					<td class="text-center" style="text-align:center">Rs.' . $item_prices[$i] . '</td>
					</tr>';
				}


				$current_bill .= '<br></td> </tr>';
			}

			// $discount = $order[0]['discount'];


			$temp = $total / 100;
			$discount_amount = $temp * $this->input->post('discount', TRUE);
			$discount_total = $total - $discount_amount;


			$remainAmount = $amountPaid - $discount_total;

			
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Total</b></td><td class="text-center" style="text-align:center"><b>Rs.' . $total . '</b>';
			$current_bill .= '</td></tr>';
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Discount</b></td><<td class="text-center" style="text-align:center"><b>Rs.' . $discount_amount . '</b>';
			$current_bill .= '</td></tr>';
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Net Total</b></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_total . '</b>';
			$current_bill .= '</td></tr>';
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Amount Paid</b></td><td class="text-center" style="text-align:center"><b>Rs.' . $amountPaid . '</b>';
			$current_bill .= '</td></tr>';
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Remaing</b></td><td class="text-center" style="text-align:center"><b>Rs.' . $remainAmount . '</b>';
			$current_bill .= '</td></tr>';


			$current_bill .= "<tr  style='border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff'><td colspan='6'><h4 class='text-center' style='text-align:center'>____________________________</h4><div class='text-dark bg-light text-center' style='text-align:center'>Powered By XCL Technologies<br>022-6111826 <br>www.xcltechnologies.com</div></td> </tr>";

			$current_bill .= "</table>";

			$this->session->set_userdata('bill', $current_bill);
			echo $current_bill;
		}
	}
	
	public function updated_takeaway_order()
	{
		date_default_timezone_set("Asia/Karachi");
		$order_id = $this->input->post('order_id', TRUE);
		$amountPaid = $this->input->post('amountPaid', TRUE);

		$this->load->model('Counter_Model');
		$order = $this->Counter_Model->get_order($order_id);
		//echo $id;

		// <h2 class="text-center mt-1 " style="text-align:center;">Paratha & Karak</h2>


		if (sizeof($order) > 0) {
			$current_bill = '<table   align="center" border="1"  cellpadding="2" style="border-collapse:collapse;border:#D3D3D3"  width="290" class="table w-25 m-0 p-0 text-center text-dark bg-light table_to_print" >
			<tr class="mb-2 " style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff" >
				<td  colspan="6" align="center">
				
	
			<img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />
				
				</td>
			</tr>
			
			<tr >
			<td  colspan="6" class="text-dark text-center order_recipt_text" id="table_head" style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-top: 1px inset #fff;text-align:center;"><h3>Order Receipt</h3></td>
			</tr>
			<tr >
			<td  colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">' . date("d M, Y") . '</td>
			<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . date("h:ia") . '</td>
			</tr>
			<tr>
			<td colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">Server</td>
			<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . $order[0]['waiter'] . '</td>
			</tr>
		
		<tr>
		<td colspan="2" class="text-dark text-left " style="border-right: 1px inset #fff" id="table_head">Order #' . $order[0]['id'] . '</td><br>
		<td colspan="4" class="text-dark text-right " style="text-align:right"  id="table_head">Take Away</td><br>
		</tr>
		<tr>
			<th class="text-dark" style="text-align:left"><br>Items</th>
			<th class="text-dark" style="text-align:center"><br>Qty</th>
			<th class="text-dark" style="text-align:center"><br>Size</th>
			<th class="text-dark" style="text-align:center"><br>Price</th>
		</tr>';


			$total = 0;
			foreach ($order as $row) {
				$r_id = $row['id'];
				$it = $row['items'];
				$items = explode(",", $it);
				$quan = $row['quantity'];
				$quantities = explode(",", $quan);
				$sz = $row['size'];
				$sizes = explode(",", $sz);
				$it_pr = $row['items_amount'];
				$item_prices = explode(",", $it_pr);


				$items_length = sizeof($items);



				for ($i = 0; $i < $items_length; $i++) {
					$total += $item_prices[$i];
					if($sizes[$i] == 1){
						$size = '';
					}else{
						$size =$sizes[$i];
					}
					$current_bill .= '<tr>
					<td class="text-left " style="text-align:left">' . $items[$i] . '</td>
					<td class="text-center" style="text-align:center"> ' . $quantities[$i] . '</td>
					<td class="text-center" style="text-align:center">' . $size . '</td>
					<td class="text-center" style="text-align:center">Rs.' . $item_prices[$i] . '</td>
					</tr>';
				}


				$current_bill .= '<br></td> </tr>';
			}

			$discount = $order[0]['discount'];


			$temp = $total / 100;
			$discount_amount = $temp * $this->input->post('discount', TRUE);;
			$discount_total = $total - $discount_amount;


			$remainAmount = $amountPaid - $discount_total;

			
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Total</b></td><td class="text-center" style="text-align:center"><b>Rs.' . $total . '</b>';
			$current_bill .= '</td></tr>';
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Discount</b></td><<td class="text-center" style="text-align:center"><b>Rs.' . $discount_amount . '</b>';
			$current_bill .= '</td></tr>';
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Net Total</b></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_total . '</b>';
			$current_bill .= '</td></tr>';
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Amount Paid</b></td><td class="text-center" style="text-align:center"><b>Rs.' . $amountPaid . '</b>';
			$current_bill .= '</td></tr>';
			$current_bill .= '<tr><td colspan="3" class="text-center" style="text-align:center"><b>Remaing</b></td><td class="text-center" style="text-align:center"><b>Rs.' . $remainAmount . '</b>';
			$current_bill .= '</td></tr>';


			$current_bill .= "<tr  style='border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff'><td colspan='6'><h4 class='text-center' style='text-align:center'>____________________________</h4><div class='text-dark bg-light text-center' style='text-align:center'>Powered By XCL Technologies<br>022-6111826 <br>www.xcltechnologies.com</div></td> </tr>";

			$current_bill .= "</table>";

			$this->session->set_userdata('bill', $current_bill);
			echo $current_bill;
		}
	}
	public function update_takeaway_order()
	{
		date_default_timezone_set("Asia/Karachi");
		$order_id = $this->input->post('order_id', TRUE);
		$this->load->model('Counter_Model');
		$order = $this->Counter_Model->get_order($order_id);
		//echo $id;
		// <h2 class="text-center mt-1 " style="text-align:center;">Paratha & Karak</h2>
		if (sizeof($order) > 0) {
			$current_bill = '<table   align="center" border="1"  cellpadding="2" style="border-collapse:collapse;border:#D3D3D3"  width="290" class="table w-25 m-0 p-0 text-center text-dark bg-light table_to_print" >
			<tr class="mb-2 " style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff" >
				<td  colspan="6" align="center">
				
	
			<img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />
				
				</td>
			</tr>
			
			<tr >
			<td  colspan="6" class="text-dark text-center order_recipt_text" id="table_head" style="border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-top: 1px inset #fff;text-align:center;" ><h3>Order Receipt</h3></td>
			</tr>
			<tr >
			<td  colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">' . date("d M, Y") . '</td>
			<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . date("h:ia") . '</td>
			</tr>
			<tr>
			<td colspan="3" class="text-dark text-left" style="border-right: 1px inset #fff" id="table_head">Server</td>
			<td colspan="3" class="text-dark text-right" style="text-align:right;" id="table_head">' . $order[0]['waiter'] . '</td>
			</tr>
		
		<tr>
		<td colspan="2" class="text-dark text-left " style="border-right: 1px inset #fff" id="table_head">Order #' . $order[0]['id'] . '</td><br>
		<td colspan="4" class="text-dark text-right " style="text-align:right"  id="table_head">Take Away</td><br>
		</tr>
		<tr>
			<th class="text-dark" style="text-align:left"><br>Items</th>
			<th class="text-dark" style="text-align:center"><br>Qty</th>
			<th class="text-dark" style="text-align:center"><br>Size</th>
			<th class="text-dark" style="text-align:center"><br>Price</th>
		</tr>';


			$total = 0;
			foreach ($order as $row) {
				$r_id = $row['id'];
				$it = $row['items'];
				$items = explode(",", $it);
				$quan = $row['quantity'];
				$quantities = explode(",", $quan);
				$sz = $row['size'];
				$sizes = explode(",", $sz);
				$it_pr = $row['items_amount'];
				$item_prices = explode(",", $it_pr);


				$items_length = sizeof($items);



				for ($i = 0; $i < $items_length; $i++) {
					$total += $item_prices[$i];
					if($sizes[$i] == 1){
						$size = '';
					}else{
						$size =$sizes[$i];
					}
					$current_bill .= '<tr>
					<td class="text-left " style="text-align:left">' . $items[$i] . '</td>
					<td class="text-center" style="text-align:center"> ' . $quantities[$i] . '</td>
					<td class="text-center" style="text-align:center">' . $size . '</td>
					<td class="text-center" style="text-align:center">Rs.' . $item_prices[$i] . '</td>
					</tr>';
				}


				$current_bill .= '<br></td> </tr>';
			}

			$discount = $order[0]['discount'];


			$temp = $total / 100;
			$discount_amount = $temp * $discount;
			$discount_total = $total - $discount_amount;


			// $current_bill .= '<tr><td></td><td class="text-center" style="text-align:center"><b>Discount</b></td><td></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_amount . '</b>';
			// $current_bill .= '</td></tr>';
			$current_bill .= '<tr><td></td><td class="text-center" style="text-align:center"><b>Total</b></td><td></td><td class="text-center" style="text-align:center"><b>Rs.' . $discount_total . '</b>';
			$current_bill .= '</td></tr>';

			$current_bill .= "<tr  style='border-right: 1px inset #fff;border-left: 1px inset #fff;border-top: 1px inset #fff;border-bottom: 1px inset #fff'><td colspan='6'><h4 class='text-center' style='text-align:center'>____________________________</h4><div class='text-dark bg-light text-center' style='text-align:center'>Powered By XCL Technologies<br>022-6111826 <br>www.xcltechnologies.com</div></td> </tr>";

			$current_bill .= "</table>";

			$this->session->set_userdata('bill', $current_bill);
			echo $current_bill;
		}
	}

	public function get_tablesData()
	{
		$this->load->model('Counter_Model');

		$result = $this->Counter_Model->current_order();

		$myData = '';

		$myData .= '<div class="col-12">
                	<h2 class="text-center text-white mt-1 mb-4">Tables</h2>
                </div>    
				<div class="col-12">';


		foreach ($result as $row) {

			if($row['table_no'] != '0'){
				if ($row['table_no'] < 10) {

					$myData .= '<button class="rounded-circle bg-danger btn-sm text-white text-center p-3 mb-1 mr-1" id="table_' . $row['table_no'] . '" >0' . $row['table_no'] . ' </button>';
				} else {
	
					$myData .= '<button class="rounded-circle bg-danger btn-sm text-white text-center p-3 mb-1 mr-1"  id="table_' . $row['table_no'] . '">' . $row['table_no'] . ' </button>';
				}
			}
		}


		$myData .=	'</div>';

		echo $myData;
	}
	
	public function get_deliveryData()
	{
		$this->load->model('Counter_Model');

		$result = $this->Counter_Model->current_order();

		$myData = '';

		$myData .= '<div class="col-12">
                	<h2 class="text-center text-white mt-1 mb-4">Delivery Orders</h2>
                </div>    
				<div class="col-12 orders_list">';


		foreach ($result as $row) {
			if($row['type'] == 'Delivery'){
				if ($row['id'] < 10) {
					$myData .= '<button class="rounded-circle bg-danger btn-sm text-white text-center p-3 mb-1 mr-1" id="order_' . $row['id'] . '" >0' . $row['id'] . '</button>';
				} else {
	
					$myData .= '<button class="rounded-circle bg-danger btn-sm text-white text-center p-3 mb-1 mr-1" id="order_' . $row['id'] . '">' . $row['id'] . ' </button>';
				}
			}
		}


		$myData .=	'</div>';

		echo $myData;
	}
	public function get_takeAwayData()
	{
		$this->load->model('Counter_Model');

		$result = $this->Counter_Model->current_order();

		$myData = '';

		$myData .= '<div class="col-12">
                	<h2 class="text-center text-white mt-1 mb-4">Take Away Orders</h2>
                </div>    
				<div class="col-12  orders_list">';


		foreach ($result as $row) {
			if($row['type'] == 'Take Away'){
				if ($row['id'] < 10) {

					$myData .= '<button class="rounded-circle bg-danger btn-sm text-white text-center p-3 mb-1 mr-1" id="order_' . $row['id'] . '" >0' . $row['id'] . ' </button>';
				} else {
	
					$myData .= '<button class="rounded-circle bg-danger btn-sm text-white text-center p-3 mb-1 mr-1" id="order_' . $row['id'] . '" >' . $row['id'] . ' </button>';
				}
			}
			
		}


		$myData .=	'</div>';

		echo $myData;
	}
}
