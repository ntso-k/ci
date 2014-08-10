<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LogoutController extends Front_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function indexAction()
	{
		$this->auth->logout_account();
		redirect(base_url('/login'));
	}
}
