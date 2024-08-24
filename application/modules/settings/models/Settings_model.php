<?php 

/**
  * 
  */
 class Settings_model extends CI_Model
 {
 	
 	function __construct()
 	{
 		// code...
 		parent::__construct();
 	}
  public function getsemestersettings($value='')
  {
    // code...
    return $this->db->limit(1)->get('settings_semester')->row(0);
  }

  public function getcurrentsem($value='')
  {
    // code...
    //$row =  $this->db->limit(1)->get('settings_semester')->row(0);
    //return $row->current_semester;
    $row = $this->get_current_sy();
    return $row->semester;

  }

  public function setsemestersettings($data)
  {
    // code...
    if ($this->db->get('settings_semester')->result()) {
      // code...
     return $this->db->update('settings_semester',$data);
    }
    return $this->db->insert('settings_semester',$data);
  }


  public function addschoolyear($data)
  {
    if ($data['status'] ==  1) {
      // code...
      $this->db->where('status',1);
      $this->db->update('settings_schoolyear',array('status'=>2));
    }
    return $this->db->insert('settings_schoolyear',$data);
  }

  public function endschoolyear()
  {
    $sy = $this->get_current_sy();
    $this->db->where('status',1);
    $this->db->update('settings_schoolyear',array('status'=>2));
    return $sy;
  }
  public function editschoolyear($data)
  {

    if ($data['status'] ==  1) {
      // code...
      $this->db->where('status',1);
      $this->db->update('settings_schoolyear',array('status'=>2));
    }

    $this->db->where('id',$data['id']);
    return $this->db->update('settings_schoolyear',$data);
  }

  public function trashschoolyear($year_id=0)
  {

      // code...
      $this->db->where('id',$year_id);
      $this->db->set('is_deleted',1);
     return $this->db->update('settings_schoolyear');
   
  }

  public function listschoolyear($status=0)
  {
    if (!empty($status)) {
      // code...
      $this->db->where('status',$status);
    }
    return $this->db->order_by('start_year','desc')->get_where('settings_schoolyear',array('is_deleted'=>null))->result();
  }

  public function get_current_sy($value='')
  {
    // code...
    return $this->db->limit(1)->get_where('settings_schoolyear',array('status'=>1))->row(0);
  }
  
  public function get_sy($year_id=0)
  {
    // code...
    return $this->db->limit(1)->get_where('settings_schoolyear',array('id'=>$year_id))->row(0);
  }
  public function system_info($data='')
  {
    // code...
    //return $this->db->get_where('system_info',$data)->result();
    $query = $this->db
                  ->select('meta_value')
                  ->from('system_info')
                  ->where($data)
                  ->get();
                 return $query->result();
                 
  }
  public function reset_all($value='')
  {
    //$this->db->truncate('course');
    $this->db->truncate('students');
    $this->db->truncate('students_enrolled');
    $this->db->truncate('course_students');
    $this->db->truncate('course_students');
    $this->db->truncate('settings_schoolyear');    
    $this->db->truncate('events');
    $this->db->truncate('events_attendance');    
  $this->db->truncate('events_absent');
  $this->db->truncate('events_collection');
  $this->db->truncate('events_late');
  $this->db->truncate('aauth_perms');
    $this->db->delete('aauth_users',array('id <>'=>1));
    $this->db->delete('aauth_user_to_group',array('user_id <>'=>1));
    $sql = "ALTER TABLE `aauth_users` AUTO_INCREMENT = 2";
    $this->db->query($sql);
  $this->aauth->create_perm('Attendance Officer','The one who has permission to check the attendance of the students');
  $this->aauth->create_perm('Collection Officer','The one who has permission to collect payment from the students');
    
    $profile = glob(UPLOADPATH.'/profile/*'); // get all file names

      foreach($profile as $file){ // iterate files
        if(is_file($file)) {
          unlink($file); // delete file
        }
      }
/*
    $destinations = glob(UPLOADPATH.'/logo/*'); // get all file names
      foreach($destinations as $file){ // iterate files
        if(is_file($file)) {
          unlink($file); // delete file
        }
      }
*/
    /*
    $booking = glob(UPLOADPATH.'/qrcode/*'); // get all file names
      foreach($booking as $file){ // iterate files
        if(is_file($file)) {
          unlink($file); // delete file
        }
      }
      */
  }

  function restoredb($filename=null)
  {
    $isi_file = file_get_contents($filename);
    $string_query = rtrim( $isi_file, "\n;" );
    $array_query = explode(";", $string_query);
    foreach($array_query as $query)
    {
      $this->db->query($query);
    }
  }

  public function site($data='')
  {
    // code...
    if ($this->db->get_where('settings_site',array('title'=>$data->title))->row(0)) {
      // code...
      $this->db->where('title',$data->title);
      return $this->db->update('settings_site',$data);
    }
      return $this->db->insert('settings_site',$data);
  }

  public function getsitelogo()
  {
    // code...
    $row = $this->db->get_where('settings_site',array('title'=>'sitelogo'))->row(0);

    if (!empty($row)) {
      // code...
      return $row->value;
    }
      return base_url('assets/img/org-logo-sidebar.png');
  }

   public function getloginlogo()
  {
    // code...
    $row = $this->db->get_where('settings_site',array('title'=>'loginlogo'))->row(0);

    if (!empty($row)) {
      // code...
      return $row->value;
    }
      return base_url('assets/img/org-logo-sidebar.png');
  }

  public function getsitetitle()
  {
    // code...
    $row = $this->db->get_where('settings_site',array('title'=>'site_title'))->row(0);
    if (!empty($row)) {
      return $row->value;
    } 
      return null;
  }

 } 

/*update 
ALTER TABLE `course` ADD `is_deleted` INT(1) NULL DEFAULT NULL AFTER `status`;

*/


 ?>



