<?php

/**
 * The base controller which is used by the Front and the Admin controllers
 */
class Base_Controller extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('session', 'Auth'));
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
		$this->load->add_package_path(APPPATH.'themes/front/base/');
	}
}

class Admin_Controller extends Base_Controller 
{
	function __construct()
	{
		parent::__construct();

		//load the theme package
		$this->load->add_package_path(APPPATH.'themes/admin/base/');

		//check is logged in
		if('admin/login' != $this->uri->uri_string() && 'admin/logout' != $this->uri->uri_string() && !$this->auth->is_logged_in())
		{
			redirect(base_url('/admin/login?redirect='.urlencode($_SERVER['REQUEST_URI'])));
			die();
		}
	}
}