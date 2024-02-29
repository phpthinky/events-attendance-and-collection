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
		$this->theme = 'public';

		$this->load->model('students/mstudents');
		$this->load->model('collections/mcollections');
	}

	public function index($value='')
	{
		// code...
		if ($this->input->post()){
			// code...
			$this->scanned();
			exit();
		}
		//$this->load->view('scanner/events');
		$data = new stdClass();
		$data->content = 'scanner/info';
		$this->template->load($this->theme,$data);
	}

	private function scanned($student_id='')
	{
		// code...
		$student_id = $this->input->post('student_id');
		$mga_utang	 = array();
		if($mga_late = $this->mcollections->listlatepenaltybystudentid($student_id)){
				foreach ($mga_late as $key => $value) {
					// code...
					$mga_utang[$key] = $value;
					$mga_utang[$key]->bayarin = $value->penalty;
					$mga_utang[$key]->type = 'late';
				}
		}
		if($mga_absent = $this->mcollections->listabsentpenaltybystudentid($student_id)){
				foreach ($mga_absent as $key1 => $value1) {
					// code...
					$mga_utang[$key1] = $value1;
					$mga_utang[$key1]->bayarin = $value1->penalty;
					$mga_utang[$key1]->type = 'absent';

				}
		}

		$info =$this->mstudents->getbycode($student_id);
		if (!empty($info)) {
			// code...
			$info->student_name = trim($info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext);
		}
		//var_dump($mga_utang);
		$utang_info = array();
			$utang_info['info']=$info;
			$utang_info['utang']=$mga_utang;

			echo json_encode(array('status'=>true,'msg'=>'Scanning completed.','data'=>$utang_info));
	}

	public function info($student_id='')
	{
		// code...

		$mga_utang = null;
		$info = null;
		if (!empty($student_id)) {
			// code...
			$student_id = urldecode($student_id);
			$mga_utang	 = array();
		if($mga_late = $this->mcollections->listlatepenaltybystudentid($student_id)){
				foreach ($mga_late as $key => $value) {
					// code...
					$mga_utang[$key] = $value;
					$mga_utang[$key]->bayarin = $value->penalty;
					$mga_utang[$key]->type = 'late';
				}
		}
		if($mga_absent = $this->mcollections->listabsentpenaltybystudentid($student_id)){
				foreach ($mga_absent as $key1 => $value1) {
					// code...
					$mga_utang[$key1] = $value1;
					$mga_utang[$key1]->bayarin = $value1->penalty;
					$mga_utang[$key1]->type = 'absent';

				}
		}

		$info =$this->mstudents->getbycode($student_id);
		if (!empty($info)) {
			// code...
			$info->student_name = trim($info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext);
		}
		}
		$data = new stdClass();
		$data->mga_utang =(object) array('info'=>$info,'utang'=>$mga_utang);
		$data->content = 'scanner/info2';
		$this->template->load($this->theme,$data);
	}
//end class

}
 ?>