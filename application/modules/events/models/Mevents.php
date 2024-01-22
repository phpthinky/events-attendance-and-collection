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
		if ($current == 'current') {
			// code...

		$this->db->where('event_startdate = ', date('Y-m-d'));//.'" and status = 0 ');
		$this->db->or_where('event_enddate >= ', date('Y-m-d'));//.'" and status = 0 ');
		$this->db->or_where('status',1);

		$query=$this->db->get('events');

		return $query->result();

		}elseif ($current === 'canceled') {
			// code...
		
		$this->db->where('event_startdate < ', date('Y-m-d'));//.'" and status = 0 ');
		$this->db->where('event_enddate < ', date('Y-m-d'));//.'" and status = 0 ');
		$this->db->where('status',0);
		$this->db->or_where('status',3);
		$query=$this->db->get('events');

		return $query->result();

		}elseif ($current === 'active') {
			// code...

		$this->db->where('event_startdate = ', date('Y-m-d'));//.'" and status = 0 ');
		$this->db->where('event_enddate >= ', date('Y-m-d'));//.'" and status = 0 ');
		$this->db->where('status',1);

		$query=$this->db->get('events');

		return $query->result();

		}
		elseif ($current === 'incoming') {
			// code...

		$this->db->where('status',0);

		$this->db->where('event_startdate >=', date('Y-m-d'));//.'" and status = 0 ');
		$this->db->where('event_enddate >= ', date('Y-m-d'));//.'" and status = 0 ');
		$query=$this->db->get('events');

		return $query->result();

		}

		elseif ($current === 'completed') {
			// code...
		return $this->db->order_by('event_startdate','ASC')->get_where('events',array('status'=>2))->result();

		}
		else{
		return $this->db->order_by('event_startdate','ASC')->get('events')->result();

		}
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
		return $this->db->get_where('events',array('id'=>$id))->row(0);
	}
	public function get_currentevent()
	{
		// code...
		return $this->db->limit(1)->get_where('events',array('status'=>1))->row(0);
	}
}

 ?>