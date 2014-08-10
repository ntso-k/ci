<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PostController extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->helper(array('form', 'text'));
		$this->load->model('post');
	}

	public function indexAction()
	{
		$data['posts'] = $this->post->get_last_ten();
		$this->load->view('post_list', $data);
	}

	public function viewAction($post_id=0)
	{
		if($post_id)
		{
			$data['post'] = $this->post->get($post_id);
			$this->load->view('post_view', $data);
		}
	}

	public function editAction($post_id=null)
	{
		$data['post_id'] = '';
		$data['title'] = '';
		$data['content'] = '';
		$data['post_date'] = '';

		if($this->input->post())
		{
			$this->form_validation->set_rules('title', 'title', 'required');
			$this->form_validation->set_rules('content', 'content', 'required');

			if ($this->form_validation->run())
			{
				$post['post_id'] = $this->input->post('post_id');
				$post['title'] = $this->input->post('title');
				$post['content'] = $this->input->post('content');
				$post['text_content'] = $this->input->post('text_content');
				$post['post_date'] = time();

				$post_id = $this->post->save($post);
				$this->session->set_flashdata('message', 'Successfully saved!');
				redirect(base_url('admin/post/edit/'.$post_id));
			}
		}

		if($post_id)
		{
			$post = $this->post->get($post_id);
			$data['post_id'] = $post->post_id;
			$data['title'] = $post->title;
			$data['content'] = $post->content;
			$data['post_date'] = $post->post_date;
		}

		$this->load->view('post_edit', $data);
	}
}
