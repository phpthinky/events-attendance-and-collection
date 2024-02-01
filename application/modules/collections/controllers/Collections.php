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
		
		if (!$this->aauth->is_loggedin()) {
			// code...
			redirect('login');
		}
		if (!$this->aauth->is_allowed(2)) {
			// code...
			redirect('dashboard');
		}
		$this->load->model('students/mstudents');
		$this->load->model('collections/mcollections');
		$this->load->model('settings/settings_model','msettings');
		$this->load->model('course/mcourse');


	}
	public function index($value='')
	{
		// code...
		$data = new stdClass();
		$data->sy = $this->msettings->listschoolyear();

		//$data->list_all = $this->mcollections->list();
		$data->content = 'collections/chart';
		$this->template->load($this->theme,$data);
	}

	public function first($value='')
	{
		// code...
	
		if ($this->input->post()) {
			// code...
		$list_all = $this->mcollections->list_1stsemester($this->input->post('year_id'),$this->input->post('course_id'));
		if (!empty($list_all)) {
			// code...
			foreach ($list_all as $key => $value) {
				// code...
				$info = $this->mstudents->info($value->student_id);

				$list_all[$key]->student_name = $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext;
				$list_all[$key]->course_id = $info->course_id;
				$list_all[$key]->grade = $info->grade;
				$list_all[$key]->section = $info->section;
				$list_all[$key]->course = $info->course_sub_title;
			}
		}


		if (!empty($list_all)) {
			// code...
			echo json_encode(array('status'=>false,'data'=>$list_all));

		}else{
			echo json_encode(array('status'=>false,'data'=>false));
		}
		
			exit();
		}

		$data = new stdClass();

		$sy = $this->msettings->get_current_sy();
		$list_all = $this->mcollections->list_1stsemester($sy->id);
		$list_students = array();
		if (!empty($list_all)) {
			// code...
			foreach ($list_all as $key => $value) {
				// code...
				$info = $this->mstudents->info($value->student_id);

				$list_all[$key]->student_name = $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext;
				$list_all[$key]->course_id = $info->course_id;
				$list_all[$key]->grade = $info->grade;
				$list_all[$key]->section = $info->section;
				$list_all[$key]->course = $info->course_sub_title;
			}
		}
		$data->semester = 1;

		$data->list_courses = $this->mcourse->list();
		$data->sy = $this->msettings->listschoolyear();

		$data->list_students = $list_all;

		
		$data->content = 'collections/index';
		$this->template->load($this->theme,$data);
	}

	public function second($value='')
	{
		// code...
		
		if ($this->input->post()) {
			// code...
		$list_all = $this->mcollections->list_2ndsemester($this->input->post('year_id'),$this->input->post('course_id'));
		if (!empty($list_all)) {
			// code...
			foreach ($list_all as $key => $value) {
				// code...
				$info = $this->mstudents->info($value->student_id);

				$list_all[$key]->student_name = $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext;
				$list_all[$key]->course_id = $info->course_id;
				$list_all[$key]->grade = $info->grade;
				$list_all[$key]->section = $info->section;
				$list_all[$key]->course = $info->course_sub_title;
			}
		}
		if (!empty($list_all)) {
			// code...
			echo json_encode(array('status'=>false,'data'=>$list_all));

		}else{
			echo json_encode(array('status'=>false,'data'=>false));
		}

			exit();
		}
		$data = new stdClass();

		$sy = $this->msettings->get_current_sy();
		$list_all = $this->mcollections->list_2ndsemester($sy->id);
		$list_students = array();
		if (!empty($list_all)) {
			// code...
			foreach ($list_all as $key => $value) {
				// code...
				$info = $this->mstudents->info($value->student_id);

				$list_all[$key]->student_name = $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext;
				$list_all[$key]->course_id = $info->course_id;
				$list_all[$key]->grade = $info->grade;
				$list_all[$key]->section = $info->section;
				$list_all[$key]->course = $info->course_sub_title;
			}
		}

		$data->list_courses = $this->mcourse->list();
		$data->sy = $this->msettings->listschoolyear();
		$data->semester = 2;

		$data->list_students = $list_all;
		$data->content = 'collections/index';
		$this->template->load($this->theme,$data);
	}

	public function scanner($student_id='')
	{
		// code...

		$data = new stdClass();

		//$mga_utang = $this->mcollections->getlatebystudentid($student_id);

		$mga_utang	 = array();
		if($mga_late = $this->mcollections->listlatepenaltybystudentid($student_id)){
				foreach ($mga_late as $key => $value) {
					// code...
					$mga_utang[$key] = $value;
					$mga_utang[$key]->bayarin = $value->penalty;
					$mga_utang[$key]->type ='late';
				}
		}
		if($mga_absent = $this->mcollections->listabsentpenaltybystudentid($student_id)){
				foreach ($mga_absent as $key1 => $value1) {
					// code...
					$mga_utang[$key1] = $value1;
					$mga_utang[$key1]->bayarin = $value->penalty;
					$mga_utang[$key]->type ='absent';

				}
		}

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
	public function pay($value='')
	{
		// code...
		$this->load->model('events/mevents');
		$event_id = $this->input->post('event_id');
		$student_id = $this->input->post('student_id');
		$amount_paid = $this->input->post('amount_paid');

		$current_sem = $this->msettings->getcurrentsem();
		$current_sy = $this->msettings->get_current_sy();
		if ($this->input->post('type') == 'late') {
			// code...
		
		if ($info = $this->mcollections->getlatepenalty($event_id,$student_id)) {
			// code...
			if ($amount_paid !== $info->late_fee) {
				// code...
				//echo json_encode(array());
				echo json_encode(array('status'=>false,'msg'=>'Late! Please pay exact amount only.'));
				

			}else{

				$data_paid = array(
					'event_id'=>$this->input->post('event_id'),
					'student_id'=>$this->input->post('student_id'),
					'amount_pay'=>$this->input->post('amount_paid'),
					'penalty_late'=>$this->input->post('amount_paid'),
					'date_of_payment'=>date('Y-m-d H:i:s'),
					'semester'=>$current_sem,
					'year_id'=>$current_sy->id
				);
				$this->mcollections->add($data_paid);
				$this->mevents->pay_late($data_paid);
				echo json_encode(array('status'=>true,'msg'=>'Successfully paid sample message.'));


			}
				exit();

		}
		exit();
		}
		if ($this->input->post('type') == 'absent') {

		if ($info = $this->mcollections->getabsentpenalty($event_id,$student_id)) {
			// code...
			if ($amount_paid !== $info->penalty) {
				// code...
				echo json_encode(array('status'=>false,'msg'=>'Absent! Please pay exact amount only.'));
				
			}else{
				$data_paid = array(
					'event_id'=>$this->input->post('event_id'),
					'student_id'=>$this->input->post('student_id'),
					'amount_pay'=>$this->input->post('amount_paid'),
					'penalty_absent'=>$this->input->post('amount_paid'),
					'date_of_payment'=>date('Y-m-d H:i:s'),
					'semester'=>$current_sem,
					'year_id'=>$current_sy->id

				);
				$this->mcollections->add($data_paid);
				$this->mevents->pay_absent($data_paid);

				echo json_encode(array('status'=>true,'msg'=>'Your absent was successfully paid.'));

			}
				exit();

		}
				exit();
		
		}

		echo json_encode(array('status'=>false,'msg'=>$this->input->post()));
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