<?php 

if (!function_exists('is_active')) {
	// code...
	function is_active($num)
	{
		// code...
		$status = '';
		switch ($num) {
			case 1:
				// code...
			$status = 'Active';
				break;
			case 2:
			$status = 'Completed';
			break;
			default:
				// code...
			$status ="Inactive";
				break;
		}
		return $status;
	}
}
if (!function_exists('gender')) {
	// code...
	function gender($num)
	{
		// code...
		$gender = '';
		switch ($num) {
			case 1:
				// code...
			$gender = 'Male';
				break;
			case 2:
			$gender = 'Female';
			break;
			default:
				// code...
			$gender ="Unknown";
				break;
		}
		return $gender;
	}
}

if (!function_exists('profile')) {
			function profile($data)
		{
			// code...
			$profile = $data->profile;
			if (empty($data->profile)) {
				// code...
				
				switch ($data->gender) {
                    case '1':
                      // code...
                      $profile = base_url('assets/dist/img/user2-160x160.jpg');
                      break;

                    case '2':
                      // code...
                      $profile = base_url('assets/dist/img/user4-128x128');
                      break;
                    default:
                      // code...
                      $profile = base_url('assets/dist/img/user2-160x160.jpg');
                      break;
                  }

			}
			return	 $profile;
		}
}
if (!function_exists('tomdy')) {
			function tomdy($date){
					$date = strtotime($date);
					return date('m/d/Y',$date);
		
		}
}


if (!function_exists('toMMdY')) {
			function toMMdY($date){
					$date = strtotime($date);
					return date('M d, Y',$date);
		
		}
}

if (!function_exists('date_time')) {
			function date_time($date){
					$date = strtotime($date);
					return date('M d, Y H:i:s',$date);
		
		}
}
if (!function_exists('noinput')) {
			function noinput(){
		return array('status'=>false,'msg'=>'No input data.');

		}
}

if (!function_exists('recordexist')) {
			function recordexist(){
		return array('status'=>false,'msg'=>'Record already exist.');

		}
}


if (!function_exists('unknownerror')) {
			function unknownerror(){
		return array('status'=>false,'msg'=>'Something went wrong. Pls. try again.');

		}
}

if (!function_exists('dbError')) {
			function dbError($type=false){
				if (!$type) {
					// code...
		return array('status'=>false,'msg'=>'No data was added. Database error occcured.');
				}else{

		return json_encode(array('status'=>false,'msg'=>'No data was added. Database error occcured.'));
				}

		}
}
if (!function_exists('savesuccess')) {
			function savesuccess($type=false){
				if (!$type) {
					// code...

		return array('status'=>true,'msg'=>'Successfully added.');
				}else{

		return json_encode(array('status'=>true,'msg'=>'Successfully added.'));
				}


		}
}

if (!function_exists('update')) {
			function update($error=false){
				if ($error) {
					// code...

		return array('status'=>false,'msg'=>'No changes.');
				}else{

		return array('status'=>true,'msg'=>'Successfully updated.');
				}


		}
}

if (!function_exists('getAge')) {
	// code...
	function getAge($dob,$cod=false,$format = false){

	$dateofbirth = new DateTime($dob);
	if (!empty($cod)) {
		// code...
	$today = new DateTime($cod);
	}else{
	$today = new DateTime(date('Y-m-d'));

	}
		$age = $today->diff($dateofbirth);
		return $age;
	}
}


if (!function_exists('getDays')) {
	// code...
	function getDays($dob,$cod=false,$format = false){

	$dateofbirth = new DateTime($dob);
	if (!empty($cod)) {
		// code...
	$today = new DateTime($cod);
	}else{
	$today = new DateTime(date('Y-m-d'));

	}
		$age = $today->diff($dateofbirth);
		return $age->d;
	}
}

if (!function_exists('to_batch_array')) {
	// code...
	function to_batch_array($array,$item){
		$data=array();
          $keys = array();
          for ($i=0; $i < count($array[$item]); $i++) { 
            // code...

               foreach ($array as $key => $value) {
                if ($i<=0) {
                  // code...
                $keys[] = $key;
                }
               }
               foreach ($keys as $k => $v) {
                   $data[$i][$v] = $array[$v][$i];
                  

               }

          }
          return $data;
	}
}

