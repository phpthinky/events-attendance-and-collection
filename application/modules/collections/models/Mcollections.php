<?php 
/**
 * 
 */
class Mcollections extends CI_Model
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}
	public function add($data='')
	{
		// code...
		$this->db->insert('events_collection',$data);
		return $this->db->insert_id();
	}
	public function update($data)
	{
		// code...
		$this->db->where('id',$data->id);
		$this->db->update('events_collection',$data);
	}
	public function find($data='')
	{
		// code...
		return $this->db->get_where('events_collection',$data)->result();
	}
	public function list($data='')
	{

		// code...
		if (!empty($data)) {
			// code...
			$this->db->where($data);
		}
		
		$this->db->order_by('date_of_payment','DESC');

		return $this->db->get('events_collection')->result();
	}

	public function list_1stsemester($year_id=0,$course_id=0)
	{
		// code...
		if ($course_id > 0) {
			// code...
			$this->db
				->select('events_collection.*,course_id')
				->from('events_collection')
				->join('course_students','events_collection.student_id = course_students.student_id')
				->where('events_collection.semester',1)
				->where('events_collection.year_id',$year_id)
				->where('course_id',$course_id);
				$query = $this->db->get();
				return $query->result();
			//return $this->db->get_where('events_collection',array('semester'=>1,'year_id'=>$year_id,'course_id'=>$course_id))->result();

		}else if ($year_id > 0 ) {
			// code...

			$this->db
				->select('events_collection.*,course_id')
				->from('events_collection')
				->join('course_students','events_collection.student_id = course_students.student_id')
				->where('events_collection.semester',1)
				->where('events_collection.year_id',$year_id);
				$query = $this->db->get();
				return $query->result();

		}else{
			$sy = $this->db->limit(1)->get_where('settings_schoolyear',array('status'=>1,'is_deleted'=>null))->row(0);
			//return $this->db->get_where('events_collection',array('semester'=>1,'year_id'=>$sy->id))->result();

			$this->db
				->select('events_collection.*,course_id')
				->from('events_collection')
				->join('course_students','events_collection.student_id = course_students.student_id')
				->where('events_collection.semester',1)
				->where('events_collection.year_id',$sy->id);
				$query = $this->db->get();
				return $query->result();

		}
	}
	public function list_2ndsemester($year_id=0,$course_id=0)
	{

		if ($course_id > 0) {
			// code...
			$this->db
				->select('events_collection.*,course_id')
				->from('events_collection')
				->join('course_students','events_collection.student_id = course_students.student_id')
				->where('events_collection.semester',2)
				->where('events_collection.year_id',$year_id)
				->where('course_id',$course_id);
				$query = $this->db->get();
				return $query->result();
			//return $this->db->get_where('events_collection',array('semester'=>1,'year_id'=>$year_id,'course_id'=>$course_id))->result();

		}else if ($year_id > 0 ) {
			// code...

			$this->db
				->select('events_collection.*,course_id')
				->from('events_collection')
				->join('course_students','events_collection.student_id = course_students.student_id')
				->where('events_collection.semester',2)
				->where('events_collection.year_id',$year_id);
				$query = $this->db->get();
				return $query->result();

		}else{
			$sy = $this->db->limit(1)->get_where('settings_schoolyear',array('status'=>1,'is_deleted'=>null))->row(0);
			//return $this->db->get_where('events_collection',array('semester'=>1,'year_id'=>$sy->id))->result();

			$this->db
				->select('events_collection.*,course_id')
				->from('events_collection')
				->join('course_students','events_collection.student_id = course_students.student_id')
				->where('events_collection.semester',2)
				->where('events_collection.year_id',$sy->id);
				$query = $this->db->get();
				return $query->result();

		}


	}
	public function list_2ndsemester_old($year_id=0,$course_id=0)
	{
		// code...
		
		if ($course_id > 0) {
			// code...
			return $this->db->get_where('events_collection',array('semester'=>1,'year_id'=>$year_id,'course_id'=>$course_id))->result();

		}else if ($year_id > 0) {
			// code...
			return $this->db->get_where('events_collection',array('semester'=>2,'year_id'=>$year_id))->result();
		}else{
			$sy = $this->db->limit(1)->get_where('settings_schoolyear',array('status'=>1,'is_deleted'=>null))->row(0);
			return $this->db->get_where('events_collection',array('semester'=>2,'year_id'=>$sy->id))->result();

		}
	}

	public function listallbyevent($data='')
	{

		// code...
		return $this->db->get('collections')->result();
	}

	public function settings($value='')
	{
		// code...
		return $this->db->get_where('collection_settings',array('status'=>1))->row(0);
	}

	public function setsettings($data='')
	{
		// code...
		if (!$this->db->get('collection_settings')->result()) {
			// code...
			$data['status'] =1;
		return $this->db->insert('collection_settings',$data);
		}
		return $this->db->update('collection_settings',$data);
	}

	public function listlatepenaltybystudentid($student_id='')
	{
		$this->db
			->select('events_late.*,events.event_title')
			->from('events_late')
			->join('events','events.id = events_late.event_id')
			->where('payment_status',0)
			->where('student_id',$student_id);
			$query = $this->db->get();
			return $query->result();
	}

	public function listabsentpenaltybystudentid($student_id='')
	{
		$this->db
			->select('events_absent.*,events.event_title')
			->from('events_absent')
			->join('events','events.id = events_absent.event_id')
			->where('payment_status',0)
			->where('student_id',$student_id);
			$query = $this->db->get();
			return $query->result();
	}
	public function getlatepenalty($event_id=0,$student_id=0)
	{
		// code...
		return $this->db->get_where('v_penalty',array('event_id'=>$event_id,'student_id'=>$student_id))->row(0);
	}

	public function getabsentpenalty($event_id=0,$student_id=0)
	{
		// code...
		return $this->db->get_where('events_absent',array('event_id'=>$event_id,'student_id'=>$student_id))->row(0);
		
	}



	public function get_chartData($course_id=0)
	{
		// code...


	}




}

 ?>