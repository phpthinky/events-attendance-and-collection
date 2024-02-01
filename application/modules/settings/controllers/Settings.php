<?php 

/**
  * 
  */
 class Settings extends MY_Controller
 {
 	
 	function __construct()
 	{
 		// code...
 		parent::__construct();
   
    if (!$this->aauth->is_loggedin() && !$this->aauth->is_admin()) {
      // code...
      redirect();
    }
    /*
    if (!$this->aauth->is_admin()) {
      // code...
      redirect('permission/deny');
    }
    */
    $this->load->model('settings/settings_model','msettings');
 	}
 	public function index()
 	{


    $data = new stdClass();
 		$data->content = 'settings/index';
    $this->template->load($this->theme,$data);
  }

  public function schoolyear()
  {

    if ($this->input->post()) {
      // code...
      switch ($this->input->post('action')) {
        case 'add':
          // code...
          $sy_add = array(
            'start_year'=>$this->input->post('start_year'),
            'end_year'=>$this->input->post('end_year'),
            'status'=>$this->input->post('status')
            );
          if ($sy_add['end_year'] < $sy_add['start_year']) {
            // code...
            echo json_encode(array('status'=>false,'msg'=>'Failed! Invalid school year.'));

            exit;
          }
          if($result = $this->msettings->addschoolyear($sy_add)){
            echo json_encode(array('status'=>true,'msg'=>'Added successfully.'));
          }else{
            echo json_encode(array('status'=>false,'msg'=>'Failed! No data was added.'));

          }
          break;

        case 'edit':
          // code...
          $sy_add = array(
            'id'=>$this->input->post('year_id'),
            'start_year'=>$this->input->post('start_year'),
            'end_year'=>$this->input->post('end_year'),
            'status'=>$this->input->post('status')
            );

          if($result = $this->msettings->editschoolyear($sy_add)){
            echo json_encode(array('status'=>true,'msg'=>'Updated successfully.'));
          }else{
            echo json_encode(array('status'=>false,'msg'=>'Failed! No data was updated.'));

          }
          break;
        case 'trash':

          if($this->msettings->trashschoolyear($this->input->post('year_id'))){
            echo json_encode(array('status'=>true,'msg'=>'Move to trash.'));

          }
          break;
        
        default:
          // code...
        echo json_encode(noinput());
          break;
      }

      exit();
    }
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
    $data->content = 'settings/schoolyear';
    $this->template->load($this->theme,$data);
  }

  public function listschoolyears($value='')
  {
    // code...
      $listschoolyear =array();
    if($listschoolyear = $this->msettings->listschoolyear()){
      foreach ($listschoolyear as $key => $value) {
        // code...
        $listschoolyear[$key]->sy_status = schoolyear_status($value->status);
        $listschoolyear[$key]->sy_start_year = monthyear($value->start_year);
        $listschoolyear[$key]->sy_end_year =  monthyear($value->end_year);
      }
    }

    echo json_encode($listschoolyear);
  }
  

  public function semester($value='')
  {
    // code...
    if ($this->input->post()) {
      // code...
      $this->msettings->setsemestersettings(array('current_semester'=>$this->input->post('semester')));
      echo json_encode(array('status'=>true,'msg'=>'Settings successfully set.'));
      exit();
    }

    $data = new stdClass();

    $data->settings = $this->msettings->getsemestersettings();
    
    $data->content = 'settings/semester';
    $this->template->load($this->theme,$data);
  }



    public function address($value='')
    {
      $result = false; //$this->msettings->add_address($barangay,$town,$povince);
      $data = new stdClass();
      $data->action = $result;
      $data->content = 'settings/address';
      $this->template->load($this->theme,$data);    

    }
    public function backup($value='')
    {
      // code...
      $result = false;
      if ($this->input->post()) {
        // code...
        $form = $this->input->post('form');
        switch ($form) {
          case 'Reset':
            // code...
          $result = "Tables successfully emptied".
          $this->msettings->reset_all();
            break;
          
          default:
            // code...
          $result = "No input received.";

            break;
        }
      }
      $data = new stdClass();
      $data->action = $result;
      $data->content = 'settings/backup';
      $this->template->load($this->theme,$data);    

    }

    public function permissions($value='')
    {
      // code...
      $result = array();
     // $result[]=$this->aauth->create_perm('Tourguide'); 1
     // $result[]=$this->aauth->create_perm('Guest'); 2
      //$result['tourguide'] = $this->aauth->allow_group(4,1);
      //$result['guest'] = $this->aauth->allow_group(3,2);

      $result['is admin allowed'] = $this->aauth->is_allowed('Guest',3);
      var_dump($result);
    }
  }


?>

