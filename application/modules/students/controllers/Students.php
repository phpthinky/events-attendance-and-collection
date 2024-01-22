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

		$this->load->model('students/mstudents');
		$this->load->model('events/mevents');
		$this->load->model('attendance/mattendance');
		$this->load->model('collections/mcollections');
		$this->load->model('course/mcourse');

	}
	public function index($value='')
	{
		// code...
		$data = new stdClass();
		$data->list_students = $this->mstudents->listbystudentsbypenalty();
		$data->courses = $this->mcourse->list();
		$data->id_number = 'ID'.date('Y').formatid($this->mstudents->last_id()+1);
		$data->hasTable = true;
		$data->content = 'students/index';
		$this->template->load($this->theme,$data);
	}
	public function course($course_sub_title='')
	{
		// code...
		$data = new stdClass();
		$course_id = $this->mcourse->get_id($course_sub_title);
		//$data->list_students = $this->mstudents->listbycourse($course_id);
		$data->list_students = $this->mattendance->list();
		$data->id_number = 'ID'.date('Y').formatid($this->mstudents->last_id()+1);
		
		$data->course_id = $course_id;
		$data->course_title = strtoupper($course_sub_title);	
		$data->hasTable = true;
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
				$student_course->year = $this->input->post('year');
				$student_course->grade = $this->input->post('grade');
				$student_course->section = $this->input->post('section');
				$student_course->status = 1;

			$student_info = new stdClass();
			$student_info->fName = $this->input->post('fName');
			$student_info->mName = $this->input->post('mName');
			$student_info->lName = $this->input->post('lName');
			$student_info->ext = $this->input->post('ext');
			$student_info->contact_no = $this->input->post('contact_no');
			$student_info->address1 = $this->input->post('address');
			$student_info->code = $this->input->post('student_id');

			$course_title = $this->mcourse->get_coursesubtitle($student_course->course_id);

			$student_qinfo = array(
				'name'=>$student_info->fName.' '.$student_info->lName,
				'course'=>$course_title.' '.$student_course->grade.'-'.$student_course->section
				);


			if ($result_id = $this->mstudents->add($student_info)) {
				// code...
			$this->toqrcode($student_info->code,json_encode($student_qinfo));

				$student_course->student_id = $student_info->code;
				$this->mstudents->save_course($student_course);
			}else{


				echo json_encode(array('status'=>false,'msg'=>'Student already exist. Used enrol student instead.'));
			}
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
					$data->info->section = $course->section;
					$data->info->grade = $course->grade;
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

				$student_course =  new stdClass();
				$student_course->course_id = $this->input->post('course');
				$student_course->year = $this->input->post('year');
				$student_course->grade = $this->input->post('grade');
				$student_course->section = $this->input->post('section');
				$student_course->student_id = $this->input->post('student_id');
				$student_course->status = 1;

			$student_info = new stdClass();
			$student_info->code = $this->input->post('student_id');
			$student_info->fName = $this->input->post('fName');
			$student_info->mName = $this->input->post('mName');
			$student_info->lName = $this->input->post('lName');
			$student_info->ext = $this->input->post('ext');
			$student_info->contact_no = $this->input->post('contact_no');
			$student_info->address1 = $this->input->post('address');
			//$student_info->code = 'ID'.date('Y').formatid($this->mstudents->last_id()+1);

			$course_title = $this->mcourse->get_coursesubtitle($student_course->course_id);

			$student_qinfo = array(
				'name'=>$student_info->fName.' '.$student_info->lName,
				'course'=>$course_title.' '.$student_course->grade.'-'.$student_course->section
				);


			if ($result_id = $this->mstudents->update($this->input->post('student_id'),$student_info)) {
				// code...
//			$this->toqrcode($student_info->code,json_encode($student_qinfo));

				$student_course->student_id = $$this->input->post('student_id');
				$this->mstudents->save_course($student_course);
			}else{


				echo json_encode(array('status'=>false,'msg'=>'Student already exist. Used enrol student instead.'));
			}
		}
	}

	public function toqrcode($code='',$gname='')
	{
		
		$data =json_encode(array($code,$gname));
		$qr_code_data = QrCode::create($data)
                 ->setSize(300)
                 ->setMargin(10);
               //  ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);
		$writer = new PngWriter;
		//$label = Label::create('Sablayan Tourism');
	/*	$logo = Logo::create(BASEPATH.'../assets/img/tourism_logo.png')
				->setResizeToWidth(100);
				*/
		$result = $writer->write($qr_code_data);
		//header("Content-Type: " . $result->getMimeType());

		//echo $result->getString();
	//	$qr_code = "QR".$code;
		$result->saveToFile(UPLOADPATH.$code.".png");
		return;// $code;

	}

}

 ?>