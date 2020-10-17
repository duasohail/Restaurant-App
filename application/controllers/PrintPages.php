<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class PrintPages extends CI_Controller {

	public function index()
	{
		$this->load->view('print_receipts');

	}

}
