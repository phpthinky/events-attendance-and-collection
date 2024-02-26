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


			}else{
			$this->mevents->update($event_id,array('status'=>1));

			}
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

				$list_attendance = $this->mattendance->get_list($this->input->post('event_id'),date('Y-m-d'));

				$record_id = 0;
			if ($find = $this->mattendance->find($find)) {
				// code...
				$record_id = $find->id;
				if ($this->input->post('in_out') == 'in') {
					// code...	
						echo json_encode(array('status'=>false,'msg'=>'Already time in!','data'=>$list_attendance));
						exit();
				}else{
					if ($find->timeout !== null) {
						// code...
						echo json_encode(array('status'=>false,'msg'=>'Already time out!','data'=>$list_attendance));
						exit();

					}
				}
			}

			$settings = $this->mcollections->settings();
			$event_info = $this->mevents->info($this->input->post('event_id'));



			$time_start = date('H:i:s',strtotime($event_info->morning_timein));

			$event_start = $event_info->event_startdate.' '.$time_start;
			$event_end = strtotime($event_info->event_enddate.' '.$event_info->afternoon_timeout);
			$current_datetime = strtotime(date('Y-m-d H:i:s'));
			$is_late =0;
			$late_penalty_minutes = isset($settings->late_penalty_minutes) ? $settings->late_penalty_minutes : 30;
			
			$time_inout = $this->input->post('in_out');

		if ($time_inout =='in') {
				// code...

				$a_lateminutes = strtotime($event_start.('+'.$late_penalty_minutes.' minutes'));
			//echo "$a_lateminutes = $current_datetime";
				if ($current_datetime > $a_lateminutes) {
					// code...
					$is_late = 1;
				}
			}

			$current_time = date('Y-m-d H:i:s');

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
				$result = $this->mattendance->add($data);
			}else{
					// code...
					$data =array(
						'id'=>$record_id,
						'event_id'=>$this->input->post('event_id'),
						'student_id'=>$this->input->post('student_id'),
						'timeout'=>date('Y-m-d H:i:s'),
						'date_of_event'=>date('Y-m-d'),
						'event_day'=>$this->input->post('event_day'),
						'time_in_type'=>$this->input->post('in_out_type'),
					);
					//echo json_encode($record_id);
					//echo json_encode($data);
					//exit;
					$result = $this->mattendance->update((object)$data);
				}
			}
			if(!empty($result)){
				$tabledata = $this->mattendance->get_list($data['event_id'],$data['date_of_event']);
				echo json_encode(array('status'=>true,'msg'=>'Successfully save!','data'=>$tabledata));

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
				$list_attendance = $this->mattendance->get_list($this->input->post('event_id'),date('Y-m-d'));
				$record_id = 0;
			if ($find = $this->mattendance->find($find)) {
				// code...
				$record_id = $find->id;
				if ($this->input->post('in_out') == 'in') {
					// code...	
						echo json_encode(array('status'=>false,'msg'=>'Already time in!','data'=>$list_attendance));
						exit();
				}else{
					if ($find->timeout !== null) {
						// code...
						echo json_encode(array('status'=>false,'msg'=>'Already time out!','data'=>$list_attendance));
						exit();

					}
				}
			}

			//var_dump($record_id);

			//exit;

			$settings = $this->mcollections->settings();
			$event_info = $this->mevents->info($this->input->post('event_id'));

			$time_start = date('H:i:s',strtotime($event_info->afternoon_timein));
			$time_out = date('H:i:s',strtotime($event_info->afternoon_timeout));
			$event_start = $event_info->event_startdate.' '.$time_start;
			$event_end = strtotime($event_info->event_enddate.' '.$event_info->afternoon_timeout);
			$current_datetime = strtotime(date('Y-m-d H:i:s'));
			$is_late =0;
			$late_penalty_minutes = isset($settings->late_penalty_minutes) ? $settings->late_penalty_minutes : 30;
				
			$time_inout = $this->input->post('in_out');

		if ($time_inout =='in') {
				// code...
				$a_lateminutes = strtotime($event_start.('+'.$late_penalty_minutes.' minutes'));
			
				if ($current_datetime > $a_lateminutes) {
					// code...
					$is_late = 1;
				}
			}
			$current_time = date('Y-m-d H:i:s');

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
				$result = $this->mattendance->add($data);
			}else{
					// code...
					$data =array(
						'id'=>$record_id,
						'event_id'=>$this->input->post('event_id'),
						'student_id'=>$this->input->post('student_id'),
						'timeout'=>date('Y-m-d H:i:s'),
						'date_of_event'=>date('Y-m-d'),
						'event_day'=>$this->input->post('event_day'),
						'time_in_type'=>$this->input->post('in_out_type'),
					);
					//echo json_encode($record_id);
					//echo json_encode($data);
					//exit;
					$result = $this->mattendance->update((object)$data);
				}
			}
			if(!empty($result)){
				

				$tabledata = $this->mattendance->get_list($data['event_id'],$data['date_of_event']);
				echo json_encode(array('status'=>true,'msg'=>'Successfully save!','data'=>$tabledata));

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