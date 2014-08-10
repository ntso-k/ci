<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WebAppController extends Front_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->helper(array('form', 'text'));
		$this->load->model('WebApp');
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
	
	public function addToAccountAction($key)
	{
		if($this->auth->is_account_logged_in() == false)
		{
			echo false;
			return;
		}
		$webApp = $this->WebApp->get($key);
		if(empty($webApp))
		{
			echo 'App not exist.';
			return;
		}
		
		$account = $this->auth->get_account();
		$result = $this->WebApp->add_to_account($account->account_id, $webApp->web_app_id);
		echo $result;
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
