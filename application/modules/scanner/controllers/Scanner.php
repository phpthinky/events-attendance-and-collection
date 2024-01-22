<?php 

/**
 * 
 */
class Scanner extends MY_Controller
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}

	public function index($value='')
	{
		// code...
		$this->load->view('scanner/events');

	}
}
 ?>