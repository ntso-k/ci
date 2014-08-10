<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserController extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->load->model('user');
		$this->load->library('form_validation');
	}

	public function indexAction()
	{
		$data['users'] = $this->user->get_last_ten();
		$this->load->view('user_list', $data);
	}

	public function newAction()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('username', 'username', 'required');
			$this->form_validation->set_rules('email', 'email');
			//if this is a new account require a password, or if they have entered either a password or a password confirmation
			if ($this->input->post('password') != '' || $this->input->post('confirm_password') != '')
			{
				$this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]|sha1');
				$this->form_validation->set_rules('confirm_password', 'lang:confirm_password', 'required|matches[password]');
			}
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('user_new');
				return;
			}

			$user['username'] = $this->input->post('username');
			$user['password'] = $this->input->post('password');
			$user['email'] = $this->input->post('email');
			$this->user->save($user);

			redirect(base_url('/admin/user'));
		}else{
			$this->load->view('user_new');
		}
	}

	public function editAction($user_id)
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('username', 'username', 'required');
			$this->form_validation->set_rules('email', 'email');
			if ($this->input->post('password') != '' || $this->input->post('confirm_password') != '')
			{
				$this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]|sha1');
				$this->form_validation->set_rules('confirm_password', 'lang:confirm_password', 'required|matches[password]');
			}

			if ($this->form_validation->run())
			{
				$user['user_id'] = $this->input->post('user_id');
				$user['username'] = $this->input->post('username');
				$user['email'] = $this->input->post('email');
				if ($this->input->post('password') != '')
				{
					$user['password']	= $this->input->post('password');
				}

				$this->user->save($user);

				redirect(base_url('/admin/user'));
			}
		}

		$user = $this->user->get($user_id);
		//if the administrator does not exist, redirect them to the admin list with an error
		if (!$user)
		{
			$this->session->set_flashdata('message', lang('user_not_found'));
			redirect(base_url('/admin/user'));
		}
		$data['user_id'] = $user->user_id;
		$data['username'] = $user->username;
		$data['email'] = $user->email;
		$this->load->view('user_edit', $data);
	}
}
