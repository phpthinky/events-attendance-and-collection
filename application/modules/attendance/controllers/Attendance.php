<?php 

class Attendance extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();

		if (!$this->aauth->is_allowed(1)) {
			// code...
			redirect('dashboard');
		}
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
		$this->load->model('course/mcourse');
		$data = new stdClass();
		$data->hasScanner = true;
		$data->event_info = $this->mevents->info($event_id);

		if (!empty($data->event_info)) {
			// code...
			if ($data->event_info->status == 3) {
				// do nothing
			}elseif($data->event_info->status == 0){
			$this->mevents->update($event_id,array('status'=>1));

			}else{
				// do nothing
			}
		}
		$data->event_info = $this->mevents->info($event_id);		
		$data->list_events = $this->mevents->list();
		$data->content = 'attendance/index';
		$this->template->load($this->theme,$data);
	}
	public function record($event_id=0)
	{
		// code...
		if($this->input->post()){
			$event_id = $this->input->post('event_id');
			$s_info = array();
			if (!$s_info = $this->mstudents->getbycode($this->input->post('student_id'))) {
				// code...
				echo json_encode(array('status'=>false,'msg'=>'Student does not exist.'));
				exit();
			}else{
				if (!empty($s_info)) {
					// code...
					if (!$this->mstudents->enrolled($this->input->post('student_id'))) {
						// code...
				echo json_encode(array('status'=>false,'msg'=>'Student is not enrolled.'));
						exit();
					}
					if(!$this->mevents->check_events_attendees($s_info->course_id,$s_info->grade,$this->input->post('event_id'))){

				echo json_encode(array('status'=>false,'msg'=>'Student is not allowed.'));

						exit();
					}
				}


				$event_info = $this->mevents->info($event_id);

				switch ($event_info->has_afternoon) {
					case 1:
						// code...
					$result = $this->morning();
						break;
					
					case 2:
						// code...
					$result = $this->afternoon();
						break;
					default:
						// code...
					$result = $this->wholeday();
						break;
				}
				echo json_encode($result);

				exit;
			}

		}
				echo json_encode(array('status'=>false,'msg'=>'No input received.'));

	}
	private function morning()
	{
	
			$event_id = $this->input->post('event_id');
			$student_id = $this->input->post('student_id');
			$in_out_type = $this->input->post('in_out_type');
			$finddata = array(
					'event_id'=>$event_id,
					'student_id'=>$student_id,
					'time_in_type'=>$in_out_type,
			);
			$is_late = 0;
			$find = null;
			if ($find = $this->mattendance->find($finddata)) {
				// code...
				if ($this->input->post('in_out') == 'in') {
					// code...	
						echo json_encode(array('status'=>false,'msg'=>'Already time in!'));
						exit();
				}else{
					if ($find->timeout !== null) {
						// code...
						echo json_encode(array('status'=>false,'msg'=>'Already time out!'));
						exit();

					}
				}
			}

			$settings = $this->mcollections->settings();

			$event_info = $this->mevents->info($event_id);


			$event_start = $event_info->event_startdate.' '.$event_info->morning_timein;
			$event_end = strtotime($event_info->event_enddate.' '.$event_info->morning_timeout);

			$current_datetime = strtotime(date('Y-m-d H:i:s'));

			$late_penalty_minutes = isset($settings->late_penalty_minutes) ? $settings->late_penalty_minutes.' minutes' : '30 minutes';
				
			

		$time_inout = $this->input->post('in_out');
				

		if ($time_inout =='in') {
				// code...
				$a_lateminutes = strtotime($event_start.('+'.$late_penalty_minutes));
			
				if ($current_datetime > $a_lateminutes) {
					// code...
					$is_late = 1;
				}

			$current_time = date('Y-m-d H:i:s');

			$result = false;

				$data =array(
					'event_id'=>$event_id,
					'student_id'=>$student_id,
					'timein'=>date('Y-m-d H:i:s'),
					'date_of_event'=>date('Y-m-d'),
					'event_day'=>$this->input->post('event_day'),
					'time_in_type'=>$in_out_type,
					'penalty_late'=>$is_late
				);
				$result = $this->mattendance->add($data);
			
			if ($result == true) {
							// code...
				$list_attendance = $this->mattendance->get_list($event_id,date('Y-m-d'));

				echo json_encode(array('status'=>true,'msg'=>'Time in success.','data'=>$list_attendance));
			}else{
				echo json_encode(array('status'=>false,'msg'=>'Time in failed.'));
			}
			exit;

			}


			if ($time_inout == 'out') {


				// code...
				if (!empty($find)) {
					// code...
					$data =  new stdClass();
					$data->timeout = date('Y-m-d H:i:s');
					$data->penalty_late = 0;

					if ($find->timein == null) {
						// code...
					$data->penalty_late = 1;
					} 

					$result = $this->mattendance->timeout($event_id,$student_id,$data);

				}else{

				$data =array(
					'event_id'=>$this->input->post('event_id'),
					'student_id'=>$this->input->post('student_id'),
					'timeout'=>date('Y-m-d H:i:s'),
					'date_of_event'=>date('Y-m-d'),
					'event_day'=>$this->input->post('event_day'),
					'time_in_type'=>$this->input->post('in_out_type'),
					'penalty_late'=>1
				);					
					$result = $this->mattendance->add($data);

				}



			
			if ($result == true) {
							// code...
				$list_attendance = $this->mattendance->get_list($event_id,date('Y-m-d'));

					echo json_encode(array('status'=>true,'msg'=>'Time out success.','data'=>$list_attendance));
				}else{
					echo json_encode(array('status'=>false,'msg'=>'Time out failed.'));

				}
			}
			exit;

	}
	private function afternoon()
	{
			$event_id = $this->input->post('event_id');
			$student_id = $this->input->post('student_id');
			$in_out_type = $this->input->post('in_out_type');
			$finddata = array(
					'event_id'=>$event_id,
					'student_id'=>$student_id,
					'time_in_type'=>$in_out_type,
			);
			$is_late = 0;
			$find = null;
			if ($find = $this->mattendance->find($finddata)) {
				// code...
				if ($this->input->post('in_out') == 'in') {
					// code...	
						echo json_encode(array('status'=>false,'msg'=>'Already time in!'));
						exit();
				}else{
					if ($find->timeout !== null) {
						// code...
						echo json_encode(array('status'=>false,'msg'=>'Already time out!'));
						exit();

					}
				}
			}

			$settings = $this->mcollections->settings();

			$event_info = $this->mevents->info($event_id);


			$event_start = $event_info->event_startdate.' '.$event_info->afternoon_timein;
			$event_end = strtotime($event_info->event_enddate.' '.$event_info->afternoon_timeout);

			$current_datetime = strtotime(date('Y-m-d H:i:s'));

			$late_penalty_minutes = isset($settings->late_penalty_minutes) ? $settings->late_penalty_minutes.' minutes' : '30 minutes';
				
			

		$time_inout = $this->input->post('in_out');
				

		if ($time_inout =='in') {
				// code...
				$a_lateminutes = strtotime($event_start.('+'.$late_penalty_minutes));
			
				if ($current_datetime > $a_lateminutes) {
					// code...
					$is_late = 1;
				}

			$current_time = date('Y-m-d H:i:s');

			$result = false;

				$data =array(
					'event_id'=>$event_id,
					'student_id'=>$student_id,
					'timein'=>date('Y-m-d H:i:s'),
					'date_of_event'=>date('Y-m-d'),
					'event_day'=>$this->input->post('event_day'),
					'time_in_type'=>$in_out_type,
					'penalty_late'=>$is_late
				);
				$result = $this->mattendance->add($data);
			
			if ($result == true) {
							// code...
				$list_attendance = $this->mattendance->get_list($event_id,date('Y-m-d'));

				echo json_encode(array('status'=>true,'msg'=>'Time in success.','data'=>$list_attendance));
			}else{
				echo json_encode(array('status'=>false,'msg'=>'Time in failed.'));
			}
			exit;

			}


			if ($time_inout == 'out') {


				// code...
				if (!empty($find)) {
					// code...
					$data =  new stdClass();
					$data->timeout = date('Y-m-d H:i:s');
					$data->penalty_late = 0;

					if ($find->timein == null) {
						// code...
					$data->penalty_late = 1;
					} 

					$result = $this->mattendance->timeout($event_id,$student_id,$data);

				}else{

				$data =array(
					'event_id'=>$this->input->post('event_id'),
					'student_id'=>$this->input->post('student_id'),
					'timeout'=>date('Y-m-d H:i:s'),
					'date_of_event'=>date('Y-m-d'),
					'event_day'=>$this->input->post('event_day'),
					'time_in_type'=>$this->input->post('in_out_type'),
					'penalty_late'=>1
				);					
					$result = $this->mattendance->add($data);

				}



			
			if ($result == true) {
							// code...
				$list_attendance = $this->mattendance->get_list($event_id,date('Y-m-d'));

					echo json_encode(array('status'=>true,'msg'=>'Time out success.','data'=>$list_attendance));
				}else{
					echo json_encode(array('status'=>false,'msg'=>'Time out failed.'));

				}
			}
			exit;

	}

	private function wholeday()
	{
		$in_out_type = $this->input->post('in_out_type');
		if ($in_out_type == 1) {
			// code...
			$this->record_am();
		}else{
			$this->record_pm();
		}
	}
	private function record_am(){

			$event_id = $this->input->post('event_id');
			$student_id = $this->input->post('student_id');
			$in_out_type = $this->input->post('in_out_type');
			$finddata = array(
					'event_id'=>$event_id,
					'student_id'=>$student_id
			);
			$is_late = 0;
			$find = null;
			if ($find = $this->mattendance->find($finddata)) {
				// code...
				if ($this->input->post('in_out') == 'in') {
					// code...	
						echo json_encode(array('status'=>false,'msg'=>'Already time in!'));
						exit();
				}else{
					if ($find->timeout !== null) {
						// code...
						echo json_encode(array('status'=>false,'msg'=>'Already time out!'));
						exit();

					}
				}
			}

			$settings = $this->mcollections->settings();

			$event_info = $this->mevents->info($event_id);


			$event_start = $event_info->event_startdate.' '.$event_info->morning_timein;
			$event_end = strtotime($event_info->event_enddate.' '.$event_info->morning_timeout);

			$current_datetime = strtotime(date('Y-m-d H:i:s'));

			$late_penalty_minutes = isset($settings->late_penalty_minutes) ? $settings->late_penalty_minutes.' minutes' : '30 minutes';
				
			

		$time_inout = $this->input->post('in_out');
				

		if ($time_inout =='in') {
				// code...
				$a_lateminutes = strtotime($event_start.('+'.$late_penalty_minutes));
			
				if ($current_datetime > $a_lateminutes) {
					// code...
					$is_late = 1;
				}

			$current_time = date('Y-m-d H:i:s');

			$result = false;

				$data =array(
					'event_id'=>$event_id,
					'student_id'=>$student_id,
					'timein'=>date('Y-m-d H:i:s'),
					'date_of_event'=>date('Y-m-d'),
					'event_day'=>$this->input->post('event_day'),
					'time_in_type'=>0,
					'penalty_late'=>$is_late
				);
				$result = $this->mattendance->add($data);
			
			if ($result == true) {
							// code...
				$list_attendance = $this->mattendance->get_list($event_id,date('Y-m-d'));

				return json_encode(array('status'=>true,'msg'=>'Time in success.','data'=>$list_attendance));
			}else{
				return json_encode(array('status'=>false,'msg'=>'Time in failed.'));
			}

			}


			if ($time_inout == 'out') {


				// code...
				if (!empty($find)) {
					// code...
					$data =  new stdClass();
					$data->timeout = date('Y-m-d H:i:s');
					$data->penalty_late = 0;

					if ($find->timein == null) {
						// code...
					$data->penalty_late = 1;
					} 

					$result = $this->mattendance->timeout($event_id,$student_id,$data);

				}else{

				$data =array(
					'event_id'=>$this->input->post('event_id'),
					'student_id'=>$this->input->post('student_id'),
					'timeout'=>date('Y-m-d H:i:s'),
					'date_of_event'=>date('Y-m-d'),
					'event_day'=>$this->input->post('event_day'),
					'time_in_type'=>0,
					'penalty_late'=>1
				);					
					$result = $this->mattendance->add($data);

				}



			
			if ($result == true) {
							// code...
				$list_attendance = $this->mattendance->get_list($event_id,date('Y-m-d'));

					return json_encode(array('status'=>true,'msg'=>'Time out success.','data'=>$list_attendance));
				}else{
					return json_encode(array('status'=>false,'msg'=>'Time out failed.'));

				}
			}


	}
	private function record_pm(){

			$event_id = $this->input->post('event_id');
			$student_id = $this->input->post('student_id');
			$in_out_type = $this->input->post('in_out_type');

			$finddata = array(
					'event_id'=>$event_id,
					'student_id'=>$student_id
			);
			$is_late = 0;
			$find = $this->mattendance->find($finddata);
			$settings = $this->mcollections->settings();

			$event_info = $this->mevents->info($event_id);


			$event_start = $event_info->event_startdate.' '.$event_info->morning_timein;
			$event_end = strtotime($event_info->event_enddate.' '.$event_info->morning_timeout);

			$current_datetime = strtotime(current_date());

			$late_penalty_minutes = isset($settings->late_penalty_minutes) ? $settings->late_penalty_minutes.' minutes' : '30 minutes';

			$time_inout = $this->input->post('in_out');
			if (!empty($find)) {
				// code...
				if ($time_inout == 'in' && $find->pm_in !== null) {
					// code...
					echo json_encode(array('status'=>false,'msg'=>'Already time in!'));
					exit;		
				}

				if ($time_inout == 'out' && $find->pm_out !== null) {
					// code...
					echo json_encode(array('status'=>false,'msg'=>'Already time out!'));
					exit;		
				}
			}


			if ($time_inout == 'in') {
				// code...

				$a_lateminutes = strtotime($event_start.('+'.$late_penalty_minutes));
			
				if ($current_datetime > $a_lateminutes) {
					// code...
					$is_late = 1;
				}
				$data = new stdClass();
				$data->penalty_late = $is_late;
				$data->pm_in = current_date();

				if (!empty($find)) {
					// code...
					$result = $this->mattendance->timein($event_id,$student_id,$data);
				}else{
	
				$data =array(
					'event_id'=>$event_id,
					'student_id'=>$student_id,
					'pm_in'=>current_date(),
					'date_of_event'=>date('Y-m-d'),
					'event_day'=>$this->input->post('event_day'),
					'time_in_type'=>0,
					'penalty_late'=>1
				);					
					$result = $this->mattendance->add($data);

				}

			if ($result == true) {
							// code...
				$list_attendance = $this->mattendance->get_list($event_id,date('Y-m-d'));

					echo json_encode(array('status'=>true,'msg'=>'Time in success.','data'=>$list_attendance));
				}else{
					echo json_encode(array('status'=>false,'msg'=>'Time in failed.'));

				}
			exit;

			}

			if ($time_inout == 'out') {
				// code...

				$a_lateminutes = strtotime($event_start.('+'.$late_penalty_minutes));
			
				if ($current_datetime > $a_lateminutes) {
					// code...
					$is_late = 1;
				}
				$data = new stdClass();
				$data->penalty_late = $is_late;
				$data->pm_out = current_date();

				if (!empty($find)) {
					// code...
					if ($find->pm_in == null) {
						// code...
						$data->penalty_late = 1;
					}
					$result = $this->mattendance->timeout($event_id,$student_id,$data);
				}else{
	
				$data =array(
					'event_id'=>$event_id,
					'student_id'=>$student_id,
					'pm_out'=>current_date(),
					'date_of_event'=>date('Y-m-d'),
					'event_day'=>$this->input->post('event_day'),
					'time_in_type'=>0,
					'penalty_late'=>1
				);					
					$result = $this->mattendance->add($data);

				}

			if ($result == true) {
							// code...
				$list_attendance = $this->mattendance->get_list($event_id,date('Y-m-d'));

					echo json_encode(array('status'=>true,'msg'=>'Time out success.','data'=>$list_attendance));
				}else{
					echo json_encode(array('status'=>false,'msg'=>'Time out failed.'));

				}
			exit;

			}


	}

	public function end($value='')
	{
		// code...
	}
	public function cancel($value='')
	{
		// code...
	}

	//end class

}