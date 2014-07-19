<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserController extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->load->model('user');
	}

	public function indexAction()
	{
		$data['users'] = $this->user->get_last_ten();
		$this->load->view('user_list', $data);
	}

	public function newAction()
	{
		if($this->input->post()){
			$this->saveUser();
		}else{
			$this->load->view('user_new');
		}
	}

	private function saveUser()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('email', 'email');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('user_new');
			return;
		}

		$this->user->username = $_POST['username'];
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