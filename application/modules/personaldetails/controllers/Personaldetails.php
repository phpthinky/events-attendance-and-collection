<?php 

/**
 * 
 */
class Personaldetails extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('personaldetails_model','mpersonal');
	}
	public function index($value='')
	{
		// code...
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