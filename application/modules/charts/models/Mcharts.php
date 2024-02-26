<?php 


/**
 * 
 */
class Mcharts extends CI_Model
{
	
	public function getCollectionData_old($year_id=0,$semester=0)
	{
		// code...
			$sy = $this->db->get_where('settings_schoolyear',array('is_deleted'=>null,'status'=>1))->row(0);
			$sem = $sy->semester;
		if(!empty($year_id) && !empty($semester)){

		$sql = sprintf("SELECT SUM(total_payment) as total_collection,course_id,semester FROM v_bayad_by_course WHERE year_id = %u AND semester = $semester  GROUP BY course_id,semester ",$year_id);
		$query = $this->db->query($sql);
		return $query->result();

		}elseif(!empty($year_id) && empty($semester)){

		$sql = sprintf("SELECT SUM(total_payment) as total_collection,course_id,semester FROM v_bayad_by_course WHERE year_id = %u GROUP BY course_id,semester ",$year_id);
		$query = $this->db->query($sql);
		return $query->result();

		}elseif(empty($year_id) && !empty($semester)){

			$year_id = $sy->id;
		$sql = sprintf("SELECT SUM(total_payment) as total_collection,course_id,semester FROM v_bayad_by_course WHERE year_id = %u  AND semester = $semester GROUP BY course_id,semester ",$year_id);
		$query = $this->db->query($sql);
		return $query->result();
		}else{
			$year_id = $sy->id;
			$semester = $sem->current_semester;			
			$sql = sprintf("SELECT SUM(total_payment) as total_collection,course_id,semester FROM v_bayad_by_course WHERE year_id = %u GROUP BY course_id,semester ",$year_id);
			$query = $this->db->query($sql);
			return $query->result();

		}

	}
	public function getCollectionData($year_id=0)
	{
		// code...
		if ($year_id > 0) {
			// code...
			$sql = sprintf("SELECT t1.course_id, year_id,(SELECT SUM(total_payment) FROM v_bayad_by_course as t2 WHERE t2.course_id = t1.course_id and semester = 1 GROUP BY course_id,year_id ) as first_semester,(SELECT SUM(total_payment) FROM v_bayad_by_course as t3 WHERE t3.course_id = t1.course_id and semester = 2 GROUP BY course_id,year_id ) as second_semester FROM `v_bayad_by_course` as t1 WHERE year_id = %u GROUP BY course_id,year_id;",$year_id);
		}else{

		$sql = sprintf("SELECT t1.course_id, year_id,(SELECT SUM(total_payment) FROM v_bayad_by_course as t2 WHERE t2.course_id = t1.course_id and semester = 1 GROUP BY course_id,year_id ) as first_semester,(SELECT SUM(total_payment) FROM v_bayad_by_course as t3 WHERE t3.course_id = t1.course_id and semester = 2 GROUP BY course_id,year_id ) as second_semester FROM `v_bayad_by_course` as t1 GROUP BY course_id,year_id;");	
		}

		$query = $this->db->query($sql);
		return $query->result();

	}



	//end class
}