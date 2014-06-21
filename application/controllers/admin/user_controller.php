<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Controller extends Admin_Controller {

	public function index()
	{
		$this->load->view('dashboard');
	}

	public function newUser()
	{
		echo 'New User!';
	}

	public function _remap($method, $params = array())
	{
		switch ($method)
		{
			case 'new':
				$this->newUser($params);
				break;
			default:
				$this->default_method();
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/admin/user.php */