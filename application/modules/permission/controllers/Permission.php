<?php 	
/*
* 	
* */
class Permission extends MY_Controller	
{
	 

   function __construct()
   {
     // code...
    parent::__construct();
   }

	function index($basic_id=0)
	{
		// code...
	}
	public function deny($value='')
	{
		// code...
		echo "No permission.<a href='".site_url()."'>Go to home.</a>";
	}



}			 ?>