<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BoardController extends Front_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->helper(array('form', 'text'));
		$this->load->model(array('Board', 'WebApp'));
	}

	public function viewAction($key=null)
	{
		if(is_numeric($key))
		{
			$board = $this->Board->get($key);
		}
		else
		{
			$board = $this->Board->get_by_appname($this->auth->get_account()->account_id, $key);
		}

		if(!empty($board))
		{
			$board->apps = $this->WebApp->get_by_board_id($board->board_id);
			$this->load->view('board/view', array('board'=>$board));
			return;
		}

		show_404();
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
        if(!($this->auth->is_account_logged_in()))
        {
            echo '<script>location.href ="'. base_url('/login') . '?redirect=/webapp"; </script>';
            die();
        }
        $boards = $this->Board->get_by_account_id($this->auth->get_account()->account_id);
		$board_ids = $this->WebApp->get_board_ids($this->auth->get_account()->account_id, $web_app_id);

        $data['web_app_id'] = $web_app_id;
        $data['boards'] = $boards;
		$data['board_ids'] = $board_ids;

        $this->load->view('board/context_list', $data);
    }

	public function _remap($method, $params = array())
	{
		if (method_exists($this, $method))
		{
			return call_user_func_array(array($this, $method), $params);
		}

		array_unshift($params, str_replace('Action', '', $method));
		return call_user_func_array(array($this, 'viewAction'), $params);
	}
}
