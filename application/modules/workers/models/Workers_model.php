<?php 


/**
 * 
 */
class Workers_model extends CI_model
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}

	public function getWorkerId($id)
	{
		// code...
		$this->db->where('userId',$id);
		$result = $this->db->get('eworkers')->row(0);
		return $result->workersId;
	}
	public function getWorkerUserId($id)
	{
		// code...
		$this->db->where('workersId',$id);
		$result = $this->db->get('eworkers')->row(0);
		return $result->userId;
	}
	public function getWorker($id)
	{
		// code...
		//return $this->db->get_where('eworkers', array('workersId'=>$id))->row(0);
		$query = $this->db->select('w.*,u.email')
							->from('eworkers w')
							->join('aauth_users u','u.id = w.userId')
							->where('workersId',$id)
							->get();
							if($result = $query->result()){
								return $result[0];
							}
							return false;

	}
	public function get_center($id)
	{
		// code...
		$row = $this->db->get_where('center_workers',array('worker_id'=>$id))->row(0);
			return $row->center_id;
	}
	public function get_student_info($id,$worker,$center)
			{
				// code...
				return $this->db->get_where('center_students_schoolyear',array('student_id'=>$id,'center_id'=>$center,'worker_id'=>$worker))->row(0);
			}		
	public function list_active_Workers($center_id='')
	{
		// code...
		if (!empty($center_id)) {
			// code...
			return $this->db->get_where('center_workers_schoolyear',array('center_id'=>$center_id))->result();

		}else{
			return $this->db->get('center_workers_schoolyear')->result();
		}
	}


	public function list_inactive_Workers($center_id='')
	{
		// code...
		if (!empty($center_id)) {
			// code...
			return $this->db->get_where('eworkers_inactive',array('center_id'=>$center_id))->result();

		}else{
			return $this->db->get('eworkers_inactive')->result();
			
		}
	}
	public function list_all_Workers($center_id='')
	{
		// code...
		if (!empty($center_id)) {
			// code...
			return $this->db->get_where('center_workers',array('center_id'=>$center_id))->result();

		}else{
			return $this->db->get('center_workers')->result();
		}
	}
	public function save($data='')
	{
		// code...
		if (!empty($data->workersId)) {
			// code...
			return $this->edit($data);
		}else{
			return $this->add($data);
		}
	}
	public function add($data='')
	{
		// cod
			if($this->db->insert('eworkers',$data)){
			return array('status'=>true,'msg'=>'Successfully added!');

			}else{
				return array('status'=>false,'msg'=>'Database error: Unknown error occured.');
			}

	}

	public function edit($data)
	{
		

			try {
				$this->db->where('workersId',$data->workersId);	
				$this->db->update('eworkers',$data);	
				$result = array('status'=>true,'msg'=>'Successfully updated!');

			} catch (Exception $e) {
				$result = array('status'=>false,'msg'=>$e->getMessage());
			}
				return $result;
		
		return $result;

	}

	public function exists($data)
	{
		// code...
		//return $this->db->get_where('ecenter',['centerName'=>$str])->result();
		$this->db->where('fName',$data->fName);
		$this->db->where('mName',$data->mName);
		$this->db->where('lName',$data->lName);
		$this->db->where('ext',$data->ext);
		if($this->db->get('eworkers')->result()){
			return true;
		}
		return false;
	}
		public function getWorkers()
	{
		// code...
		$this->db->select("workersId,CONCAT(fName,' ', mName,' ', lname,' ', ext) as workerName");
		return $this->db->get('eworkers')->result();
	}
		public function getAll()
	{
		// code...
		//$this->db->select('workersId,CONCAT(fName, mName, lname, ext) as workerName');
		return $this->db->get('eworkers')->result();
	}

		public function getCountAll($centerId=false)
	{
		// code...
		if ($centerId) {
				// code...
			$this->db->where('centerId',$centerId);
		}
		$query = $this->db->get('eworkers');
		return $query->num_rows();
	}
	public function getCenterWorkers($centerId)
	{
		// code...
		$this->db->select("workersId,CONCAT(fName,' ', mName,' ', lname,' ', ext) as workerName");
		$this->db->where('centerId',$centerId	);
		return $this->db->get('eworkers')->result();
	}
	public function addtomyschoolyear($data)
	{
		// code...
		if (!$this->checkMySchooYear($data)) {
			// code...
			$this->db->insert('eschoolyear_by_worker',$data);
			return array('status'=>true,'msg'=>'Successfully added.');
		}else{
			return array('status'=>false,'msg'=>'Record already exist.');

		}
	}
	public function checkMySchooYear($data)
	{
		// code...
		$this->db->where('workersId',$data->workersId);
		$this->db->where('YearId',$data->YearId);

		$query = $this->db->get('eschoolyear_by_worker');
		if($query->num_rows() > 0 ){
			return true;
		}
		return false;
	}
	public function listmyschoolyear($worker)
	{
		// code...
		$data = array();
		if($result =  $this->db->get_where('center_workers_schoolyear',array('worker_id'=>$worker))->result()){
			/* $id = $stmt['worker_id'];
			foreach ($result as $key => $value) {
				// code...

				$data[$key] = $value;
				$data[$key]->totalPupils = $this->getTotalStudents($value->year_id,$id);
				$data[$key]->totalRepeater = $this->getTotalStudentsByType($value->year_id,$id,2);
				$data[$key]->totalGraduates = $this->getTotalStudentsByType($value->year_id,$id,3);
			}

			*/
			return $result;
		}
		return false;
	}
	public function listmyschoolyear111($id)
	{
		// code...
		$this->db->select('eschoolyear.YearId,YearStart,YearEnd');
		$this->db->from('eschoolyear');
		$this->db->join('eschoolyear_by_worker','eschoolyear.YearId = eschoolyear_by_worker.YearId',false);
		$this->db->where('eschoolyear_by_worker.workersId',$id);
		$query = $this->db->get();
		if($result = $query->result()){
			$data =  array();
			foreach ($result as $key => $value) {
				// code...
				$data[$key] = $value;
				$data[$key]->totalPupils = $this->getTotalStudents($value->YearId,$id);
				$data[$key]->totalRepeater = $this->getTotalStudentsByType($value->YearId,$id,2);
				$data[$key]->totalGraduates = $this->getTotalStudentsByType($value->YearId,$id,3);
			}
			return $data;
		}
		return false;
	}
	public function getTotalStudents($YearId,$workersId)
	{
		// code...
	$this->db->select("c.*");
    $this->db->from('eschoolyear_by_worker a');
    $this->db->join('eschoolyear_by_worker_students b','b.YearId = a.YearId','left');
    $this->db->join('epupils c','c.pupilsId = b.studentId','left');
    $this->db->where('b.YearId',$YearId);
    $this->db->where('b.workersId',$workersId  );
    $this->db->group_by('c.pupilsId');
    $query = $this->db->get();
    return $query->num_rows();
	}

	public function getTotalStudentsByType($YearId,$workersId,$type)
	{
		// code...
	$this->db->select("c.*");
    $this->db->from('eschoolyear_by_worker a');
    $this->db->join('eschoolyear_by_worker_students b','b.YearId = a.YearId','left');
    $this->db->join('epupils c','c.pupilsId = b.studentId','left');
    $this->db->where('a.YearId',$YearId);
    $this->db->where('a.workersId',$workersId  );
    $this->db->where('b.StudentType',$type  );
    $query = $this->db->get();
    return $query->num_rows();
	}

	public function listMyStudents($id)
	{
		// code...
		$this->db->select('eschoolyear.YearId,YearStart,YearEnd');
		$this->db->from('eschoolyear');
		$this->db->join('eschoolyear_by_worker','eschoolyear.YearId = eschoolyear_by_worker.YearId',false);
		$query = $this->db->get();
		return $query->result();
	}
	public function getMyCenterId($workersId)
	{
		// code...
		$result = $this->db->get_where('eworkers',array('workersId'=>$workersId))->row(0);
		if (!empty($result) ){
			// code...
		return $result->workersId;

		}
		return 0;
	}


	public function getStartEndClassess($id)
	{
		// code...
		$result = $this->db->get_where('eschoolyear',array('YearId'=>$id))->row(0);
		return tomdy($result->YearStart).' to '.tomdy($result->YearEnd);
	}

	public function addtomystudent($data)
	{
		// code...
			if (!$this->myStudentExist($data)) {
				// code...

			 $this->db->insert('eschoolyear_by_worker_students',$data);

			 return true;
			}
			return false;
	}
	public function myStudentExist($data)
	{
		// code...
		$this->db->select('*');
		$this->db->from('eschoolyear_by_worker_students a');
		$this->db->join('eschoolyear_by_worker b','b.YearId = a.YearId');
		$this->db->where('a.YearId',$data->YearId);
		$this->db->where('a.StudentId',$data->StudentId);
		$this->db->where('b.workersId',$data->workersId);
		$query = $this->db->get('eschoolyear_by_worker_students');
		if($query->num_rows() > 0){
			return true;
		}
		return false;
	}
	
	public function remove($id='')
	{
		// code...
	// code...

		$this->db->delete('eschoolyear_by_worker',array('workersId'=>$id));
		$this->db->delete('eschoolyear_by_worker_students',array('workersId'=>$id));

		$user_id = $this->getWorkerUserId($id);
		$this->db->delete('aauth_users',array('id'=>$user_id));
		$this->db->delete('aauth_user_to_group',array('user_id'=>$user_id));
		$this->db->delete('aauth_perm_to_user',array('user_id'=>$user_id));
		

		$this->db->delete('eworkers',array('workersId'=>$id));
		return true;
	}

	public function remove_schoolyear($data)
	{
		// code...
	// code...
		$result =array();
		$result[] = $this->db->delete('eschoolyear_by_worker',$data);
		$result[] = $this->db->delete('eschoolyear_by_worker_students',$data);
		return $result;
	}

	public function my_students($worker=0,$center=0,$class_schedule=false)
	{
		// code...
		if ($class_schedule) {
			// code...
		return $this->db->get_where('center_students_schoolyear',array('center_id'=>$center,'worker_id'=>$worker,'year_id'=>$class_schedule))->result();

		}
		return $this->db->get_where('center_students_schoolyear',array('center_id'=>$center,'worker_id'=>$worker))->result();
	
	}
	public function remove_student($student_id,$worker_id,$year_id)
	{
		// code...
		$this->db->where('YearId',$year_id);
		$this->db->where('studentId',$student_id);
		$this->db->where('workersId',$worker_id);
		return $this->db->delete('eschoolyear_by_worker_students');
	}
}
 ?>