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

	public function listbyevent($event_id=0)
	{
		// code...
		//return $this->db->order_by('timein','DESC')->get_where('events_attendance',array('event_id'=>$event_id))->result();
			$this->db
			->select('events_attendance.*,concat(fName," ",mName," ",lName) as student_name')
			->from('events_attendance')
			->join('students','students.code = events_attendance.student_id')
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
	public function get_absent($event_id=0,$course_id = 0)
	{
		// code...
		$sql = sprintf("SELECT * FROM `v_events_course` where v_events_course.event_id = %u and v_events_course.student_id NOT IN (SELECT events_attendance.student_id FROM events_attendance WHERE events_attendance.event_id = events_attendance.event_id);",$event_id);
		$query = $this->db->query($sql);
		return $query->result();

	}



}

 ?>