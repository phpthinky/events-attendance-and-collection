<?php 
/**
 * 
 */
class Mcourse extends CI_Model
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}
	public function add($data='')
	{
		// code...
		$this->db->insert('course',$data);
		return $this->db->insert_id();
	}
	public function update($data)
	{
		// code...
		$this->db->where('id',$data->id);
		$this->db->update('course',$data);
	}
	public function find($data='')
	{
		// code...
		return $this->db->get_where('course',array('course_title'=>$data->course_title))->result();
	}
	public function list($data='')
	{

		// code...
		return $this->db->get('course')->result();
	}

	public function list_side_course($data='')
	{

		// code...
		$courses = array();
		if($result = $this->db->get('course')->result()){
			foreach ($result as $key => $value) {
				// code...
				$courses[] = $value->course_sub_title;
			}
		}
		return $courses;
	}
	public function like($data)
	{
		$sql = $this->db->select('*')
				->from('course')
				->like('keywords',$data['keywords'])
				->or_like('keywords_2',$data['keywords']);
				//->get();
		 //return $this->db->get_compiled_select();

		 //$query = $this->db->($sql);//
		 return $this->db->get()->result();
	}
	public function get_id($key='')
	{
		// code...
		$sql = $this->db->select('id')
			->from('course')
			->where('course_title',$key)
			->or_where('course_sub_title',$key);
			$query = $this->db->get();
			if($row = $query->row(0)){
				return $row->id;
			}
			return 0;
	}

	public function get_coursesubtitle($key='')
	{
		// code...
		$sql = $this->db->select('*')
			->from('course')
			->where('id',$key);
			$query = $this->db->get();
			if($row = $query->row(0)){
				return $row->course_sub_title;
			}
			return 0;
	}
}

 ?>