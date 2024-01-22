<?php 

/**
 * 
 */
class Users_model extends CI_Model
{
	
	function __construct()
	{
		// code...
	}
	public function getId($phar)
	{
		// code...
		$this->db->where('id',$phar);
	}
	public function getuserName($id=0)
	{
		// code...

 		if($row = $this->db->get_where('tourguide',array('person_id'=>$id))->row(0)){
 		$user_id = $row->user_id;
 		$row =$this->db->get_where('aauth_users',array('id'=>$user_id))->row(0);
 		return $row->username;
 		}else{

	 		if($row2 = $this->db->get_where('guests',array('guest_id'=>$id))->row(0)){

	 		$user_id2 = $row2->user_id;
	 		$row3 =$this->db->get_where('aauth_users',array('id'=>$user_id2))->row(0);
	 		return $row3->username;
 		}
 		return null;

 		}
	}
}
 ?>