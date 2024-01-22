<?php 
/**
 * 
 */
class Personaldetails_model extends CI_Model
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}
	public function add($data='')
	{
		// code...
		$this->db->insert('personaldetails',$data);
		return $this->db->insert_id();
	}
	public function update($data)
	{
		// code...
		$this->db->where('id',$data->id);
		$this->db->update('personaldetails',$data);
	}
	public function find($data='')
	{
		// code...
		return $this->db->get_where('personaldetails',$data)->result();
	}
	public function list($data='')
	{

		// code...
		return $this->db->get('personaldetails')->result();
	}
	public function like($data)
	{
		$sql = $this->db->select('*')
				->from('personaldetails')
				->like('keywords',$data['keywords'])
				->or_like('keywords_2',$data['keywords']);
				//->get();
		 //return $this->db->get_compiled_select();

		 //$query = $this->db->($sql);//
		 return $this->db->get()->result();
	}
}

 ?>