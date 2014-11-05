<?php
 class WebApp extends CI_Model {

	 function __construct()
	 {
		 parent::__construct();
	 }

	 function get($id)
	 {
		 $query = $this->db->get_where('web_app', array('web_app_id'=>$id));
		 return $query->row();
	 }

	 function get_by_appname($appname)
	 {
		 $query = $this->db->get_where('web_app', array('appname'=>$appname));
		 return $query->row();
	 }

     function get_by_board_id($board_id)
     {
         $this->db->select('web_app.*');
         $this->db->from('web_app');
         $this->db->join('board_app', 'board_app.web_app_id = web_app.web_app_id');
         $this->db->where('board_app.board_id', $board_id);
         $result = $this->db->get()->result();

         return $result;
     }

	 function get_last_ten()
	 {
		 $query = $this->db->get('web_app', 10);
		 return $query->result();
	 }

	 function save($data)
	 {
		 if($data['web_app_id'])
		 {
			 $this->db->where('web_app_id', $data['web_app_id']);
			 $this->db->update('web_app', $data);
			 return $data['web_app_id'];
		 }
		 else
		 {
		    $this->db->insert('web_app', $data);
			 return $this->db->insert_id();
		 }
	 }
	 
	 function add_to_board($board_id, $web_app_id)
	 {
		 $result = $this->db->get_where('board_app', array('board_id'=>$board_id, 'web_app_id'=>$web_app_id))->row();
		 if(empty($result))
		 {
			$this->db->insert('board_app', array('board_id'=>$board_id, 'web_app_id'=>$web_app_id, 'created'=>time()));
		 }

         return true;
	 }

	 function get_board_ids($account_id, $app_id)
	 {
		 $this->db->select('board.board_id');
		 $this->db->from('board_app');
		 $this->db->join('board', 'board.board_id = board_app.board_id');
		 $this->db->where('board.account_id', $account_id);
		 $this->db->where('board_app.web_app_id', $app_id);
		 $result = $this->db->get()->result();

		 $arr = array();

		 foreach($result as $r){
			 $arr[] = $r->board_id;
		 }

		 return $arr;
	 }
 }