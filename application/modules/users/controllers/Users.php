<?php 

/**
  * 
  */
 class Users extends MY_Controller
 {
 	private $userId;
 	function __construct()
 	{
 		// code...
 		parent::__construct();
 		if(!$this->aauth->is_loggedin()){
 			redirect('login');
 		}
 		$this->userId = $this->session->userdata('id');
 	}
 	public function index($value='')
 	{
 		// code...
 		if ($this->input->post()) {
 			// code...
 			$action = $this->input->post('action');
 			if ($action == 'delete-user') {
 				// code...
 				$this->delete_user();
 				exit();
 			}

 			if ($action == 'add-user') {
 				// code...
 				$this->add_user();
 				exit();
 			}

 			if ($action == 'edit-user') {
 				// code...
 				$this->edit_user();
 				exit();
 			}
 			echo json_encode(noinput());
 			exit();
 		}
 		$data = new stdClass();

 		$users = $this->aauth->get_user();


 		$data->email = $users->email;
 		$data->username = $users->email;
 		$data->list_users = $this->aauth->list_users();
 		$data->content = 'users/index';
 		$this->template->load($this->theme,$data);
 	}
 	public function add_user($value='')
 	{
 		// code...
 		$email = $this->input->post('email');
 		$username = $this->input->post('username');
 		$passcode = $this->input->post('passcode');
 		if($add_user = $this->aauth->create_user($email,$passcode,$username)){
 		echo json_encode(array('status'=>true,'msg'=>'User successfully added','data'=>$add_user));

 		}else{ 		
 			echo json_encode(array('status'=>false,'msg'=>'Failed! No user was added.','data'=>$add_user));


 		}
 	}

 	public function edit_user($value='')
 	{
 		// code...
 		$user_id = $this->input->post('user_id');
 		$email = $this->input->post('email');
 		$username = $this->input->post('username');
 		$passcode = $this->input->post('passcode')
 		;
 		if($add_user = $this->aauth->update_user($user_id,$email,$passcode,$username)){
 		echo json_encode(array('status'=>true,'msg'=>'User successfully added','data'=>$add_user));

 		}else{ 		
 			echo json_encode(array('status'=>false,'msg'=>'Failed! No user was added.','data'=>$add_user));


 		}
 	}

 	private function delete_user($value='')
 	{
 		// code...
 		$deleted = $this->aauth->delete_user($this->input->post('id'));
 		echo json_encode(array('status'=>true,'msg'=>'Deleted successfully','data'=>$deleted));
 	}
 	public function update($type='')
 	{
 		// code...
 		if ($this->input->post()) {
 			// code...
		 		$users = $this->aauth->get_user();

 			if ($type == 'email') {
 				// code...

		 		if ($users->pass == $this->aauth->hash_password($this->input->post('cpassword'),$this->userId)) {

				$this->aauth->update_user($this->userId,$this->input->post('email'));
		 				echo json_encode(array('status'=>true,'msg'=>'Email changed.'));	

				}else{
		 			echo json_encode(array('status'=>false,'msg'=>'Invalid password!'));

				}
 			}
 			if ($type == 'password') {
 				// code...

		 		if ($users->pass == $this->aauth->hash_password($this->input->post('cpassword'),$this->userId)) {
		 			// code...

		 			if($result = $this->aauth->update_user($this->userId,null,$this->input->post('npassword'),$this->input->post('username'))){

		 				echo json_encode(array('status'=>true,'msg'=>'Password changed.'));	
			 		}else{

			 			echo json_encode(showresponse(2));
			 		}
		 		}else{
		 			echo json_encode(array('status'=>false,'msg'=>'Invalid password!'));
		 		}
 			}
			exit();
 		}else{
 			echo json_encode(noinput());
 		}
 	}




/*8888 8888)*/
 } ?>