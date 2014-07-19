<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HomeController extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function indexAction()
	{
		echo 'admin home';
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */