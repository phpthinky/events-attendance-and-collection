<?php 
/**
 * 
 */
class Mupload extends CI_Model
{
	
	function __construct()
	{
		// code...
		parent::__construct();
	}

	public function run($files='',$file_name='logo')
	{
		// code...
		$file = $_FILES[$files];
		$ext = pathinfo($file['name'],PATHINFO_EXTENSION);
		$filename = $file_name.'-'.uniqid().'.'.$ext;

		$config_upload['allowed_types'] = array('jpg','png','jpeg');
		//$config_upload['max_size'] = 500000;
		$config_upload['upload_path'] = 'assets/img/logo/';
		$config_upload['file_name'] = $filename;
		$this->load->library('upload',$config_upload);
		$result = $this->upload->do_upload($files);

		if($result){
			return base_url('assets/img/logo/'.$filename);
		}else{
			return base_url('assets/img/user.png');
		}

		//echo json_encode($this->upload->data());
	}

	public function site_logo($files='',$file_name='sitelogo')
	{
		// code...
		$file = $_FILES[$files];
		$ext = pathinfo($file['name'],PATHINFO_EXTENSION);
		$filename = $file_name.'-'.rand(000,999).'.'.$ext;

		$config_upload['allowed_types'] = array('jpg','png','jpeg');
		//$config_upload['max_size'] = 500000;
		$config_upload['upload_path'] = 'assets/img/logo/';
		$config_upload['file_name'] = $filename;
		$this->load->library('upload',$config_upload);
		$result = $this->upload->do_upload($files);

		if($result){
			return base_url('assets/img/logo/'.$filename);
		}
		return false;
	}

	public function login_logo($files='',$file_name='sitelogo')
	{
		// code...
		$file = $_FILES[$files];
		$ext = pathinfo($file['name'],PATHINFO_EXTENSION);
		$filename = $file_name.'-'.rand(000,999).'.'.$ext;

		$config_upload['allowed_types'] = array('jpg','png','jpeg');
		//$config_upload['max_size'] = 500000;
		$config_upload['upload_path'] = 'assets/img/';
		$config_upload['file_name'] = $filename;
		$this->load->library('upload',$config_upload);
		$result = $this->upload->do_upload($files);

		if($result){
			return base_url('assets/img/'.$filename);
		}
		return false;
	}
	public function profile($files='',$file_name='profile')
	{
		// code...
		$file = $_FILES[$files];
		$ext = pathinfo($file['name'],PATHINFO_EXTENSION);
		$filename = $file_name.'-'.uniqid().'.'.$ext;

		$config_upload['allowed_types'] = array('jpg','png','jpeg');
		//$config_upload['max_size'] = 500000;
		$config_upload['upload_path'] = 'assets/img/profile/';
		$config_upload['file_name'] = $filename;
		$this->load->library('upload',$config_upload);
		$result = $this->upload->do_upload($files);

		if($result){
			return base_url('assets/img/profile/'.$filename);
		}else{
			return base_url('assets/img/user.png');
		}

		//echo json_encode($this->upload->data());
	}

}

 ?>