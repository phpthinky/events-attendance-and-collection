<?php /**
 * 
 */
class Dashboard extends MY_Controller
{
	
	function __construct()
	{
		// code...
		parent::__construct();
		if(!$this->aauth->is_loggedin()){
			redirect('login');
		}
		$this->load->model('students/mstudents');
	}
	public function index($site='')
	{
		// code...
		$data = new stdClass();
		   $data->total_students = $this->mstudents->total();
		   $data->affected_tfamily = 0;
		   $data->affected_tbarangay = 0;



		$data->content = 'dashboard/index';
		$this->template->load($this->theme,$data);
	}
} ?>