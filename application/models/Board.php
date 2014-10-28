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
 }