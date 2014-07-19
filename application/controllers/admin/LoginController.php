<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginController extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form'));
	}

	public function indexAction()
	{
		if($this->auth->is_logged_in())
		{
			redirect(base_url('/admin'));
		}

		if($this->input->post())
		{
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$redirect	= $this->input->post('redirect');
			$login = $this->auth->login($username, $password);
			if($login)
			{
				if(empty($redirect))
				{
					$redirect = base_url('/admin');
				}
				redirect($redirect);
			}
			else
			{
				//this adds the redirect back to flash data if they provide an incorrect credentials
				$this->session->set_flashdata('redirect', $redirect);
				$this->session->set_flashdata('error', lang('error_authentication_failed'));
				redirect(base_url('/admin/login'));
			}
		}
		$this->load->view('login');
	}
}
