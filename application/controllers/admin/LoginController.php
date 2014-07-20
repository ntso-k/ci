<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginController extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper(array('form'));
	}

	public function indexAction()
	{
		$redirect = $this->input->get_post('redirect', TRUE);
		if(empty($redirect))
		{
			$redirect = '/admin';
		}
		if($this->auth->is_logged_in())
		{
			redirect(base_url($redirect));
		}

		if($this->input->post())
		{
			$this->form_validation->set_rules('username', 'lang:username', 'required');
			$this->form_validation->set_rules('password', 'lang:password', 'required|sha1');

			if($this->form_validation->run())
			{
				$username	= $this->input->post('username');
				$password	= $this->input->post('password');
				$login = $this->auth->login($username, $password);
				if($login)
				{
					redirect(base_url($redirect));
				}
				else
				{
					//this adds the redirect back to flash data if they provide an incorrect credentials
					$this->session->set_flashdata('redirect', $redirect);
					$this->session->set_flashdata('error', lang('error_authentication_failed'));
				}
			}
		}
		$this->load->view('login');
	}
}
