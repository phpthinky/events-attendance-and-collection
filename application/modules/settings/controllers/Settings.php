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
            'semester'=>$this->input->post('semester'),
            'status'=>$this->input->post('status')
            );
          if ($sy_add['end_year'] < $sy_add['start_year']) {
            // code...
            echo json_encode(array('status'=>false,'msg'=>'Failed! Invalid school year.'));

            exit;
          }
          if($result = $this->msettings->addschoolyear($sy_add)){
          $this->load->model('students/mstudents');

           $this->mstudents->un_enrollall();

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
        $listschoolyear[$key]->sy_start_year = tomdy($value->start_year);
        $listschoolyear[$key]->sy_end_year =  tomdy($value->end_year);
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
        $listschoolyear[$key]->sy_start_year = tomdy($value->start_year);
        $listschoolyear[$key]->sy_end_year =  tomdy($value->end_year);
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
          $result = "Tables successfully emptied";
          $this->to_archived();
          
          $this->msettings->reset_all();

            break;
          
          case 'Restore':
            // code...
          $filename = $this->input->post('filename');
          $this->msettings->restoredb($filename);
            break;
          case 'Backup':
            // code...
          $this->to_archived();
            break;
          default:
            // code...
          $result = "No input received.";

            break;
        }
      }
      $data = new stdClass();
      $data->list_file = glob(UPLOADPATH.'/backup/*'); // get all file names;

      $data->action = $result;
      $data->content = 'settings/backup';
      $this->template->load($this->theme,$data);    

    }
    public function to_archived($value='')
    {
      // code...
      // Load the DB utility class
        $this->load->dbutil();
$prefs = array(
        'ignore'        => array('v_bayad','v_bayad_by_course','v_events_attendance','v_penalty_late','v_penalty_total'),                     // List of tables to omit from the backup
        'format'        => 'sql',                       // gzip, zip, txt
        'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
        'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
        'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
        'newline'       => "\n"                         // Newline character used in backup file
);
        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup($prefs);

        // Load the file helper and write the file to your server
        $this->load->helper('file');
        $date = date('Y-m-d-H-i-s');
        write_file(UPLOADPATH.'backup/event-backup-'.$date.'.sql', $backup);

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('event-backup'.$date.'.zip', $backup);

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


    public function restart_semester($value='')
    {
      // code...
      $action = null;
      if ($this->input->post()) {
        // code...
        $users = $this->aauth->get_user();

        if ($users->pass == $this->aauth->hash_password($this->input->post('cpassword'),$this->user_id)) {
         //$action = 'Current semester successfully ended'; 

         $current_sy = $this->msettings->endschoolyear();
         $this->load->model('students/mstudents');
         $this->mstudents->un_enrollall();
         $action = array('status'=>true,'msg'=>'Current semester successfully ended');  //echo json_encode(array('status'=>true,'msg'=>'Semester ended.'));
          //echo json_encode(array('status'=>true,'msg'=>'Semester ended.'));
        }else{
         $action = array('status'=>false,'msg'=>'Invalid password.');  //echo json_encode(array('status'=>true,'msg'=>'Semester ended.'));

        }
        //exit();
      }
      $data = new stdClass();
      $data->action = $action;
      $data->content = 'settings/new-semester';
      $this->template->load($this->theme,$data);    

    }


    public function site($value='')
    {
      // code...
      $data = new stdClass();

      if ($this->input->post()) {
        // code...
        $action = $this->input->post('action');
          switch ($action) {
            case 'logo':
            // code...

              $logo = base_url('assets/img/org-logo-sidebar.png');
              if (!empty($_FILES['logo']['name'])) {
                // code...
                //echo $_FILES['logo']['name'];

                $this->load->model('upload/mupload');
                if($logo =$this->mupload->site_logo('logo','sitelogo')){

              $postdata = new stdClass();
              $postdata->title = 'sitelogo';
              $postdata->value = $logo;
              $postdata->type = 'image';
              if($result = $this->msettings->site($postdata)){
              $data->errors = array('status'=>true,'msg'=>'Site logo successfully change.');

              }else{
              $data->errors = array('status'=>false,'msg'=>'No changes.');

                }
              }else{
              $data->errors = array('status'=>false,'msg'=>'No changes.');

              }

              }
            break;

            case 'loginlogo':
            // code...

              $logo = base_url('assets/img/org-logo.png');
              if (!empty($_FILES['loginlogo']['name'])) {
                // code...
                //echo $_FILES['logo']['name'];

                $this->load->model('upload/mupload');
                if($logo =$this->mupload->login_logo('loginlogo','loginlogo')){

              $postdata = new stdClass();
              $postdata->title = 'loginlogo';
              $postdata->value = $logo;
              $postdata->type = 'image';
              if($result = $this->msettings->site($postdata)){
              $data->errors = array('status'=>true,'msg'=>'Login logo successfully change.');

              }else{
              $data->errors = array('status'=>false,'msg'=>'No changes.');

                }
              }else{
              $data->errors = array('status'=>false,'msg'=>'No changes.');

              }

              }
            break;

            case 'site_title':
              var_dump($this->input->post());

            break;
          
          default:
            // code...
            break;
        }
      }
      $data->site_logo = $this->msettings->getsitelogo();
      $data->login_logo = $this->msettings->getloginlogo();

      $data->site_title = $this->msettings->getsitetitle();

      $data->content = 'settings/site';
      $this->template->load($this->theme,$data);    

    }

    public function set_sitetitle($value='')
    {
      // code...
      $postdata = new stdClass();
      $postdata->title = 'site_title';
      $postdata->value = $this->input->post('site_title');
      if($this->msettings->site($postdata)){
        echo json_encode(array('status'=>true,'msg'=>'Successfully updated.'));
      }else{
        echo json_encode(array('status'=>false,'msg'=>'No changes.'));
      }
    }

     
  }


?>

