<?php 


/**
  * 
  */
 class Barangay extends MY_Controller
 {
   
   function __construct()
   {
     // code...
    parent::__construct();

    $this->load->model('barangay_model','mbarangay');

    $this->load->model('calamity/calamity_model','mcalamity');
    $this->load->model('disaster/disaster_model','mdisaster');
   }
   public function index()
   {
     // code...
    $data = new stdClass();

    $data->content = 'barangay/index';

    $this->template->load($this->theme,$data);
   }
   public function list_barangay($town_id=2)
   {
     // code...
    $result = $this->mbarangay->listall($town_id);
          
    echo json_encode(array('status'=>true,'data'=>$result));

   }

   public function list_town($province_id=3)
   {
     // code...
    $result = $this->mbarangay->listall(0,$province_id);

      $data = array();
      $data[] = array('value'=>'0','text'=>'Select town/city...');
    if (!empty($result)) {
        // code...
      foreach ($result as $key => $value) {
        // code...
        $data[] = array('value'=>$value->id,'text'=>$value->name);
      }
      //echo json_encode($data);
          echo json_encode(array('status'=>true,'data'=>$data));

      }else{
          echo json_encode(array('status'=>false,'data'=>$data));
      }  
   }

   public function list_provinces()
   {
     // code...

    $result = $this->mbarangay->listall(0,0,3);
    
     $data = array();
      $data[] = array('value'=>'0','text'=>'Select province...');
    if (!empty($result)) {
        // code...
      foreach ($result as $key => $value) {
        // code...
        $data[] = array('value'=>$value->id,'text'=>$value->name);
      }
      //echo json_encode($data);
          echo json_encode(array('status'=>true,'data'=>$data));

      }else{
          echo json_encode(array('status'=>false,'data'=>$data));
      } 
   }

   public function calamity($barangay='',$disaster_id=0)
   {
     // code...
    $barangay = html_escape($barangay);
    if (empty($barangay)) {
      // code...
      redirect('barangay');
      //exit();
    }
    $info = $this->mbarangay->info($barangay);

    $data = new stdClass();
    $data->disaster_id = $disaster_id;
    $data->barangay_id = $info->id;
    $data->listall = $this->mcalamity->listall();

    $data->pageTitle = 'Barangay Management - '.$barangay; 
    $data->barangay = $barangay;
    $data->content = 'barangay/calamity';
    $this->template->load($this->theme,$data);
   }
   public function affected($barangay_id=0,$disaster_id=0)
   {
     // code...
    $this->load->model('affected/affected_model','maffected');
    $data = new stdClass();

    $data->disaster = $this->mdisaster->getbyid($disaster_id);
    $data->barangay = $this->mbarangay->getbyid($barangay_id);
    $data->barangay_id = $barangay_id;
    $data->disaster_id = $disaster_id;

    $data->calamity_name = $this->mdisaster->get_calamityname($disaster_id);

    $data->affected_families = $this->maffected->list_families($disaster_id,$barangay_id);

    $data->pageTitle = 'Barangay Management - '.$data->barangay->barangay_name; 
    $data->content = 'barangay/affected';
    $this->template->load($this->theme,$data);

   }

 } 

?>