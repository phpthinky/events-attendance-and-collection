<?php 
/*
 *
 * 
 */
class Charts extends MY_Controller
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
		$this->load->model('charts/mcharts');


	}
	public function getCollectionData($year_id=0,$semester=0)
	{
		// code...
		$this->load->helper('colors');
		$result =$this->mcharts->getCollectionData($year_id,$semester);
		$data = array();

			$labels = array	();
			$first_semester	 = array();
			$second_semester	 = array();
			$total = array();
			$colors = array();
		if (!empty($result)) {
			// code...


			foreach ($result as $key => $value) {
				// code...
				/*
				$data[] = array(
					'course'=>$this->mcourse->get_coursesubtitle($value->course_id),
					'first_semester'=>$value->first_semester,
					'second_semester'=>$value->second_semester
				);

				*/
				array_push(	$labels	, $this->mcourse->get_coursesubtitle($value->course_id));
				array_push(	$first_semester	, $value->first_semester);
				array_push(	$second_semester	, $value->second_semester);
				array_push(	$total	, ($value->first_semester + $value->second_semester));

			}

		}
	echo json_encode(array('labels'=>$labels,'first'=>$first_semester,'second'=>$second_semester,'total'=>$total));

	}


public function getData($student_id)
{
	// code...
	if($result = $this->weighing_model->get($student_id)){
		$data = array();// array('status'=>true,'data'=>'');
		$a = array('upon_entry'=>'','20_days'=>'','40_days'=>'','terminal'=>'');


			$data_arr = array(
				0=>array('data'=>array(0,0,0,0),'label'=>"height"),
				1=>array('data'=>array(0,0,0,0),'label'=>"weight")
			);
			$i=0;
			$u_date = '';

		foreach ($result as $key => $value) {
			// code...


			if ($value->weighing_type == 1) {
				// code...
					$u_date = $value->date_weighing;
					$data_arr[0]['data'][0] = $value->weight;
					$data_arr[0]['label'] = 'Weight';
					$data_arr[0]['backgroundColor'] = get_colors(0);

					$data_arr[1]['data'][0] = $value->height;
					$data_arr[1]['label'] = "Height";
					$data_arr[1]['backgroundColor'] = get_colors(1);
			}

			if ($value->weighing_type == 2) {
				// code...
					$data_arr[0]['data'][1] = $value->weight;
					$data_arr[0]['label'] = 'Weight';
					$data_arr[0]['backgroundColor'] = get_colors(0);

					$data_arr[1]['data'][1] = $value->height;
					$data_arr[1]['label'] = "Height";
					$data_arr[1]['backgroundColor'] = get_colors(1);

			}
			if ($value->weighing_type == 3) {
				// code...
									$data_arr[0]['data'][2] = $value->weight;
					$data_arr[0]['label'] = 'Weight';
					$data_arr[0]['backgroundColor'] = get_colors(0);

					$data_arr[1]['data'][2] = $value->height;
					$data_arr[1]['label'] = "Height";
					$data_arr[1]['backgroundColor'] = get_colors(1);

			}
			if ($value->weighing_type == 4) {
				// code...
					$data_arr[0]['data'][3] = $value->weight;
					$data_arr[0]['label'] = 'Weight';
					$data_arr[0]['backgroundColor'] = get_colors(0);

					$data_arr[1]['data'][3] = $value->height;
					$data_arr[1]['label'] = "Height";
					$data_arr[1]['backgroundColor'] = get_colors(1);

			}
			$i++;
		}
		//$data['data'] = $a;
		echo json_encode(array('status'=>true,'data'=>$data_arr,'u_date'=>$u_date));
	}

}
//end class
}