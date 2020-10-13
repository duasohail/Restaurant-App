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
	public function del_order(){
		$table=$this->input->post('table',true);
		// echo $table_num;
		$this->load->model('Counter_Model');
		$this->Counter_Model->deleteCurrentOrder($table);

	
		// redirect('Counter/Counter');

	}

	
	public function open_print($table_no)
	{
		redirect('PagePrint');
	}
	public function update_table_order()
	{
		date_default_timezone_set("Asia/Karachi");
		$id = $this->input->post('id', TRUE);
		$this->load->model('Counter_Model');
		$order = $this->Counter_Model->table_order($id);
		//echo $id;

			// <h2 class="text-center mt-1 " style="text-align:center;">Paratha & Karak</h2>


		if (sizeof($order) > 0) {
			$current_bill = '<table  align="center" width="290" class="table w-25 m-0 p-0 text-center text-dark bg-light table_to_print" >
		<tr class="mb-2 ">
			<td  colspan="6" align="center">
			

		<img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />
			

			</td>
		</tr>
		
		<tr>
		<td colspan="6" class="text-dark text-center " id="table_head" style="text-align:center;"><h3>Order Receipt</h3></td>
		</tr>
		<tr>
		<td colspan="3" class="text-dark text-left" id="table_head">' . date("d M, Y") . '</td>
		<td colspan="3" class="text-dark text-right" style="text-align:right" id="table_head">' . date("h:ia") . '</td>
		</tr>
		
		<tr>
		<td colspan="2" class="text-dark text-left " id="table_head">Order #' . $order[0]['id'] . '</td><br>
		<td colspan="4" class="text-dark text-right " style="text-align:right"  id="table_head">Table #' . $order[0]['table_no'] . '</td><br>
		
		
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



				for($i=0; $i< $items_length ; $i++){
					$total += $item_prices[$i];

					$current_bill .= '<tr>
					<td class="text-left " style="text-align:left">'.$items[$i].'</td>
					<td class="text-center" style="text-align:center"> '.$quantities[$i].'</td>
					<td class="text-center" style="text-align:center">'.$sizes[$i].'</td>
					<td class="text-center" style="text-align:center">Rs.'.$item_prices[$i].'</td>
					</tr>';
				}


				$current_bill .= '<br></td> </tr>';
			}

			$current_bill .= '<tr><td></td><td class="text-center" style="text-align:center">Total</td><td></td><td class="text-center" style="text-align:center">Rs.' . $total;
			$current_bill .= '</td></tr>';
			
			$current_bill .= "<tr  ><td colspan='6'><h4 class='text-center' style='text-align:center'>____________________________</h4><div class='text-dark bg-light text-center' style='text-align:center'>Powered By XCL Technologies<br>022-6111826 <br>www.xcltechnologies.com</div></td> </tr>";

			$current_bill .= "</table>";

				$this->session->set_userdata('bill' , $current_bill);
				echo $current_bill;

		}
	}

	
}
