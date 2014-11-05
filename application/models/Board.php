<?php
 class Board extends CI_Model {

	 function __construct()
	 {
		 parent::__construct();
	 }

	 function get($id)
	 {
		 $query = $this->db->get_where('board', array('board_id'=>$id));
		 return $query->row();
	 }

	 function get_by_name($account_id, $title)
	 {
		 $query = $this->db->get_where('board', array('account_id'=>$account_id, 'title'=>$title));
		 return $query->result();
	 }

     function get_by_account_id($account_id)
     {
         $query = $this->db->get_where('board', array('account_id'=>$account_id));
         return $query->result();
     }

	 function save($data)
	 {
		 if($data['board_id'])
		 {
			 $this->db->where('board_id', $data['board_id']);
			 $this->db->update('board', $data);
			 return $data['board_id'];
		 }
		 else
		 {
		    $this->db->insert('board', $data);
			 return $this->db->insert_id();
		 }
	 }

	 function get_all_web_app_ids($board_id)
	 {
		 $this->db->select('web_app_id');
		 $this->db->from('board_app');
		 $this->db->where('board_id', $board_id);
		 $result = $this->db->get()->result();

		 $arr = array();

		 foreach($result as $r){
			 $arr[] = $r->web_app_id;
		 }

		 return $arr;
	 }
 }