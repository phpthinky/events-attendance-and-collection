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
          $this->settings_model->reset_all();
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
      $this->template->dashboard($data);    

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