if (!function_exists('job_status')) {
	// code...
	function job_status($num){
		$job ='Unknown';
		switch ($num) {
			case 1:
				// code...
			$job = 'Job Order';
				break;
			
			case 2:
				// code...
			$job = 'Contractual';
				break;
			case 3:
				// code...
			$job = 'Permanent';
				break;
			case 4:
				// code...
			$job = 'Resigned';
				break;
			case 5:
				// code...
			$job = 'Retired';
				break;

			default:
				// code...
			$job = 'Not Specified';
				break;
		}
		return $job;
	}

}


if (!function_exists('booking_status')) {
	// code...
	function booking_status($num){
		$job ='Unknown';
		switch ($num) {
			case 1:
				// code...
			$job = 'Approved';
				break;
			
			case 2:
				// code...
			$job = 'Disapproved';
				break;
			case 3:
				// code...
			$job = 'Canceled';
				break;
			case 4:
				// code...
			$job = 'Removed';
				break;
			default:
				// code...
			$job = 'Pending';
				break;
		}
		return $job;
	}

}


// ------------------------------------------------------------------------

if ( ! function_exists('template_url'))
{
	/**
	 * TEMPLATE URL
	 *
	 * Create a local URL based on your basepath.
	 * Segments can be passed in as a string or an array, same as site_url
	 * or a URL to a file can be passed in, e.g. to an image file.
	 *
	 * @param	string	$uri
	 * @param	string	$protocol
	 * @return	string
	 */
	function template_url($uri = '', $protocol = NULL)
	{

		$CI =& get_instance();
		//return $CI->config->site_url($CI->uri->uri_string());
		$theme = $CI->config->item('theme');
		$uri = 'templates'.DIRECTORY_SEPARATOR.$theme.DIRECTORY_SEPARATOR.$uri;
		return $CI->config->base_url($uri, $protocol);
	}
}
if ( ! function_exists('assets_url'))
{
	/**
	 * PUBLIC ASSETS URL
	 *
	 * Create a local URL based on your basepath.
	 * Segments can be passed in as a string or an array, same as site_url
	 * or a URL to a file can be passed in, e.g. to an image file.
	 *
	 * @param	string	$uri
	 * @param	string	$protocol
	 * @return	string
	 */
	function assets_url($uri = '', $protocol = NULL)
	{

		$CI =& get_instance();
		$uri = 'assets/'.$uri;
		return $CI->config->base_url($uri, $protocol);
	}
}


if ( ! function_exists('formatid'))
{
	/**
	 * PUBLIC ASSETS URL
	 *
	 * Create a local URL based on your basepath.
	 * Segments can be passed in as a string or an array, same as site_url
	 * or a URL to a file can be passed in, e.g. to an image file.
	 *
	 * @param	string	$uri
	 * @param	string	$protocol
	 * @return	string
	 */
	function formatid($string = '', $protocol = 5)
	{
		return str_pad($string,$protocol,'0',STR_PAD_LEFT);
	}
}

if ( ! function_exists('time_format'))
{
	/**
	 * PUBLIC ASSETS URL
	 *
	 * Create a local URL based on your basepath.
	 * Segments can be passed in as a string or an array, same as site_url
	 * or a URL to a file can be passed in, e.g. to an image file.
	 *
	 * @param	string	$uri
	 * @param	string	$protocol
	 * @return	string
	 */
	function time_format($time = '', $protocol = null)
	{

		if ($protocol == null) {
			// code...
			return date('h:i a',strtotime($time));
		}else{
			return date($protocol,strtotime($time));

		}
	}
}


if ( ! function_exists('semester'))
{
	/**
	 * PUBLIC ASSETS URL
	 *
	 * Create a local URL based on your basepath.
	 * Segments can be passed in as a string or an array, same as site_url
	 * or a URL to a file can be passed in, e.g. to an image file.
	 *
	 * @param	string	$uri
	 * @param	string	$protocol
	 * @return	string
	 */
	function semester($num = '', $protocol = null)
	{
		if ($numb == 1) {
			// code...
			$sem = 'First semester';
		}elseif ($numb == 2) {
			// code...
			$sem = 'First semester';
		}else{
			$sem = '';
		}
		return $sem;
	}
}


 ?>