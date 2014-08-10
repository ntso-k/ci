<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LogoutController extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function indexAction()
	{
		$this->auth->logout_admin();
		redirect(base_url('/admin/login'));
	}
}
