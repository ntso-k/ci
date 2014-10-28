<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WebAppController extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->helper(array('form', 'text'));
		$this->load->model('WebApp');
	}

	public function indexAction()
	{
		$data['webApps'] = $this->WebApp->get_last_ten();
		$this->load->view('web_app_list', $data);
	}

	public function viewAction($id=0)
	{
		if($id)
		{
			$data['webApp'] = $this->WebApp->get($id);
			$this->load->view('web_app_view', $data);
		}
	}

	public function editAction($id=null)
	{
		$data['web_app_id'] = '';
		$data['title'] = '';
		$data['url'] = '';
		$data['appname'] = '';
		$data['remarks'] = '';
		$data['description'] = '';
		$data['icon_uri'] = '';

		if($this->input->post())
		{
			$this->form_validation->set_rules('title', 'title', 'required');
			$this->form_validation->set_rules('url', 'url', 'required');
			if(!isset($id))
			{
				$this->form_validation->set_rules('appname', 'appname', 'is_unique[web_app.appname]');
			}
			else
			{
				$this->form_validation->set_rules('appname', 'appname');
			}
			$this->form_validation->set_rules('remarks', 'remarks');
			$this->form_validation->set_rules('description', 'description');

			if ($this->form_validation->run())
			{
				$webApp['web_app_id'] = $this->input->post('web_app_id');
				$webApp['title'] = $this->input->post('title');
				$webApp['url'] = prep_url($this->input->post('url'));
				$webApp['appname'] = $this->input->post('appname');
				$webApp['remarks'] = $this->input->post('remarks');
				$webApp['description'] = $this->input->post('description');
				$webApp['icon_uri'] = $this->input->post('icon_uri');
                $webApp['icon_uri'] = empty($webApp['icon_uri']) ? $webApp['url'] . '/favicon.ico' : $webApp['icon_uri'];
				$webApp['create_date'] = time();

				$id = $this->WebApp->save($webApp);
				$this->session->set_flashdata('message', 'Successfully saved!');
				redirect(base_url('admin/webapp/edit/'.$id));
			}
		}

		if($id)
		{
			$webApp = $this->WebApp->get($id);
			$data['web_app_id'] = $webApp->web_app_id;
			$data['title'] = $webApp->title;
			$data['url'] = $webApp->url;
			$data['appname'] = $webApp->appname;
			$data['remarks'] = $webApp->remarks;
			$data['description'] = $webApp->description;
			$data['icon_uri'] = $webApp->icon_uri;
			$data['create_date'] = $webApp->create_date;
		}

		$this->load->view('web_app_edit', $data);
	}
}
