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
		return $this->db->get('events_collection')->result();
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

	public function getutangbystudentid($student_id='')
	{
		$this->db
			->select('v_penalty.*,events.event_title')
			->from('v_penalty')
			->join('events','events.id = v_penalty.event_id')
			->where('student_code',$student_id);
			$query = $this->db->get();
			return $query->result();
	}



}

 ?>