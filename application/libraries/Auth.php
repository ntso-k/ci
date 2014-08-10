<?php

class Auth
{
	var $CI;

	public  function __construct()
	{
		$this->CI =& get_instance();
	}

	function login_admin($username, $password)
	{
		$this->CI->load->model('user');
		
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

	function logout_admin()
	{
		$this->CI->session->unset_userdata('admin');
	}

	function is_admin_logged_in()
	{
		$admin = $this->CI->session->userdata('admin');

		if(!$admin)
			return false;
		else
			return true;
	}

	function login_account($username, $password)
	{
		$this->CI->load->model('account');
		
		// make sure the username doesn't go into the query as false or 0
		if(!$username)
		{
			return false;
		}
		$result = $this->CI->account->get_by_username_password($username, $password);
		if (sizeof($result) > 0)
		{
			$account = $result[0];

			$this->CI->session->set_userdata('account', $account);
			return true;
		}
		else
		{
			return false;
		}
	}

	function logout_account()
	{
		$this->CI->session->unset_userdata('account');
	}

	function is_account_logged_in()
	{
		$account = $this->CI->session->userdata('account');

		if(!$account)
			return false;
		else
			return true;
	}
	
	function get_account()
	{
		$account = $this->CI->session->userdata('account');
		return $account;
	}
}