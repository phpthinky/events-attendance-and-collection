<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Alignment\LabelAlignmentLeft;

class Login extends MY_Controller
  {
    private $google_keys;
    private $site_key;
    private $secret_key;

  public function __construct()
  {
    // code...
    parent::__construct();
    $this->load->library("Aauth");
    $this->theme = 'login';

    $this->load->model('settings/settings_model');
    $this->load->model('course/mcourse');
    $this->site_key = $this->config->item('gsite_key');
    $this->secret_key = $this->config->item('gsecret_key');

    $this->load->model('settings/settings_model','msettings');

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
    $data->login_logo = $this->msettings->getloginlogo();

    $data->courses =  $this->mcourse->list();
    $data->site_key = $this->site_key;
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

  public function school_year($value='')
  {
    // code...
    $this->load->model('settings/settings_model');
    $result = $this->settings_model->listschoolyear();
    echo json_encode($result);
  }


  public function enroll($value='')
  {
   //   echo json_encode($this->input->post());
    
    if ($this->input->post()) {
      // code...
    $this->load->model('students/mstudents');
    $id_check = array(
      'code'=>$this->input->post('student_id')
    ); 

    if ($student_id = $this->mstudents->find($id_check)) {
      echo json_encode(array('status'=>false,'msg'=>'This Student ID is already exist in our database!'));
      exit();
    }
    if (!$this->validate()) {
      // code..
      echo json_encode(array('status'=>false,'msg'=>'Validate Failed! Please try again.'));
      exit();
    }

      $student_info = new stdClass();
      $student_info->fName = $this->input->post('fName');
      $student_info->mName = $this->input->post('mName');
      $student_info->lName = $this->input->post('lName');
      $student_info->ext = $this->input->post('ext');
      $student_info->gender= $this->input->post('gender');
      $student_info->code = $this->input->post('student_id');


    if($student_id = $this->mstudents->add($student_info)){
        
        $sy = $this->settings_model->get_current_sy();

        $student_course =  new stdClass();
        $student_course->course_id = $this->input->post('course');
        $student_course->grade = $this->input->post('grade');
        $student_course->section = $this->input->post('section');
        $student_course->status = $this->input->post('status');
        $student_course->semester = $sy->semester;
        $student_course->year_id = $sy->id;
        $student_course->student_id = $student_info->code;

        $course_title = $this->mcourse->get_coursesubtitle($student_course->course_id);

        $this->mstudents->save_course($student_course);



      $student_qinfo = array(
        'name'=>get_name($student_info),
        'course'=>$course_title.' '.$student_course->grade.'-'.$student_course->section
        );
        $this->toqrcode($student_info->code,json_encode($student_qinfo));


        echo json_encode(array('status'=>true,'msg'=>'Student successfull added.'));
        exit();
    }
        echo json_encode(array('status'=>false,'msg'=>'No student added.'));

    exit();
    }
    echo "No input";
  }
  

  public function toqrcode($code='',$gname='')
  {


    //  $data =json_encode(array('STUDENT_ID'=>$code));

    $data =site_url('scanner/info?qrcode=').$code;
    $qr_code_data = QrCode::create($data)
                 ->setSize(300)
                 ->setMargin(10);
    $writer = new PngWriter;
    $label = Label::create('STUDENT GOVERNMENT');
    //$logo = Logo::create(UPLOADPATH.'org-logo.png')
      //  ->setResizeToWidth(100);
    $result = $writer->write($qr_code_data,null,label:$label);
    //header("Content-Type: " . $result->getMimeType());

    //echo $result->getString();
  //  $qr_code = "QR".$code;
    $result->saveToFile(UPLOADPATH.'qrcode'.DIRECTORY_SEPARATOR.$code.".png");
    return;// $code;



  }

  function validate()
  {
    $captcha_response = trim($this->input->post('g-recaptcha-response'));

    if($captcha_response != '')
    {
      $check = array(
        'secret'    =>  $this->secret_key,
        'response'    =>  $this->input->post('g-recaptcha-response')
      );

      $startProcess = curl_init();

      curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");

      curl_setopt($startProcess, CURLOPT_POST, true);

      curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));

      curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);

      curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);

      $receiveData = curl_exec($startProcess);

      $finalResponse = json_decode($receiveData, true);

      if($finalResponse['success'])
      {
        return true;
        //$result = $this->enroll();

        //$this->captcha_model->insert($storeData);

        //$this->session->set_flashdata('success_message', 'Data Stored Successfully');

       // redirect('captcha');
      }
      else
      {
        return false;
       // $this->session->set_flashdata('message', 'Validation Fail Try Again');
       // redirect('captcha');
       // echo json_encode(array('status'=>false,'msg'=>'Validation Failed. Please Try again!'));
        //exit();
      }
    }
    else
    {
      return false;
        //echo json_encode(array('status'=>false,'msg'=>'Validation Failed. Please Try again!'));
        //exit();
      
      //$this->session->set_flashdata('message', 'Validation Fail Try Again');
      //redirect('captcha');
    }
  }


}