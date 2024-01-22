<?php 
/*
 *
 * 
 */
class Attendance extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('students/mstudents');
		$this->load->model('events/mevents');
		$this->load->model('attendance/mattendance');
		$this->load->model('collections/mcollections');
	}
	public function index($value='')
	{
		// code...
		$data = new stdClass();
		$data->hasScanner = true;
		$data->list_events = $this->mevents->list();
		$data->event_info = $this->mevents->get_currentevent();
		$data->content = 'attendance/index';
		$this->template->load($this->theme,$data);
	}
	public function start($event_id=0)
	{
		// code...

		$data = new stdClass();
		$data->hasScanner = true;
		$data->event_info = $this->mevents->info($event_id);
		if (!empty($data->event_info)) {
			// code...
			$this->mevents->update($event_id,array('status'=>1));
		}
		$data->list_events = $this->mevents->list();
		$data->content = 'attendance/index';
		$this->template->load($this->theme,$data);
	}
	public function record($value='')
	{
		// code...
		if ($this->input->post()) {
			// code...
			if (!$this->mstudents->getbyid($this->input->post('student_id'))) {
				// code...
				echo json_encode(array('status'=>false,'msg'=>'Student does not exist.'));
				exit();
			}
			if ($this->input->post('in_out_type') == 2) {
				// code...
				$this->record_afternoon();
				exit();
			}

			$find = array(

					'event_id'=>$this->input->post('event_id'),
					'student_id'=>$this->input->post('student_id'),
					'event_day'=>$this->input->post('event_day'),
					'time_in_type'=>$this->input->post('in_out_type'),
			);

			if ($this->mattendance->find($find)) {
				// code...
				echo json_encode(array('status'=>false,'msg'=>'Already time in!'));
				//exit();
			}

			$settings = $this->mcollections->settings();
			$event_info = $this->mevents->info($this->input->post('event_id'));



			$time_start = date('H:i:s',strtotime($event_info->morning_timein));

			$event_start = strtotime($event_info->event_startdate.' '.$time_start);
			$event_end = strtotime($event_info->event_enddate.' '.date('H:i:s',strtotime($event_info->afternoon_timeout)));
			$current_datetime = strtotime(date('Y-m-d H:i:s'));
			$is_late =0;
			$late_penalty_minutes = isset($settings->late_penalty_minutes) ? $settings->late_penalty_minutes : 30;
			

			if ($current_datetime >= $event_start && $current_datetime <=$event_end) {
				// code...
				$a_30minutes =  strtotime(date('Y-m-d '.$time_start,strtotime('+'.$late_penalty_minutes.' minutes')));
				
				//var_dump($a_30minutes);
				//exit();
				if ($current_datetime > $a_30minutes) {
					// code...
					$is_late = 1;
				}

			}

			echo "$is_late";

			exit();

			
			$current_time = date('Y-m-d H:i:s');

			$time_inout = $this->input->post('in_out');
			$result = false;
			if ($time_inout == 'in') {
				// code...

				$data =array(
					'event_id'=>$this->input->post('event_id'),
					'student_id'=>$this->input->post('student_id'),
					'timein'=>date('Y-m-d H:i:s'),
					'date_of_event'=>date('Y-m-d'),
					'event_day'=>$this->input->post('event_day'),
					'time_in_type'=>$this->input->post('in_out_type'),
					'penalty_late'=>$is_late
				);
				//$this->mattendance->add($data);
			}else{
					// code...
					$data =array(
						'event_id'=>$this->input->post('event_id'),
						'student_id'=>$this->input->post('student_id'),
						'timeout'=>date('Y-m-d H:i:s'),
						'date_of_event'=>date('Y-m-d'),
						'event_day'=>$this->input->post('event_day'),
						'time_in_type'=>$this->input->post('in_out_type'),
					);
				}
			}

			if($this->mattendance->add($data)){
				echo json_encode(array('status'=>true,'msg'=>'Successfully save!'));

			}else{
				echo json_encode(array('status'=>false,'msg'=>'Error! Please try again!'));
			}


	}

	public function record_afternoon($value='')
	{
		// code...
		if ($this->input->post()) {
			// code...
			$find = array(

					'event_id'=>$this->input->post('event_id'),
					'student_id'=>$this->input->post('student_id'),
					'event_day'=>$this->input->post('event_day'),
					'time_in_type'=>$this->input->post('in_out_type'),
			);
				$list_attendance = $this->mattendance->listbyevent($this->input->post('event_id'));

			if ($this->mattendance->find($find)) {
				// code...
				echo json_encode(array('status'=>false,'msg'=>'Already time in!','data'=>$list_attendance));
				exit();
			}

			$settings = $this->mcollections->settings();
			$event_info = $this->mevents->info($this->input->post('event_id'));

			$time_start = date('H:i:s',strtotime($event_info->afternoon_timein));
			$time_out = date('H:i:s',strtotime($event_info->afternoon_timeout));
			$event_start = strtotime($event_info->event_startdate.' '.$time_start);
			$event_end = strtotime($event_info->event_enddate.' '.date('H:i:s',strtotime($event_info->afternoon_timeout)));
			$current_datetime = strtotime(date('Y-m-d H:i:s'));
			$is_late =0;
			$late_penalty_minutes = isset($settings->late_penalty_minutes) ? $settings->late_penalty_minutes : 30;
			
			if ($current_datetime >= $event_start && $current_datetime <=$event_end) {
				// code...
				$a_lateminutes = strtotime(date('Y-m-d '.$time_start,strtotime('+'.$late_penalty_minutes.' minutes')));
				
				if ($current_datetime > $a_lateminutes) {
					// code...
					$is_late = 1;
				}

			}
			

			
			$current_time = date('Y-m-d H:i:s');

			$time_inout = $this->input->post('in_out');
			$result = false;
			if ($time_inout == 'in') {
				// code...

				$data =array(
					'event_id'=>$this->input->post('event_id'),
					'student_id'=>$this->input->post('student_id'),
					'timein'=>date('Y-m-d H:i:s'),
					'date_of_event'=>date('Y-m-d'),
					'event_day'=>$this->input->post('event_day'),
					'time_in_type'=>$this->input->post('in_out_type'),
					'penalty_late'=>$is_late
				);
				//$this->mattendance->add($data);
			}else{
					// code...
					$data =array(
						'event_id'=>$this->input->post('event_id'),
						'student_id'=>$this->input->post('student_id'),
						'timeout'=>date('Y-m-d H:i:s'),
						'date_of_event'=>date('Y-m-d'),
						'event_day'=>$this->input->post('event_day'),
						'time_in_type'=>$this->input->post('in_out_type'),
					);
				}
			}
			if($this->mattendance->add($data)){
				
				echo json_encode(array('status'=>true,'msg'=>'Successfully save!','data'=>$list_attendance));

			}else{
				echo json_encode(array('status'=>false,'msg'=>'Error! Please try again!'));
			}


	}
	public function create($value='')
	{
		// code...
		if ($this->input->post()) {
			// code...
			//var_dump($this->input->post());

			$data2add = new stdClass();
			$data2add->event_title = $this->input->post('event_title');
			$data2add->event_startdate = $this->input->post('event_startdate');
			$data2add->event_timestart = $this->input->post('event_timestart');
			$data2add->event_enddate = $this->input->post('event_enddate');
			$data2add->event_timeend = $this->input->post('event_timeend');
			//echo "<pre/>";
			//var_dump($this->input->post());


			$this->load->model('events/mevents');

			//if ($this->mevents->find(array('event_title'=>$data2add->event_title))) {
			if ($this->mevents->find($data2add)) {
				// code...
				echo json_encode(recordexist());
				exit();
			}
			$result = $this->mevents->add($data2add);
			var_dump($result);
			exit();	
		}
		
		$data = new stdClass();
		$data->content = 'events/create';
		$this->template->load($this->theme,$data);
	}
	public function listname($value='')
	{
		// code...
		$postdata = $this->input->post();

		$postdata['keywords'] = trim(metaphone($postdata['fName']).' '.metaphone($postdata['lName']));

		$names =$this->mpersonal->like($postdata);

		//echo json_encode($names);
		//exit;
		$data = array();
		$status = false;
		if ($names) {
			// code...
			foreach ($names as $key => $name) {
				// code...
				$data[] = array(
					'id'=>$name->id,
					'name'=>$name->fName.' '.$name->mName.' '.$name->lName,
				);
    		}
			$status = true;
		}
		echo json_encode(array('status'=>$status,'data'=>$data,'like'=>$postdata));
	}
}

 ?>