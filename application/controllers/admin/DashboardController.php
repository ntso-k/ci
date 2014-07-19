<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashboardController extends Admin_Controller {

	public function indexAction()
	{
		$this->load->view('dashboard');
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */