<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_Controller extends Admin_Controller {

	public function index()
	{
		$this->load->view('dashboard');
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */