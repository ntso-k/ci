<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Controller extends Admin_Controller {

	public function index()
	{
		$this->load->model('user');
		$data['users'] = $this->user->get_last_ten();
		$this->load->view('user_list', $data);
	}

	public function newUser()
	{
		$this->load->view('user_new');
	}

	public function save()
	{
		$this->load->model('user');
		$this->user->name = $_POST['name'];
		$this->user->password = $_POST['password'];
		$this->user->email = $_POST['email'];
		$this->user->insert();

		header("Location: ".base_url('/admin/user'));
	}

	public function _remap($method, $params = array())
	{
		switch ($method)
		{
			case 'new':
				$this->newUser($params);
				break;
			default:
				$this->$method($params);
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/admin/user.php */