<?php 


/**
 * 
 */
class Affected_model extends CI_model
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}
	public function save($data='')
	{
		// code...
		if (!empty($data->centerId)) {
			// code...
			return $this->edit($data);
		}else{
			return $this->add($data);
		}
	}
	public function add($data='')
	{
		// code...

		$this->db->insert('apersondetails',$data);
		return $this->db->insert_id();
	}
	public function find($data='')
	{
		// code...
		return $this->db->get_where('apersondetails',$data)->row(0);
	}

	public function add_to_list($data)
	{
		// code...
	}
	public function list_name($barangay_id,$disaster_id)
	{
		// code...
		return $this->db->get_where('v_affected',array('disaster_id'=>$disaster_id,'barangay_id'=>$barangay_id))->result();

	}
	public function list_families($barangay_id,$disaster_id)
	{
		// code...
		
		$sql = sprintf("SELECT aaffected.*,v_affected_family.person_name,v_affected_family.barangay_id FROM `aaffected` JOIN v_affected_family ON v_affected_family.person_id = aaffected.person_id where aaffected.disaster_id = %u AND v_affected_family.barangay_id = %u; ",$disaster_id,$barangay_id);
		$query = $this->db->query($sql);
		return $query->result();
	}
























	///address
	public function listall($town=0,$province=0,$type=null,)
	{
		// code...


			if (!empty($type)) {
				// code...

			$sql =sprintf("WITH RECURSIVE aaddress_tree as ( SELECT * FROM aaddress WHERE parent_id IS NULL UNION ALL SELECT m.* from aaddress as m JOIN aaddress_tree AS t ON m.parent_id = t.id ) SELECT * FROM aaddress_tree WHERE type = %u;",$type);
			$query = $this->db->query($sql);
			return $query->result();

			}

		if(!empty($town)){
			//return $this->db->get('aaddress')->result();
			$sql =sprintf("WITH RECURSIVE aaddress_tree as ( SELECT * FROM aaddress WHERE parent_id IS NULL UNION ALL SELECT m.* from aaddress as m JOIN aaddress_tree AS t ON m.parent_id = t.id ) SELECT * FROM aaddress_tree where parent_id = %u;",$town);
			$query = $this->db->query($sql);
			return $query->result();
		}
			if (!empty($province)) {
			// code...

			//return $this->db->get('aaddress')->result();
			$sql =sprintf("WITH RECURSIVE aaddress_tree as ( SELECT * FROM aaddress WHERE parent_id IS NULL UNION ALL SELECT m.* from aaddress as m JOIN aaddress_tree AS t ON m.parent_id = t.id ) SELECT * FROM aaddress_tree where parent_id = %u;",$province);
			$query = $this->db->query($sql);
			return $query->result();

		}

			$sql ="WITH RECURSIVE aaddress_tree as ( SELECT * FROM aaddress WHERE parent_id IS NULL UNION ALL SELECT m.* from aaddress as m JOIN aaddress_tree AS t ON m.parent_id = t.id ) SELECT * FROM aaddress_tree where parent_id is null;";
			$query = $this->db->query($sql);
			return $query->result();


	}
}
//SELECT * FROM `aaddress` ORDER BY CASE WHEN parent_id = 0 THEN id ELSE parent_id END ASC , CASE WHEN parent_id = 0 then 0 ELSE id END ASC;

/*
WITH RECURSIVE aaddress as ( SELECT * FROM aaddress WHERE parent_id = 0
                           UNION ALL
                           SELECT m.* from aaddress as m JOIN aaddress AS t ON m.parent_id = t.id
                           )
SELECT * FROM `aaddress`;*/
 ?>