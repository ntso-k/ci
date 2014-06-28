<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_Controller extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo 'admin home';
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */