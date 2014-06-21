<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function index()
	{
		$this->load->view('dashboard');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/admin/dashboard.php */