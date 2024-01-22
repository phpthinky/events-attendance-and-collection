<?php 
/**
 * 
 */
class Home extends MY_Controller
{
	
	function __construct()
	{
		// code...
		parent::__construct();

		$this->load->model('packages/packages_model','mpackages');
		$this->load->model('settings/settings_model','msettings');
		$this->load->model('destinations/destinations_model','mdestinations');
		$this->theme = 'home';
	}

	public function index($value='')
	{
		// code...
		$data = new stdClass();
		$list_destinations =  $this->mdestinations->listall();
		if (!empty($list_destinations)) {
			// code...
			foreach ($list_destinations as $key => $destination) {
				// code...
				$list_destinations[$key]->photos = json_decode($destination->photos);
			}
		}
		$data->list_destinations =  $list_destinations;
		$list_packages =  $this->mpackages->list();

		if (!empty($list_packages)) {
			// code...
			foreach ($list_packages as $key => $pack) {
				// code...
				$list_packages[$key]->package = json_decode($pack->package);
			}
		}

		$data->list_packages =  $list_packages;
 		

		$content = $this->msettings->system_info(array('meta_field'=>'about_us'));
		$img_cover = $this->msettings->system_info(array('meta_field'=>'about_us_cover'));
		$img_thumbs = $this->msettings->system_info(array('meta_field'=>'about_us_thumbs'));
		
			$thumbs=array();
		
		if (!empty($img_thumbs)) {
			// code...
			foreach ($img_thumbs as $k => $img) {
				// code...
				$thumbs[] = $img->meta_value;
			}
		}
		$data->about_us = array('content'=>$content[0]->meta_value,'img_cover'=>$img_cover[0]->meta_value,'img_thumbs'=>$thumbs);
	
		$data->content = 'home/index';
		$this->template->load($this->theme,$data);
	}
}

 ?>