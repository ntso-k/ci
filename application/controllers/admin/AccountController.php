<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountController extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->load->model('account');
		$this->load->library('form_validation');
	}

	public function indexAction()
	{
		$data['accounts'] = $this->account->get_last_ten();
		$this->load->view('account_list', $data);
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
				$this->load->view('account_new');
				return;
			}

			$account['username'] = $this->input->post('username');
			$account['password'] = $this->input->post('password');
			$account['email'] = $this->input->post('email');
			$this->account->save($account);

			redirect(base_url('/admin/account'));
		}else{
			$this->load->view('account_new');
		}
	}

	public function editAction($account_id)
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
				$account['account_id'] = $this->input->post('account_id');
				$account['username'] = $this->input->post('username');
				$account['email'] = $this->input->post('email');
				if ($this->input->post('password') != '')
				{
					$account['password']	= $this->input->post('password');
				}

				$this->account->save($account);

				redirect(base_url('/admin/account'));
			}
		}

		$account = $this->account->get($account_id);
		//if the administrator does not exist, redirect them to the admin list with an error
		if (!$account)
		{
			$this->session->set_flashdata('message', lang('account_not_found'));
			redirect(base_url('/admin/account'));
		}
		$data['account_id'] = $account->account_id;
		$data['username'] = $account->username;
		$data['email'] = $account->email;
		$this->load->view('account_edit', $data);
	}
}
