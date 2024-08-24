<?php 
/**
 * 
 */
class Mattendance extends CI_Model
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}
	public function add($data='')
	{
		// code...
		$this->db->insert('events_attendance',$data);
		return $this->db->insert_id();
	}

	public function update($data)
	{
		// code...
		$this->db->where('id',$data->id);
		return $this->db->update('events_attendance',$data);
	}

	public function timein($event_id=0,$student_id=0,$data=false)
	{
		// code...
		$this->db->where('event_id',$event_id);
		$this->db->where('student_id',$student_id);
		return $this->db->update('events_attendance',$data);
	}
	
	public function timeout($event_id=0,$student_id=0,$data=false)
	{
		// code...
		$this->db->where('event_id',$event_id);
		$this->db->where('student_id',$student_id);
		return $this->db->update('events_attendance',$data);
	}
	public function find($data='')
	{
		// code...
		return $this->db->get_where('events_attendance',$data)->row(0);
	}
	public function check($event_id=0,$student_id='',$type=0)
	{
		// code...
		$this->db->where('student_id',$student_id);
		$this->db->where('event_id',$event_id);
		$this->db->where('in_out_type',$type);
		$this->db->limit(1);
		return $this->db->get('events_attendance')->row(0);

	}
	public function list($data='')
	{

		// code...
		$this->db
			->select('events_attendance.*,concat(fName," ",mName," ",lName) as student_name,course.course_sub_title,grade,section,(penalty_late * late) as bayad_late,(penalty_absent * absent) as bayad_absent,event_title')
			->from('events_attendance')
			->join('events','events.id = events_attendance.event_id')
			->join('students','students.code = events_attendance.student_id')
			->join('course_students','course_students.student_id = students.id')
			->join('course','course.id = course_students.course_id')
			->where('events_attendance.penalty_late',1)
			->group_by('date_of_event,event_id,student_id');
			$query = $this->db->get();
		return $query->result();
	}
	public function like($data)
	{
		$sql = $this->db->select('*')
				->from('events_attendance')
				->like('keywords',$data['keywords'])
				->or_like('keywords_2',$data['keywords']);
				//->get();
		 //return $this->db->get_compiled_select();

		 //$query = $this->db->($sql);//
		 return $this->db->get()->result();
	}

	public function listbyevent($event_id=0,$course_id = false)
	{
		// code...
		if (!empty($course_id)) {
			// code...
			//return false;
		$this->db

			->select('course_students.course_id,events_attendance.*,concat(fName," ",mName," ",lName) as student_name')
			->from('events_attendance')
			->join('students','students.code = events_attendance.student_id')
			->join('course_students','course_students.student_id = students.code')
			->where('event_id',$event_id)
			->where('course_students.course_id',$course_id);
			$query = $this->db->get();
			return $query->result();

		}
		
		$this->db
			->select('course_students.course_id,events_attendance.*,concat(fName," ",mName," ",lName) as student_name')
			->from('events_attendance')
			->join('students','students.code = events_attendance.student_id')
			->join('course_students','course_students.student_id = students.code')
			->where('event_id',$event_id);

			$query = $this->db->get();
			return $query->result();

		return null;


	}

	public function get_list($event_id=0,$date_of_event='')
	{
		// code...
		//return $this->db->order_by('timein','DESC')->get_where('events_attendance',array('event_id'=>$event_id))->result();
		$this->db
			->select('events_attendance.*,concat(fName," ",mName," ",lName) as student_name')
			->from('events_attendance')
			->join('students','students.code = events_attendance.student_id')
			->where('date_of_event',$date_of_event)
			->where('event_id',$event_id);
			$query = $this->db->get();
			return $query->result();

		return null;


	}
	public function is_absent($event_id='',$student_id='')
	{
		// code...
		return $this->db->get_where('events_absent',array('event_id'=>$event_id,'student_id'=>$student_id))->row(0);
	}

	public function is_late($event_id='',$student_id='')
	{
		// code...
		return $this->db->get_where('events_attendance',array('event_id'=>$event_id,'student_id'=>$student_id,'penalty_late'=>1))->row(0);
	}
	public function get_absent($event_id=0,$course_id = 0)
	{
		return fals;
		// code...
		$sql = sprintf("SELECT * FROM `v_events_course` where v_events_course.event_id = %u and v_events_course.student_id NOT IN (SELECT events_attendance.student_id FROM events_attendance WHERE events_attendance.event_id = events_attendance.event_id);",$event_id);
		$query = $this->db->query($sql);
		return $query->result();

	}
	public function list_absent($event_id='',$course_id=0,$year_id=0)
	{
		// code...
	$result  = $this->db->get_where('events_absent',array('event_id'=>$event_id,'course_id'=>$course_id))->result();
	if (!empty($result)) {
			// code...
		foreach ($result as $key => $value) {
			// code...
			$data = new stdClass();
					$info = $this->db->get_where('students',array('code'=>$value->student_id))->row(0);
					$data->student_name = $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext;
					$data->status ='absent';
					$data->timein = '';
					$data->timeout = '';
					$data->pm_in = '';
					$data->pm_out = '';
					$data->penalty_late = 0;
					$data->penalty_absent = 1;
					$data->course_id = $course_id;
					$data->event_id = $event_id;
					$data->semester = 0;
					$data->year_id = $value->year_id;
					$data->date_of_event = $value->date_of_event;
					$result[$key] = $data;
		}
		return $result;
		}	
		return false;


	}
	public function list_attendees($event_id=0,$course_id=0)
	{

if (!empty($course_id)) {
	// code...
	//var_dump($course_id);
	//exit;

	$sql = sprintf('SELECT events_attendance.*,concat(fName," ",mName," ",lName) as student_name,course_students.course_id FROM events_attendance JOIN course_students ON course_students.student_id = events_attendance.student_id JOIN students ON students.code = events_attendance.student_id WHERE events_attendance.event_id = %u and course_id = %u;',$event_id,$course_id);
			$query = $this->db->query($sql);

}else{
	$sql = sprintf('SELECT events_attendance.*,concat(fName," ",mName," ",lName) as student_name,course_students.course_id FROM events_attendance JOIN course_students ON course_students.student_id = events_attendance.student_id JOIN students ON students.code = events_attendance.student_id WHERE events_attendance.event_id = %u;',$event_id);
			$query = $this->db->query($sql);
}		
		$i=0;
				$result = array();
			if($result = $query->result()){
				
				foreach ($result as $key => $value) {
					// code...
					if ($value->penalty_late == 1) {
						// code...
					$result[$key]->status = 'late';

					}else{
					$result[$key]->status = 'present';

					}
					++$i;

				}
			}
			$list_absent = $this->list_absent($event_id,$course_id);
			//var_dump($list_absent);
			//exit();
			if (!empty($list_absent)) {
				// code...


				foreach ($list_absent as $key => $value) {
					// code...
					/*
					$data = new stdClass();
					$info = $this->db->get_where('students',array('code'=>$value->student_id))->row(0);
					$data->student_name = $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext;
					$data->status ='absent';
					$data->timein = '';
					$data->timeout = '';
					$data->pm_in = '';
					$data->pm_out = '';
					$data->penalty_late = 0;
					$data->penalty_absent = 1;
					$data->course_id = $course_id;
					$data->event_id = $event_id;
					$data->semester = 0;
					$data->year_id = $value->year_id;
					$data->date_of_event = $value->date_of_event;
					*/
					$result[$i] = $value;
					++$i;
				}
			}

			return $result;



	}
	public function get_penaltylatebystudentid($event_id='',$student_id='')
	{
		// code...
		return $this->db->get_where('events_late',array('event_id'=>$event_id,'student_id'=>$student_id))->row();

	}

	public function get_penaltyabsentbystudentid($event_id='',$student_id='')
	{
		// code...
		return $this->db->get_where('events_absent',array('event_id'=>$event_id,'student_id'=>$student_id))->row();

	}

	public function getbystudentid($student_id='')
	{
		// code...
		$result = $this->db->get_where('events_attendance',array('student_id'=>$student_id))->result();
		$i =0;
		if (!empty($result)) {
			// code...
			foreach ($result as $key => $value) {
					// code...	

					if ($value->penalty_late == 1) {
						$result[$key]->type = 'late';
						$result[$key]->attendance_status = 'late';

						$result[$key]->payment_status = 3;
						$result[$key]->penalty = 0;
						$result[$key]->payment_status = 0;
	
						if($row = $this->get_penaltylatebystudentid($value->event_id,$student_id)){

						$result[$key]->payment_status = $value->payment_status;
						$result[$key]->penalty = $row->penalty;
						$result[$key]->payment_status = $row->payment_status;
	
						}
					}else{
						$result[$key]->type = 'present';							
						$result[$key]->attendance_status = 'present';
						$result[$key]->payment_status = 2;
						$result[$key]->penalty = 0;

					}
					$result[$key]->no_days = $value->event_day;

					++$i;
				}	
		}else{
				$result = array();		
		}
		$result_absent = $this->db->get_where('events_absent',array('student_id'=>$student_id))->result();
		if (!empty($result_absent)) {
			// code...
			foreach ($result_absent as $key => $value) {
				// code...
			//	var_dump($value);
				$info = $this->db->get_where('events',array('id'=>$value->event_id))->row(0);
				$data = new stdClass();
					$data->attendance_status ='absent';
					$data->timein = '';
					$data->timeout = '';
					$data->pm_in = '';
					$data->pm_out = '';
					$data->penalty_late = 0;
					$data->penalty_absent = 1;
					$data->course_id = $value->course_id;
					$data->event_id = $value->event_id;
					$data->semester = 0;
					$data->year_id = $value->year_id;
					$data->date_of_event = $value->date_of_event;
					$data->penalty = $value->penalty;
					$data->type ='absent';
					$data->no_days = $info->no_days;
					$data->payment_status = $value->payment_status;

					$result[$i]=$data;
					++$i;
			}
		}
		return $result;
	}



}

 ?>