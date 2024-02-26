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
		$this->load->model('collections/mcollections');
	}
	public function index($site='')
	{
		// code...
		$data = new stdClass();
		   $data->total_students = $this->mstudents->total();
		   $data->total_collections = $this->mcollections->get_totalCollections();
		$data->content = 'dashboard/index';
		$this->template->load($this->theme,$data);
	}
} ?>