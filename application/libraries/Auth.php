<?php

class Auth
{
	var $CI;

	public  function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('user');
	}

	function login($username, $password)
	{
		// make sure the username doesn't go into the query as false or 0
		if(!$username)
		{
			return false;
		}
		$result = $this->CI->user->get_by_username_password($username, $password);
		if (sizeof($result) > 0)
		{
			$admin = $result[0];

			$this->CI->session->set_userdata('admin', $admin);
			return true;
		}
		else
		{
			return false;
		}
	}

	function logout()
	{
		$this->CI->session->unset_userdata('admin');
	}

	function is_logged_in()
	{
		$admin = $this->CI->session->userdata('admin');

		if(!$admin)
			return false;
		else
			return true;
	}
}