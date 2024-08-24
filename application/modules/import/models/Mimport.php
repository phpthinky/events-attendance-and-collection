<?php 

/**
  * 
  */
 class Mimport extends CI_Model
 {
 	

 	public function find($student_id='')
 	{
 		// code...
 		$row = $this->db->get_where('students',array('code'=>$student_id))->row(0);
 		if (!empty($row)) {
 			// code...
 			return true;
 		}
 		return FALSE;
 	}
 	public function year_id($start_year='',$end_year='',$semester=0)
 	{
	 		// code...
	 	if($row = $this->db->get_where('settings_schoolyear',array('start_year'=>$start_year,'end_year'=>$end_year,'semester'=>$semester))->row(0)){
	 		return $row->id;
	 	}
	 	return 0;
 	}

 	public function insert($data='')
 	{
 		// code..
 		$this->db->insert('students',$data);
 		return $this->db->insert_id();
 	}



 	public function update($student_id=0,$data='')
 	{
 		// code..
 		$this->db->where('code',$student_id);
 		return $this->db->update('students',$data);
 	}


 	public function save_course($action='',$data='')
 	{
 		// code..
 		if($row = $this->db->get_where('course_students',array('student_id'=>$data->student_id))->row(0)){
 			$this->db->where('student_id',$data->student_id);
 		return $this->db->update('course_students',$data);
	 			
	 	}else{

	 		$this->db->insert('course_students',$data);
	 			return $this->db->insert_id();
	 		
	 	}
 		
 		return false;
 	}
 	public function getcourse_id($course='')
 	{
 		// code...
 		if (!empty($course)) {
 			// code...
 			$this->db->where('course_title',$course);
 			$this->db->or_where('course_sub_title',$course);
 			$row= $this->db->get('course')->row();
 			if (!empty($row)) {
 				// code...
 				return $row->id;
 			}
 		}
 		return 0;
 	}




 } ?>