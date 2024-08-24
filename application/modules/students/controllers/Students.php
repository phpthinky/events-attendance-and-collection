<?php 

/**
 * 
 */


use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Alignment\LabelAlignmentLeft;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

class Students extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();

		if (!$this->aauth->is_loggedin()) {
			// code...
			redirect('login');
		}
		$this->load->model('students/mstudents');
		$this->load->model('events/mevents');
		$this->load->model('attendance/mattendance');
		$this->load->model('collections/mcollections');
		$this->load->model('course/mcourse');
		$this->load->model('settings/settings_model','msettings');

	}
	public function index($value='')
	{
		// code...
		$data = new stdClass();


      $listschoolyear =array();
    if($listschoolyear = $this->msettings->listschoolyear()){
      foreach ($listschoolyear as $key => $value) {
        // code...
        $listschoolyear[$key]->sy_status = schoolyear_status($value->status);
        $listschoolyear[$key]->sy_start_year = monthyear($value->start_year);
        $listschoolyear[$key]->sy_end_year =  monthyear($value->end_year);
      }
    }
    $data->listschoolyear = $listschoolyear;

		$data->list_students = $this->mstudents->listbystudentsbypenalty();
		$data->courses = $this->mcourse->list();
		$data->id_number = 'ID'.date('Y').formatid($this->mstudents->last_id()+1);
		$data->hasTable = true;
		$data->hasScanner = true;

		$data->content = 'students/index';
		$this->template->load($this->theme,$data);
	}
	public function course($course_sub_title='')
	{
		// code...
		$data = new stdClass();


      $listschoolyear =array();
    if($listschoolyear = $this->msettings->listschoolyear()){
      foreach ($listschoolyear as $key => $value) {
        // code...
        $listschoolyear[$key]->sy_status = schoolyear_status($value->status);
        $listschoolyear[$key]->sy_start_year = monthyear($value->start_year);
        $listschoolyear[$key]->sy_end_year =  monthyear($value->end_year);
      }
    }
    $data->listschoolyear = $listschoolyear;

		$course_id = $this->mcourse->get_id($course_sub_title);
		$data->list_students = $this->mstudents->listbycourse($course_id);
		//var_dump($data);
		//exit;
		//$data->list_students = $this->mattendance->list();
		$data->id_number = 'ID'.date('Y').formatid($this->mstudents->last_id()+1);
		
		$data->course_id = $course_id;
		$data->course_title = strtoupper($course_sub_title);	
		$data->hasTable = true;
		$data->hasScanner = true;
		$data->courses = $this->mcourse->list();

		$data->content = 'students/course';
		$this->template->load($this->theme,$data);
	}

	public function find()
	{

		$student_name = array(
			'fName'=>$this->input->post('fName'),
			'mName'=>$this->input->post('mName'),
			'lName'=>$this->input->post('lName'),
			'ext'=>$this->input->post('ext'),
		);
		if($info = $this->mstudents->find($student_name)){
			echo json_encode(array('status'=>false,'msg'=>'Student found!','data'=>$info));
		}else{
			echo json_encode(array('status'=>true,'msg'=>'No student found.'));

		}

	}

	public function find_id()
	{

		$id_check = array(
			'code'=>$this->input->post('student_id')
		);
		if($info = $this->mstudents->find($id_check)){
			echo json_encode(array('status'=>false,'msg'=>'Student found!','data'=>$info));
		}else{
			echo json_encode(array('status'=>true,'msg'=>'No student found.'));

		}

	}
	public function add_students($course='')
	{
		// code...
		if ($this->input->post()) {
			// code...

				$student_course =  new stdClass();
				$student_course->course_id = $this->input->post('course');
				$student_course->grade = $this->input->post('grade');
				$student_course->section = $this->input->post('section');
				$student_course->status = $this->input->post('status');
				$student_course->year_id = $this->input->post('year_id');
				$student_course->semester = $this->input->post('semester');

			$student_info = new stdClass();
			$student_info->fName = $this->input->post('fName');
			$student_info->mName = $this->input->post('mName');
			$student_info->lName = $this->input->post('lName');
			$student_info->ext = $this->input->post('ext');
			$student_info->contact_no = $this->input->post('contact_no');
			$student_info->address1 = $this->input->post('address');
			$student_info->code = $this->input->post('student_id');

			if ($this->mstudents->check_idnumber($this->input->post('student_id'))) {
				// code...
				echo json_encode(array('status'=>false,'msg'=>'Failed! ID is already taken!'));
				exit();
			}
			$course_title = $this->mcourse->get_coursesubtitle($student_course->course_id);

			$student_qinfo = array(
				'name'=>$student_info->fName.' '.$student_info->lName,
				'course'=>$course_title.' '.$student_course->grade.'-'.$student_course->section
				);


			if ($result_id = $this->mstudents->add($student_info)) {
				// code...
				$this->toqrcode($student_info->code);
				$student_course->student_id = $student_info->code;
				$this->mstudents->save_course($student_course);

				$schoolyear = array(
					'student_id'=>$this->input->post('student_id'),
					'year_id'=>$this->input->post('year_id'),
					'semester'=>$this->input->post('semester'),
					'status'=>1
				);
				$this->mstudents->en_roll($schoolyear);
				echo json_encode(array('status'=>true,'msg'=>'Student successfull added.'));


			}else{


				echo json_encode(array('status'=>false,'msg'=>'Student already exist. Used enrol student instead.'));
			}
		}else{
			echo json_encode(noinput());
		}
	}

	public function edit($student_id='')
	{

		$data = new stdClass();
		$data->info = $this->mstudents->getbyid($student_id);
		//var_dump($data->info);
		if (!empty($data->info)) {
			// code...
			$course = $this->mstudents->getCourse($student_id);

					$data->info->course_id = $course->course_id;
					$data->info->year = $course->year;
					$data->info->semester = $course->semester;
					$data->info->section = $course->section;
					$data->info->grade = $course->grade;
					$data->info->status = $course->status;
					$data->info->year_id = $course->year_id;

		}
		//exit();
		$data->courses = $this->mcourse->list();
	
		$data->content = 'students/students-edit';
		$this->template->load($this->theme,$data);	
	}
	public function save_edited($student_id='')
	{
		// code...
		if ($this->input->post()) {
			// code...

			$student_info = new stdClass();
			$student_info->code = $this->input->post('student_id');
			$student_info->fName = $this->input->post('fName');
			$student_info->mName = $this->input->post('mName');
			$student_info->lName = $this->input->post('lName');
			$student_info->ext = $this->input->post('ext');
			$student_info->contact_no = $this->input->post('contact_no');
			$student_info->address1 = $this->input->post('address');
			//$result1 = true;
		$result1 = $this->mstudents->update_by_code($student_info);


				$student_course =  new stdClass();
				$student_course->course_id = $this->input->post('course');
				$student_course->semester = $this->input->post('semester');
				$student_course->grade = $this->input->post('grade');
				$student_course->section = $this->input->post('section');
				$student_course->student_id = $this->input->post('student_id');
				$student_course->status = $this->input->post('status');
		$result2  =  $this->mstudents->save_course($student_course);



				// code...
//			$this->toqrcode($student_info->code,json_encode($student_qinfo));
			if ($result1 && $result2) {
					// code...
			
			echo json_encode(array('status'=>true,'msg'=>'Student updated successfully.'));

			}

			else{
				if (!$result1) {
					// code...
					$msg = "Details error!";
				}

				if (!$result2) {
					// code...
					$msg = "Course error!";
				}

				echo json_encode(array('status'=>false,'msg'=>'Student details may not updated.Error: '.$msg));
			}
		}else{
			echo json_encode(noinput());
		}
	}

	public function toqrcode($code='')
	{
		

		$data =site_url('scanner/info?qrcode=').$code;
		$qr_code_data = QrCode::create($data)
                 ->setSize(300)
                 ->setMargin(10);
		$writer = new PngWriter;
		$label = Label::create('STUDENT GOVERNMENT');
		//$logo = Logo::create(UPLOADPATH.'org-logo.png')
			//	->setResizeToWidth(100);
		$result = $writer->write($qr_code_data,null,label:$label);
		//header("Content-Type: " . $result->getMimeType());

		//echo $result->getString();
	//	$qr_code = "QR".$code;
		$result->saveToFile(UPLOADPATH.'qrcode'.DIRECTORY_SEPARATOR.$code.".png");
		return;// $code;

	}
	public function info($id_number='')
	{
		// code...
		$data = new stdClass();

		$data->info = $this->mstudents->getbycode($id_number);
		if($events_penalty = $this->mattendance->getbystudentid($id_number)){
				foreach ($events_penalty as $key => $value) {
					// code...
					$event_info = $this->mevents->info($value->event_id);
					$events_penalty[$key]->event_title = $event_info->event_title;
					$events_penalty[$key]->am_in = $value->timein;
					$events_penalty[$key]->am_out = $value->timeout;
					
				}
		}
		$data->events_penalty = $events_penalty;

		$data->content = 'students/info';
		$this->template->load($this->theme,$data);
	}
	public function change_profile($value='')
	{
		// code...
		if ($this->input->post()) {
			// code...
				$data = new stdClass();
				$data->code = $this->input->post('student_id');
				$this->load->model('upload/mupload');
				$profile =$this->mupload->profile('profile','profile');
				$data->profile_photo = $profile;
				if($this->mstudents->update_by_code($data)){
					echo json_encode(array('status'=>true,'msg'=>'Profile successfully change.'));
				}else{
					echo json_encode(array('status'=>false,'msg'=>'No changes.'));

				}
		}
	}

	public function scanned($student_id='')
	{
		// code...
		//echo json_encode($this->input->post());

		if($info = $this->mstudents->getbycode($this->input->post('student_id'))){
			echo json_encode(array('status'=>true,'msg'=>'Student found!','data'=>$info));
		}else{
			echo json_encode(array('status'=>false,'msg'=>'No student found.'));

		}
	}
	public function quick_edit($value='')
	{
		// code...
		$data = array(
			'year_id'=>$this->input->post('year_id'),
			'course_id'=>$this->input->post('course'),
			'year'=>$this->input->post('year'),
			'semester'=>$this->input->post('year'),
			'grade'=>$this->input->post('grade'),
			'section'=>$this->input->post('section'),
			'status'=>$this->input->post('status'),
		);
		if($this->mstudents->quick_update($this->input->post('student_id'),$data)){

			echo json_encode(array('status'=>true,'msg'=>'Successfully updated'));
		}else{
			echo json_encode(array('status'=>false,'msg'=>'No student found.'));

		}

	}

	public function register($value='')
	{
		// code...
		if ($this->input->post()) {
			// code...
			$action = $this->input->post('action');
			if ($action == 'approved') {
				// code...
				$result = $this->mstudents->approved($this->input->post('student_id'));
			echo json_encode(array('status'=>true,'msg'=>'Added to students','error'=>$result));

			}
			if ($action == 'disapproved') {
				// code...
				$this->mstudents->remove($this->input->post('student_id'));

			echo json_encode(array('status'=>false,'msg'=>'Student was removed'));

			}

			exit();
		}
		$data = new stdClass();
		$data->list_students = $this->mstudents->register();
		$data->content = 'students/list_register';
		$this->template->load($this->theme,$data);
	}

	//end class

}

 ?>