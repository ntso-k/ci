<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WebAppController extends Front_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->helper(array('form', 'text'));
		$this->load->model(array('WebApp', 'Board'));
	}

	public function indexAction()
	{
		$data['webApps'] = $this->WebApp->get_last_ten();
		$this->load->view('webapp/list', $data);
	}

	public function editAction($key)
	{
		echo $key;
	}

	public function viewAction($key=null)
	{
		if(is_numeric($key))
		{
			$webApp = $this->WebApp->get($key);
		}
		else
		{
			$webApp = $this->WebApp->get_by_appname($key);
		}
		
		if(!empty($webApp))
		{
			$this->load->view('webapp/view', array('webApp'=>$webApp));
			return;
		}
		
		show_404();
	}
	
	public function addToAccountAction()
	{
        $account = $this->auth->get_account();
		if(!$account)
		{
			echo json_encode(array('result' => 1, 'message'=>'Please login first!'));
			return;
		}
		$webApp = $this->WebApp->get($_POST['web_app_id']);
		if(empty($webApp))
		{
			echo json_encode(array('result' => 2, 'message'=>'App not exist.'));
			return;
		}
        $board = $this->Board->get($_POST['board_id']);
        if(empty($board) || $board->account_id != $account->account_id)
        {
            echo json_encode(array('result' => 3, 'message'=>'Board not exist'));
            return;
        }

		$result = $this->WebApp->add_to_board($board->board_id, $webApp->web_app_id);
        echo json_encode(array('result' => 0, 'message'=>'Added successfully!'));
	}
	
	public function _remap($method, $params = array())
	{
		if (method_exists($this, $method))
		{
			return call_user_func_array(array($this, $method), $params);
		}
		
		array_unshift($params, str_replace('Action', '', $method));
		return call_user_func_array(array($this, 'viewAction'), $params);
	}
}
