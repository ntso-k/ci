<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout_Controller extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function indexAction()
	{
		$this->auth->logout();
		redirect(base_url('/admin/login'));
	}
}
