<?php 
/**
 * 
 */
class Mstudents extends CI_Model
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}
	public function add($data='')
	{
		// code...
		$student_name = array(
			'fName'=>$data->fName,
			'mName'=>$data->mName,
			'lName'=>$data->lName,
			'ext'=>$data->ext,
		);
		if (!$this->find($student_name)) {
			// code...

		$this->db->insert('students',$data);
		return $this->db->insert_id();

		}else{
			return false;
		}
	}
	public function update($data)
	{
		// code...
		$this->db->where('id',$data->id);
		$this->db->update('students',$data);
	}

	public function update_by_code($data)
	{
		// code...
		$this->db->where('code',$data->code);
		return $this->db->update('students',$data);
	}
	public function find($data='')
	{
		// code...
		$this->db
			->select('*')
			->from('students')
			->join('course_students','student_id = code')
			->where($data);
			$query = $this->db->get();
			if($result =$query->result()){
				foreach ($result as $key => $value) {
					// code...

					if($course = $this->getCourse($value->code)){

					$result[$key]->course_id = $course->course_id;
					$result[$key]->course_sub_title = $course->course_sub_title;
					$result[$key]->year = $course->year;
					$result[$key]->section = $course->section;
					$result[$key]->grade = $course->grade;
					}
				}
				return $result;
			}
			return null;
			//->get_where('students',$data)->result();
	}

	public function getbyid($id=0)
	{
		// code...
		return $this->db->get_where('students',array('code'=>$id))->row(0);
	}

	public function getbycode($id='')
	{
		// code...
		$row = $this->db->get_where('students',array('code'=>$id))->row(0);

		if (!empty($row)) {
			// code...
					$row->course_id = 0;
					$row->course_sub_title = '';
					$row->year = 0;
					$row->section = '';
					$row->grade = 0;

					if($course = $this->getCourse($row->code)){

					$row->course_id = $course->course_id;
					$row->course_sub_title = $course->course_sub_title;
					$row->year = $course->year;
					$row->section = $course->section;
					$row->grade = $course->grade;
					$row->year_id = $course->year_id;
					$row->enrolled_status = $course->status;
					$row->semester = $course->semester;

					$sy = $this->db->get_where('settings_schoolyear',array('id'=>$row->year_id))->row(0);
					$row->sy = tomdy($sy->start_year).' - '.tomdy($sy->end_year);

					}
		}
		return $row;
	}

	public function info($id='')
	{
		// code...
		$row = $this->db->get_where('students',array('code'=>$id))->row(0);

		if (!empty($row)) {
			// code...
					$row->course_id = 0;
					$row->course_sub_title = '';
					$row->year = 0;
					$row->section = '';
					$row->grade = 0;

					if($course = $this->getCourse($row->code)){

					$row->course_id = $course->course_id;
					$row->course_sub_title = $course->course_sub_title;
					$row->year = $course->year;
					$row->section = $course->section;
					$row->grade = $course->grade;
					$row->year_id = $course->year_id;
					$row->enrolled_status = $course->status;
					$row->semester = $course->semester;

					$sy = $this->db->get_where('settings_schoolyear',array('id'=>$row->year_id))->row(0);
					$row->sy = tomdy($sy->start_year).' - '.tomdy($sy->end_year);

					}
		}
		return $row;
	}
	public function total($course_id=0)
	{
		// code...
		return $this->db->get('students')->num_rows();
	}
	public function list($data='')
	{

		// code...
		//return $this->db->get('students')->result();

		$sql = sprintf("SELECT students.*,course_id,year,grade,section,course_sub_title FROM `students` JOIN course_students ON course_students.student_id = students.id JOIN course ON course_students.course_id = course.id;");
					
					$query = $this->db->query($sql);
					return $query->result();
	}

	public function listbycourse($course_id=0)
	{

		// code...
		//$sql = sprintf("SELECT students.*,late,absent FROM `course_students` JOIN students ON students.code = course_students.student_id JOIN v_penalty_total ON v_penalty_total.student_id = students.code WHERE course_students.course_id = %u;",$course_id);
		$sql = $this->db
			->select('students.*,sum(late) as late,sum(absent) as absent')
			->from('students')
			->join('v_penalty_total','students.code = v_penalty_total.student_id','LEFT')
			->where('course_id',$course_id)
			->group_by('student_id');


		$query =  $this->db->get();
		
			if($result = $query->result()){
				$data = array();
				foreach ($result as $key => $value) {
					// code...

					$result[$key]->course_id = 0;
					$result[$key]->course_sub_title = '';
					$result[$key]->year = 0;
					$result[$key]->section = '';
					$result[$key]->grade = 0;

					if($course = $this->getCourse($value->code)){

					$result[$key]->course_id = $course->course_id;
					$result[$key]->course_sub_title = $course->course_sub_title;
					$result[$key]->year = $course->year;
					$result[$key]->section = $course->section;
					$result[$key]->grade = $course->grade;
					}
					$result[$key]->total_bayad = 0;

					if($b_bayad  =$this->getBayad($value->code)){
						$result[$key]->total_bayad = $b_bayad->total_na_bayad;
					}
				}
				return $result;
			}
			return false;
		//$result = $query->result();
		//return $this->db->get_where('students')->result();
		/*
		$sql = sprintf("select distinct course_students.id as course_id,course.course_sub_title,course_students.year,course_students.grade,course_students.section,course_students.status as student_status,students.* from students JOIN course_students ON course_students.student_id = students.id JOIN course on course.id = course_students.course_id where course_id = %u;",$course);

					$query = $this->db->query($sql);
					return $query->result();

					*/



	}
	public function check_idnumber($id_number='')
	{
		// code...
		return $this->db->get_where('students',array('code'=>$id_number))->result();
	}

	public function listbycollection($data='')
	{

		// code...
		return $this->db->get('students')->result();
	}

	public function listbystudentsbypenalty($course_id='')
	{

		// code...
		//return $this->db->get('students')->result();
		$this->db
			->select('students.*,sum(late) as late,sum(absent) as absent')
			->from('students')
			->join('v_penalty_total','students.code = v_penalty_total.student_id','LEFT')
			->group_by('student_id');
			$query = $this->db->get();
			if($result = $query->result()){
				$data = array();
				foreach ($result as $key => $value) {
					// code...

					$result[$key]->course_id = 0;
					$result[$key]->course_sub_title = '';
					$result[$key]->year = 0;
					$result[$key]->section = '';
					$result[$key]->grade = 0;

					if($course = $this->getCourse($value->code)){

					$result[$key]->course_id = $course->course_id;
					$result[$key]->course_sub_title = $course->course_sub_title;
					$result[$key]->year = $course->year;
					$result[$key]->section = $course->section;
					$result[$key]->grade = $course->grade;
					$result[$key]->year_id = $course->year_id;
					$result[$key]->status = $course->status;
					}
					$result[$key]->total_bayad = 0;

					if($b_bayad  =$this->getBayad($value->code)){
						$result[$key]->total_bayad = $b_bayad->total_na_bayad;
					}
				}
				return $result;
			}
			return false;




	}
	public function getCourse($student_id)
	{
		// code...
		//echo "$student_id";
		$this->db
			->select('year,section,grade,course.course_sub_title,course_id,year_id,course_students.status,course_students.semester')
			->from('course_students')
			->join('course','course_students.course_id = course.id')
			->where('course_students.student_id',$student_id);
			$query = $this->db->get();
			//var_dump($query->result());

			return $query->row(0);
			

	}

	public function getBayad($student_id)
	{
		// code...
		//echo "$student_id";
		$this->db
			->select('total_na_bayad')
			->from('v_bayad')
			->where('student_id',$student_id);
			$query = $this->db->get();
			return $query->row(0);
			

	}
	public function like($data)
	{
		$sql = $this->db->select('*')
				->from('students')
				->like('keywords',$data['keywords'])
				->or_like('keywords_2',$data['keywords']);
				//->get();
		 //return $this->db->get_compiled_select();

		 //$query = $this->db->($sql);//
		 return $this->db->get()->result();
	}

	public function save_course($data='')
	{
		// code...
		if ($this->db->get_where('course_students',array('student_id'=>$data->student_id))->result()) {
			// code...
			$this->db->where('student_id',$data->student_id);
			return $this->db->update('course_students',$data);
		}
		return $this->db->insert('course_students',$data);
	}
	public function quick_update($student_id='',$data=array())
	{
		// code...

			$this->db->where('student_id',$student_id);
			return $this->db->update('course_students',$data);

	}
	public function last_id()
	{
		// code...
		if($row = $this->db->order_by('id','DESC')->limit('1')->get('students')->row(0)){
			return $row->id;
		}
		return 0;
	}
}

 ?>