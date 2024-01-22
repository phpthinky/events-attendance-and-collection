<?php 

/**
  * 
  */
 class Signout extends My_Controller
 {
 	
 	function __construct()
 	{
 		// code...
 		parent::__construct();

 	}
 	public function index(){

 		$this->aauth->logout();
 		echo "You been logout";
 		sleep(2);
 		redirect();
 	}
 } ?>