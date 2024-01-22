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

  public function setsemestersettings($data)
  {
    // code...
    if ($this->db->get('settings_semester')->result()) {
      // code...
     return $this->db->update('settings_semester',$data);
    }
    return $this->db->insert('settings_semester',$data);
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
    $this->db->truncate('personaldetails');
    $this->db->delete('aauth_users',array('id <>'=>1));
    $this->db->delete('aauth_user_to_group',array('user_id <>'=>1));
    $sql = "ALTER TABLE `aauth_users` AUTO_INCREMENT = 2";
    $this->db->query($sql);
    
    $sql2 = "ALTER TABLE `eworkers` AUTO_INCREMENT = 2";
    $this->db->query($sql2);
  }

 } ?>