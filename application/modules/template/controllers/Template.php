<?php 
/**
 * 
 */
class Template extends MY_Controller
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}
	public function load($template,$data){
		$this->load->model('course/mcourse');
		$data->sidebar_course = $this->mcourse->list_side_course();

		$this->load->model('settings/settings_model');
		$data->sitelogo = $this->settings_model->getsitelogo();
		$data->sitetitle = $this->settings_model->getsitetitle();

		$this->load->view('template/'.$template,$data);
	}
}

 ?>