<?php 
/**
 * 
 */
class Mevents extends CI_Model
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}
	public function add($data='')
	{
		// code...
		$this->db->insert('events',$data);
		return $this->db->insert_id();
	}
	public function update($id,$data)
	{
		// code...
		$this->db->where('id',$id);
		return $this->db->update('events',$data);
	}
	public function find($data='')
	{
		// code...
		return $this->db->get_where('events',$data)->result();
	}
	public function list($current=0)
	{

		// code...
		$result = array();
		if ($current == 'current') {
			// code...

		$this->db->where('status',1);

		$query=$this->db->get('events');

		$result = $query->result();

		}elseif ($current === 'canceled') {
			// code...
		$this->db->where('status',3);
		$query=$this->db->get('events');

		$result = $query->result();

		}elseif ($current === 'active') {
			// code...
		$this->db->where('status',1);

		$query=$this->db->get('events');

		$result = $query->result();

		}
		elseif ($current === 'incoming') {
			// code...

		$this->db->where('status',0);
		$query=$this->db->get('events');

		$result = $query->result();

		}

		elseif ($current === 'completed') {
			// code...
		$result = $this->db->order_by('event_startdate','ASC')->get_where('events',array('status'=>2))->result();

		}
		else{
		$result = $this->db->order_by('event_startdate','ASC')->get('events')->result();

		}
		if (!empty($result)) {
			// code...
			foreach ($result as $key => $value) {
				// code...
				$courses = json_decode($value->attendees_course);
				$c =  array();
				foreach ($courses as $a => $b) {
					// code...
					$info_course = $this->db->get_where('course',array('id'=>$b))->row(0);
					foreach (json_decode($value->attendees_year) as $i => $v) {
						// code...
					$c[] = $info_course->course_sub_title.' '.$v;

					}
				}
				$result[$key]->courses = $c;
			}
		}
		return $result;
	}
	public function like($data)
	{
		$sql = $this->db->select('*')
				->from('events')
				->like('keywords',$data['keywords'])
				->or_like('keywords_2',$data['keywords']);
				//->get();
		 //return $this->db->get_compiled_select();

		 //$query = $this->db->($sql);//
		 return $this->db->get()->result();
	}
	public function info($id=0)
	{
		// code...
		$row = null;
		if($row = $this->db->get_where('events',array('id'=>$id))->row(0)){

				$courses = json_decode($row->attendees_course);
				$c =  array();
				foreach ($courses as $a => $b) {
					// code...
					$info_course = $this->db->get_where('course',array('id'=>$b))->row(0);
					foreach (json_decode($row->attendees_year) as $i => $v) {
						// code...
					$c[] = $info_course->course_sub_title.' '.$v;

					}
				}
				$row->courses = $c;
		}
				return $row;
	}
	public function get_currentevent()
	{
		// code...
		return $this->db->limit(1)->get_where('events',array('status'=>1))->row(0);
	}
	public function list_absents($event_id=0,$year_id=0,$semester=0)
	{
		// code...
		/*
		$sql = sprintf("SELECT * FROM `v_events_course` where v_events_course.event_id = %u and v_events_course.student_id NOT IN (SELECT events_attendance.student_id FROM events_attendance WHERE events_attendance.event_id = %u);",$event_id,$event_id);
		$query = $this->db->query($sql);
		return $query->result();
		*/

		$students = $this->db->get_where('course_students',array('status'=>1,'semester'=>$semester,'year_id'=>$year_id))->result();
		//$attendace = $this->db->get_where('events_attendance',array('event_id'=>$event_id))->result();
		$data =  array();

		foreach ($students as $key => $value) {
			// code...
			//$result = $this->check_events_attendees($value->course_id,$value->grade,$event_id);
			//var_dump($result);
			if ($result = $this->check_events_attendees($value->course_id,$value->grade,$event_id)) {
				// code...
				if (!$this->db->get_where('events_attendance',array('event_id'=>$event_id,'student_id'=>$value->student_id))->result()) {
					// code...
				$data[] = $value;

				}
			}
		}

		return $data;
	}

	public function set_absent_penalty($data='')
	{
		// code...
		return $this->db->insert('events_absent',$data);
	}
	public function list_late($event_id=0)
	{
		// code...
		$sql = sprintf("SELECT * FROM `events_attendance` WHERE penalty_late = 1 and event_id = %u GROUP by event_id,student_id;",$event_id);
		$query = $this->db->query($sql);
		return $query->result();

	}

	public function set_late_penalty($data='')
	{
		// code...
		return $this->db->insert('events_late',$data);
	}
	public function pay_late($data='')
	{
		// code...
		$this->db->where('event_id',$data['event_id']);
		$this->db->where('student_id',$data['student_id']);
		return $this->db->update('events_late',array('payment_status'=>1));
	}

	public function pay_absent($data='')
	{
		// code...
		$this->db->where('event_id',$data['event_id']);
		$this->db->where('student_id',$data['student_id']);
		return $this->db->update('events_absent',array('payment_status'=>1));
	}


	public function check_events_attendees($course_id=0,$grade = 0,$event_id=0)
	{
		// code...
		$sql = sprintf("SELECT * FROM  events where  JSON_CONTAINS(events.attendees_course, %u,'$') AND JSON_CONTAINS(events.attendees_year, %u,'$') AND events.id = %u;",$course_id,$grade,$event_id);
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function allowed_students($course_id=0,$grade = 0)
	{
		// code...
		$sql = sprintf("SELECT * FROM course_students WHERE JSON_CONTAINS((SELECT events.attendees_course FROM events WHERE course_id = %u LIMIT 1), course_id) AND  JSON_CONTAINS((SELECT events.attendees_year FROM events WHERE grade = %u LIMIT 1), grade);",$course_id,$grade);
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function getbystudentid($student_id='')
	{
		// code...
		//$sql = sprintf("SELECT * FROM `events_late` WHERE student_id = '%s';",$student_id);
		
		$query = $this->db->get_where('events_late',array('student_id'=>$student_id));
		$data = array();
		$i=0;
		if($result =  $query->result()){
			foreach ($result as $key => $value) {
				// code...

				$info = $this->info($value->event_id);
				$am = $this->db->get_where('events_attendance',array('event_id'=>$value->event_id,'student_id'=>$value->student_id,'time_in_type '=>1))->row(0);
				$pm = $this->db->get_where('events_attendance',array('event_id'=>$value->event_id,'student_id'=>$value->student_id,'time_in_type '=>2))->row(0);
				$am_in = '';
				$am_out = '';
				$pm_in = '';
				$pm_out = '';
				if (!empty($am)) {
					// code...
					$am_in =(!empty($am->timein) ? time_format($am->timein) : '');
					$am_out =(!empty($am->timeout) ? time_format($am->timeout) : '');
				}
				if (!empty($pm)) {
					// code...

					$pm_in =(!empty($pm->timein) ? time_format($pm->timein) : '');
					$pm_out =(!empty($pm->timeout) ? time_format($pm->timeout) : '');
									}
				$d = (object) array(
					'event_title'=>$info->event_title,
					'no_days'=>$info->no_days,
					'penalty'=>$value->penalty,
					'payment_status'=>$value->payment_status,
					'am_in'=>$am_in,
					'am_out'=>$am_out,
					'pm_in'=>$pm_in,
					'pm_out'=>$pm_out,
					'type'=>'late'
					);
				$data[] = $d;

			}
		}
		//$sql2 = sprintf("SELECT * FROM `events_absent` WHERE student_id = '%s';",$student_id);
		$query2 = $this->db->get_where('events_absent',array('student_id'=>$student_id));
		//$query2 = $this->db->query($sql2);
		
		if($result2 =  $query2->result()){
			foreach ($result2 as $key => $value) {
				// code...
				$info = null;
				$am = null;
				$pm = null;

				$info = $this->info($value->event_id);

				$am = $this->db->get_where('events_attendance',array('event_id'=>$value->event_id,'student_id'=>$value->student_id,'time_in_type '=>1))->row(0);
				$pm = $this->db->get_where('events_attendance',array('event_id'=>$value->event_id,'student_id'=>$value->student_id,'time_in_type '=>2))->row(0);
				$am_in = '';
				$am_out = '';
				$pm_in = '';
				$pm_out = '';
				if (!empty($am)) {
					// code...
					$am_in = $am->timein;
					$am_out = $am->timeout;
				}
				if (!empty($pm)) {
					// code...
					$pm_in = $pm->timein;
					$pm_out = $pm->timeout;
				}
				$d = (object) array(
					'event_title'=>$info->event_title,
					'no_days'=>$info->no_days,
					'penalty'=>$value->penalty,
					'payment_status'=>$value->payment_status,
					'am_in'=>$am_in,
					'am_out'=>$am_out,
					'pm_in'=>$pm_in,
					'pm_out'=>$pm_out,
					'type'=>'absent'
					);
				$data[] = $d;

			}
		}
		return $data;
	

}
public function get_attendance($student_id='')
{
	// code...
/*	$sql = "SELECT student_id,event_id,date_of_event,(select timein FROM events_attendance as t2 WHERE t2.time_in_type = 1 and t1.student_id = t2.student_id AND t2.event_id = t1.event_id) as morning_in,(select timeout FROM events_attendance as t2 WHERE t2.time_in_type = 1 and t1.student_id = t2.student_id AND t2.event_id = t1.event_id) as morning_out FROM events_attendance as t1 GROUP by event_id,student_id;";
*/

	
}

/*

CREATE VIEW v_events_attendance as SELECT student_id,event_id,date_of_event,penalty_late,(select timein FROM events_attendance as t2 WHERE t2.time_in_type = 1 and t1.student_id = t2.student_id AND t2.event_id = t1.event_id) as am_in,(select timeout FROM events_attendance as t2 WHERE t2.time_in_type = 1 and t1.student_id = t2.student_id AND t2.event_id = t1.event_id) as am_out,(select timeout FROM events_attendance as t2 WHERE t2.time_in_type = 2 and t1.student_id = t2.student_id AND t2.event_id = t1.event_id) as pm_in ,(select timeout FROM events_attendance as t2 WHERE t2.time_in_type = 2 and t1.student_id = t2.student_id AND t2.event_id = t1.event_id) as pm_out FROM events_attendance as t1 GROUP by event_id,student_id;

*/



//end class
}
 ?>