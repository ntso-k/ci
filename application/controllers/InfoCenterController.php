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
		$this->load->model(array('Account', 'WebApp'));
		
		$apps = array();
		
		if(!isset($id) && $this->auth->is_account_logged_in())
		{
			$account_id = $this->auth->get_account()->account_id;
		}

		$boards = $this->Account->get_boards($account_id);
        foreach($boards as $key => $board)
        {
            $boards[$key]->apps = $this->WebApp->get_by_board_id($board->board_id);
        }
		
		$this->load->view('infocenter', array('boards'=>$boards));;
	}
}
