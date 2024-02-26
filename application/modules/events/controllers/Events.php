<?php 
/*
 *
 * 
 */
class Events extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if (!$this->aauth->is_loggedin()) {
			// code...
			redirect('login');
		}
		$this->load->model('events/mevents');
		$this->load->model('collections/mcollections');
		$this->load->model('course/mcourse');
    	$this->load->model('settings/settings_model','msettings');

	}
	public function index($value='')
	{
		// code...
		$data = new stdClass();

		$data->list_events = $this->mevents->list('current');
		$data->list_events_completed = $this->mevents->list('completed');
		$data->list_events_incoming = $this->mevents->list('incoming');
		$data->list_events_canceled = $this->mevents->list('canceled');

		$data->content = 'events/list-2';
		$this->template->load($this->theme,$data);
	}
	public function create($value='')
	{
		
		$data = new stdClass();

		$data->year_id = 0;
    	$data->semester = 0;
		if($sy = $this->msettings->get_current_sy()){

		$data->year_id = $sy->id;
    	$data->semester = $sy->semester;	
		}
		$data->list_courses = $this->mcourse->list();
		$data->collections_settings = $this->mcollections->settings();
		$data->content = 'events/create_new';
		$this->template->load($this->theme,$data);
	}
	public function add($value='')
	{
		// code...

		// code...
		if ($this->input->post()) {
			// code...
			if ($this->input->post('event_id') > 0) {
				// code...
				$this->edit();
				exit;
			}
			$data2add = new stdClass();
			$data2add->event_title = $this->input->post('event_title');
			$data2add->event_startdate = $this->input->post('event_startdate');
			$data2add->event_enddate = $data2add->event_startdate;

			$has_afternoon = $this->input->post('has_afternoon');

			if ($has_afternoon == 0) {
				// code...


			$data2add->morning_timein = $this->input->post('morning_timein');
			$data2add->morning_timeout = $this->input->post('morning_timeout');
			$data2add->afternoon_timein = $this->input->post('afternoon_timein');
			$data2add->afternoon_timeout = $this->input->post('afternoon_timeout');
			
			}elseif($has_afternoon == 1){


			$data2add->morning_timein = $this->input->post('morning_timein');
			$data2add->morning_timeout = $this->input->post('morning_timeout');
			
			}else{

			$data2add->afternoon_timein = $this->input->post('afternoon_timein');
			$data2add->afternoon_timeout = $this->input->post('afternoon_timeout');
			
			}

			$data->has_afternoon = $has_afternoon;

			$data2add->late = $this->input->post('late');
			$data2add->absent = $this->input->post('absent');
			$data2add->year_id = $this->input->post('year_id');
			$data2add->semester = $this->input->post('semester');

			$no_days = $this->input->post('no_days');

			$attendees_course = $this->input->post('attendees_course');
			if (!is_array($attendees_course)) {
				// code...
				$attendees_course = array($attendees_course);
			}
			
			$attendees_year = $this->input->post('attendees_year');
			if (!is_array($attendees_year)) {
				// code...
				$attendees_year = array($attendees_year);
			}
			$data2add->attendees_course = json_encode($attendees_course,JSON_NUMERIC_CHECK);
			$data2add->attendees_year = json_encode($attendees_year,JSON_NUMERIC_CHECK);


			$this->load->model('events/mevents');

			if ($this->mevents->find(array('event_title'=>$data2add->event_title))) {
			//if ($this->mevents->find($data2add)) {
				// code...
				echo json_encode(recordexist());
				exit();
			}
			//if ($data2add->no_days > 1) {
				// code...
			$result = array();
			$days = 1;
					$title = $data2add->event_title;
			
				for ($i=0; $i < $no_days ; $i++) { 
					// code...
					$data2add->no_days = $days++;
					$result[] = $this->mevents->add($data2add);
					$data2add->event_startdate = date('Y-m-d',strtotime($data2add->event_startdate.' + 1 day'));
					$data2add->event_enddate = $data2add->event_startdate;
				}
				if (in_array(false,$result)) {
					// code...
				echo json_encode(array('status'=>false,'msg'=>'Some event days may not added.'));

				}else{
				echo json_encode(array('status'=>true,'msg'=>'Successfully added.'));

				}
			//}
			/*
			if($result = $this->mevents->add($data2add)){
				echo json_encode(array('status'=>true,'msg'=>'Successfully added.'));

			}else{
				echo json_encode(array('status'=>false,'msg'=>'No event was added.'));
			}
			*/
			//var_dump($result);
			exit();	
		}

	}

	public function edit($id=0)
	{
		// code...
		if ($this->input->post()) {
			// code...
			$data2add = new stdClass();
			$data2add->id = $this->input->post('event_id');
			$data2add->event_title = $this->input->post('event_title');
			$data2add->event_startdate = $this->input->post('event_startdate');
			$data2add->event_enddate = $this->input->post('event_startdate');


			$has_afternoon = $this->input->post('has_afternoon');

			if ($has_afternoon == 0) {
				// code...


			$data2add->morning_timein = $this->input->post('morning_timein');
			$data2add->morning_timeout = $this->input->post('morning_timeout');
			$data2add->afternoon_timein = $this->input->post('afternoon_timein');
			$data2add->afternoon_timeout = $this->input->post('afternoon_timeout');
			
			}elseif($has_afternoon == 1){


			$data2add->morning_timein = $this->input->post('morning_timein');
			$data2add->morning_timeout = $this->input->post('morning_timeout');
			
			}else{

			$data2add->afternoon_timein = $this->input->post('afternoon_timein');
			$data2add->afternoon_timeout = $this->input->post('afternoon_timeout');
			
			}

			$data->has_afternoon = $has_afternoon;


			$data2add->status = $this->input->post('status');
			$data2add->year_id = $this->input->post('year_id');
			$data2add->semester = $this->input->post('semester');
			
			$data2add->late = $this->input->post('late');
			$data2add->absent = $this->input->post('absent');



			$attendees_course = $this->input->post('attendees_course');
			if (!is_array($attendees_course)) {
				// code...
				$attendees_course = array($attendees_course);
			}
			
			$attendees_year = $this->input->post('attendees_year');
			if (!is_array($attendees_year)) {
				// code...
				$attendees_year = array($attendees_year);
			}
			$data2add->attendees_course = json_encode($attendees_course,JSON_NUMERIC_CHECK);
			$data2add->attendees_year = json_encode($attendees_year,JSON_NUMERIC_CHECK);


			$this->load->model('events/mevents');

			if($result = $this->mevents->update($data2add->id,$data2add)){
				echo json_encode(array('status'=>true,'msg'=>'Successfully updated.'));

			}else{
				echo json_encode(array('status'=>false,'msg'=>'No event was updated.'));
			}
			//var_dump($result);
			exit();	
		}
		
		$data = new stdClass();
		$data->event_info = $this->mevents->info($id);
		$data->list_courses = $this->mcourse->list();
		$courses = array();
		if($data->list_courses = $this->mcourse->list()){
			foreach ($data->list_courses as $key => $value) {
				// code...
				$courses[]=$value->id;
			}
		}
		$data->courses = $courses;

		$data->collections_settings = $this->mcollections->settings();
		$data->content = 'events/edit_new';
		$this->template->load($this->theme,$data);
	}
	public function attendees($id='')
	{
		// code...

		
		$data = new stdClass();
		$data->event_info = $this->mevents->info($id);

		$data->content = 'events/attendees';
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

	public function stop()
	{
		// code...
		if ($this->input->post()) {

			$current_sy = $this->msettings->get_current_sy();
			$year_id = $current_sy->id;
			$semester = $current_sy->semester;
			// code...
			if($this->mevents->update($this->input->post('event_id'),array('status'=>2,'date_completed'=>date('Y-m-d H:i:s')))){
				$info = $this->mevents->info($this->input->post('event_id'));
				var_dump($info); 
				$absents = array();
				if($absents = $this->mevents->list_absents($this->input->post('event_id'),$year_id,$semester)){
						 	
					foreach ($absents as $key => $value) {
						// code...
						$absent = array(
							'event_id'=>$this->input->post('event_id'),
							'penalty'=>$info->absent,
							'student_id'=>$value->student_id,
							'date_of_event'=>date('Y-m-d')
						);
						$result = $this->mevents->set_absent_penalty($absent);
					}
				}	 	

				$late_list = array();
				if($late_list = $this->mevents->list_late($this->input->post('event_id'))){
					foreach ($late_list as $key => $value) {
						// code...
						$late = array(
							'event_id'=>$this->input->post('event_id'),
							'penalty'=>$info->late,
							'student_id'=>$value->student_id,
							'date_of_event'=>date('Y-m-d')
						);
						$this->mevents->set_late_penalty($late);
					}
				}
				echo json_encode(array('status'=>true,'msg'=>'Event was stopped.'));
			}else{
				echo json_encode(array('status'=>false,'msg'=>'Event wasn\'t stop.'));

			}
		}else{
			echo json_encode(noinput());
		}
	}



public function canceled($event_id=0)
{
	// code...
	$this->load->model('mevents');

	$result = $this->mevents->update($event_id,array('status'=>3));
	echo json_encode(array('status'=>$result));
}














	///end classs
}

 ?>