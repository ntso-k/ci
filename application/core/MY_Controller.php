<?php

/**
 * The base controller which is used by the Front and the Admin controllers
 */
class Base_Controller extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();

		//load common helper
		$this->load->helper(array('url', 'file', 'string', 'html', 'language'));
	}
	
}//end Base_Controller

class Front_Controller extends Base_Controller
{
	function __construct()
	{
		parent::__construct();

		//load the theme package
		$this->load->add_package_path(APPPATH.'themes/base/');
	}
}

class Admin_Controller extends Base_Controller 
{
	function __construct()
	{
		parent::__construct();

		//load the theme package
		$this->load->add_package_path(APPPATH.'themes/admin/');
	}
}