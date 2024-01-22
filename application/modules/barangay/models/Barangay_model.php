<?php 


/**
 * 
 */
class Barangay_model extends CI_model
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

	public function info($name)
	{
		// code...
		$id = intval($name);
		$sql = sprintf("SELECT id,name FROM aaddress WHERE id = %u OR name = '%s'",$id,$name);
		$query = $this->db->query($sql);
		return $query->row(0);
	}
	public function getbyid($id=0)
	{
		// code...
		$sql = sprintf("SELECT id as barangay_id,name as barangay_name FROM aaddress WHERE id = %u",$id);
		$query = $this->db->query($sql);
		return $query->row(0);
	}
	public function getlistbytown($parent_id=0)
	{
		// code...
		return $this->db->get_where('aaddress',array('parent_id'=>$parent_id))->result();
	}
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