<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
  {

  public function __construct()
  {
    // code...
    parent::__construct();
    $this->load->library("Aauth");
    $this->theme = 'login';
    }

  public function index() {
    
    if ($this->aauth->is_loggedin()) {
      // code...
      redirect('dashboard');
    }
   $data = new stdClass();

    if ($this->input->post()) {
      // code...
      if($this->aauth->login($this->input->post('userName'),$this->input->post('passWord'))){
        $this->user_id = $this->session->userdata('id');
        //$this->load->model('tourguide/tourguide_model','mtourguide');
        //$info = $this->mtourguide->getbyId($this->user_id);
       // $this->session->set_userdata('tourguide',$info->fName.' '.$info->lName);
       // $workersId = $this->workers_model->getWorkerId($userId);
       // $this->session->set_userdata('workersId',$workersId);


        if (!empty($_GET['url'])) {
          // code...
          redirect($_GET['url']);
        }else{
          redirect('dashboard');
          
        }
      }
      $data->errors = $this->aauth->get_errors_array();

      //exit();
    }

    $data->url = (!empty($_GET['url'])? $_GET['url'] :'');
    $data->content = 'login/index';
    $this->template->load($this->theme,$data);

  }
  public function forgot_password($value='')
  {
    // code...
    if ($this->input->post()) {

      $result = $this->aauth->remind_password($this->input->post('email'));
      if (!$result) {
        // code...
        echo 'No user found. Invalid email.';
      }else{
        echo "Verification code is sent in your email: ".$this->input->post('email');
      }
      exit();
    }
    //$this->output->cache(1);
    $this->load->view('common/header');
    $this->load->view('forgot_password');
    $this->load->view('common/footer');
  }
    function signout($value='')
  {
    // code...
    $this->aauth->logout();
    redirect(site_url());
  }


}