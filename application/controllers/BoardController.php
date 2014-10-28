<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BoardController extends Front_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->helper(array('form', 'text'));
		$this->load->model('Board');
	}

    public function newAction()
    {
        $data['board_id'] = '';
        $data['title'] = '';

        if($this->input->post())
        {
            $this->form_validation->set_rules('title', 'title', 'required');

            if ($this->form_validation->run())
            {
                $account = $this->auth->get_account();
                $board['title'] = $this->input->post('title');
                $board['account_id'] = $account->account_id;

                $id = $this->Board->save($board);
                $this->session->set_flashdata('message', 'Successfully saved!');
                redirect(base_url('board/edit/'.$id));
            }
        }

        $this->load->view('board/edit', $data);
    }

	public function editAction($id=null)
	{
		$data['board_id'] = '';
		$data['title'] = '';

		if($this->input->post())
		{
			$this->form_validation->set_rules('title', 'title', 'required');
			if ($this->form_validation->run())
			{
                $board['board_id'] = $this->input->post('board_id');
                $board['title'] = $this->input->post('title');

				$id = $this->Board->save($board);
				$this->session->set_flashdata('message', 'Successfully saved!');
				redirect(base_url('board/edit/'.$id));
			}
		}

		if($id)
		{
			$board = $this->Board->get($id);
			$data['board_id'] = $board->board_id;
			$data['title'] = $board->title;
			$data['created'] = $board->created;
		}

		$this->load->view('board/edit', $data);
	}

    public function contextListAction($web_app_id)
    {
        $boards = $this->Board->get_by_account_id($this->auth->get_account()->account_id);

        $data['web_app_id'] = $web_app_id;
        $data['boards'] = $boards;

        $this->load->view('board/context_list', $data);
    }
}
