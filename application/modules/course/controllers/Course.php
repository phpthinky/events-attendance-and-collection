<?php 
/*
 *
 * 
 */
class Course extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('course/mcourse');
	}
	public function index($value='')
	{
		// code...
		$data = new stdClass();

		$data->list_courses = $this->mcourse->list();

		$data->content = 'course/index';
		$this->template->load($this->theme,$data);
	}
	public function create($value='')
	{
		// code...
		if ($this->input->post()) {
			// code...
			$logo = base_url('assets/img/user.png');
			if (!empty($_FILES['logo']['name'])) {
				// code...
				//echo $_FILES['logo']['name'];

				$this->load->model('upload/mupload');
				$logo =$this->mupload->run('logo','logo');
			}
			//exit();
			$data2add = new stdClass();
			$data2add->course_title = $this->input->post('course_title');
			$data2add->course_sub_title = $this->input->post('course_sub_title');
			//$data2add->descritions = $this->input->post('descritions');
			$data2add->logo = $logo;

			//echo "<pre/>";
			//var_dump($this->input->post());


			$this->load->model('course/mcourse');

			//if ($this->mcourse->find(array('event_title'=>$data2add->event_title))) {
			if ($this->mcourse->find($data2add)) {
				// code...
				echo json_encode(recordexist());
				exit();
			}
			if($result = $this->mcourse->add($data2add)){
				echo json_encode(saveSuccess());
			}else{
				echo json_encode(saveFailed());
			}

			exit();	
		}
		
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