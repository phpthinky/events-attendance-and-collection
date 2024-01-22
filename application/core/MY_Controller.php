<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller
{	
	public $theme;
	protected $user_id;
	function __construct() 
	{
		parent::__construct();
		$this->_hmvc_fixes();
      	$this->theme = $this->config->item('theme');
      	if ($this->aauth->is_loggedin()) {
      		// code...
      		$this->user_id = $this->session->userdata('id');
      	}
	  $this->load->module('template');
      $this->load->model('barangay/barangay_model');
      $this->load->model('workers/workers_model');
      

	}
	
	function _hmvc_fixes()
	{		
		//fix callback form_validation		
		//https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
