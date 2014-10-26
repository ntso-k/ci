<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginController extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form', 'captcha'));
	}

	public function indexAction()
	{
		$data = array();
		$redirect = $this->input->get_post('redirect', TRUE);
		if(empty($redirect))
		{
			$redirect = '/admin';
		}
		if($this->auth->is_admin_logged_in())
		{
			redirect(base_url($redirect));
		}

		if($this->input->post())
		{
			$this->session->set_userdata('admin_login_try_times', (int)$this->session->userdata('admin_login_try_times') + 1);

			if ($this->input->post('captcha') != '')
			{
				$this->form_validation->set_rules('captcha', 'lang:captcha', 'callback_captcha_check');
			}
			$this->form_validation->set_rules('username', 'lang:username', 'required');
			$this->form_validation->set_rules('password', 'lang:password', 'required');

			if($this->form_validation->run())
			{
				$username	= $this->input->post('username');
				$password	= sha1($this->input->post('password'));
				$login = $this->auth->login_admin($username, $password);
				if($login)
				{
					$this->session->unset_userdata('admin_login_try_times');
					redirect(base_url($redirect));
				}
				else
				{
					//this adds the redirect back to flash data if they provide an incorrect credentials
					$this->session->set_flashdata('redirect', $redirect);
					$this->session->set_flashdata('error', 'error_authentication_failed');
					redirect(base_url('/admin/login'));
				}
			}
		}

		$try_times = $this->session->userdata('admin_login_try_times');
		if(isset($try_times) && $try_times > 0)
		{
			$cap = create_captcha(array(
				//'word'	=> 'Random word',
				'img_path'	=> './assets/captcha/',
				'img_url'	=> base_url('assets/captcha').'/',
				//'font_path'	=> './path/to/fonts/texb.ttf',
				//'img_width'	=> 100,
				//'img_height' => 30,
				'expiration' => 600
			));
			$this->session->set_userdata('admin_login_captcha', $cap);
			$data['cap'] = $cap;
		}
		$this->load->view('login', $data);
	}

	public function captcha_check($value)
	{
		$cap = $this->session->userdata('admin_login_captcha');
		if(time()-$cap['time']<7200 && $value==$cap['word'])
		{
			return true;
		}
		$this->form_validation->set_message('captcha_check', 'The %s is not validate.');
		return false;
	}
}
