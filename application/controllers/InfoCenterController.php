<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class InfoCenterController extends Front_Controller {
	public function __construct()
	{
		parent::__construct();
		
		//check is logged in
		if(!$this->auth->is_account_logged_in())
		{
			redirect(base_url('/login?redirect='.urlencode($_SERVER['REQUEST_URI'])));
			die();
		}
	}

	public function indexAction($id=null)
	{
		$this->load->model('Account');
		
		$apps = array();
		
		if(!isset($id) && $this->auth->is_account_logged_in())
		{
			$id = $this->auth->get_account()->account_id;
		}
		$apps = $this->Account->get_apps($id);
		
		$this->load->view('infocenter', array('apps'=>$apps));;
	}
}
