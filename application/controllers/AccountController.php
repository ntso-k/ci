<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountController extends Front_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('account');
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
	}

	public function signupAction()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('username', 'lang:username', 'required|is_unique[account.username]');
			$this->form_validation->set_rules('email', 'lang:email', 'required|is_unique[account.email]');
			$this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]|sha1');
			if ($this->form_validation->run())
			{
				$account['username'] = $this->input->post('username');
				$account['password'] = $this->input->post('password');
				$account['email'] = $this->input->post('email');
				$result = $this->account->save($account);
				
				if($result)
				{
					$this->session->set_flashdata('message', 'Sign up successful!');
					redirect(base_url('/login'));
				}
				else
				{
					$this->session->set_flashdata('message', lang('Something error.'));
				}
			}
		}
		
		$this->load->view('signup');
	}
}
