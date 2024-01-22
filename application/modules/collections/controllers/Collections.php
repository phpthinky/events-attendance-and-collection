<?php 
/*
 *
 * 
 */
class Collections extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('students/mstudents');
		$this->load->model('collections/mcollections');
	}
	public function index($value='')
	{
		// code...
		$data = new stdClass();

		$data->list_all = $this->mcollections->list();
		$data->content = 'collections/index';
		$this->template->load($this->theme,$data);
	}

	public function first($value='')
	{
		// code...
	
		$data = new stdClass();
		$data->content = 'collections/index';
		$this->template->load($this->theme,$data);
	}

	public function second($value='')
	{
		// code...
		
		$data = new stdClass();
		$data->content = 'collections/index';
		$this->template->load($this->theme,$data);
	}

	public function scanner($student_id='')
	{
		// code...

		$data = new stdClass();

		$mga_utang = $this->mcollections->getutangbystudentid($student_id);
		$info =$this->mstudents->getbycode($student_id);
		//var_dump($mga_utang);
		$utang_info = array();
			$utang_info['info']=$info;
			$utang_info['utang']=$mga_utang;

			//var_dump($utang_info);
			//exi
		$data->mga_utang = (object)$utang_info;
		$data->hasScanner = true;
		$data->content = 'collections/scanner';
		$this->template->load($this->theme,$data);
	}

	public function scanned($student_id='')
	{
		// code...
		$student_id = $this->input->post('student_id');
		$mga_utang = $this->mcollections->getutangbystudentid($student_id);
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
	public function settings($value='')
	{
		// code...

		if ($this->input->post()) {
			// code...
			$postdata = array(
				'late_penalty'=>$this->input->post('late_penalty'),
				'late_penalty_minutes'=>$this->input->post('late_penalty_minutes'),
				'absent_penalty'=>$this->input->post('absent_penalty'),
			);
			if($this->mcollections->setSettings($postdata)){
				echo json_encode(array('status'=>true));
			}else{
				echo json_encode(array('status'=>false));

			}
			exit();
		}

		$data = new stdClass();
		$data->settings = $this->mcollections->settings();
		$data->content = 'collections/settings';
		$this->template->load($this->theme,$data);	}
}

 ?>