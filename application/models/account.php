<?php
 class Account extends CI_Model {

	 function __construct()
	 {
		 parent::__construct();
	 }

	 function get($id)
	 {
		 $query = $this->db->get_where('account', array('account_id'=>$id));
		 return $query->row();
	 }

	 function get_last_ten()
	 {
		 $query = $this->db->get('account', 10);
		 return $query->result();
	 }

	 function save($account)
	 {
		 if(isset($account['account_id']))
		 {
			$this->db->where('account_id', $account['user_id']);
			$result = $this->db->update('account', $account);
		 }
		 else
		 {
		    $result = $this->db->insert('account', $account);
		 }
		 return $result;
	 }

	 function get_by_username_password($username, $password)
	 {
		 $this->db->select('*');
		 $this->db->where('username', $username);
		 $this->db->where('password', $password);
		 $this->db->limit(1);
		 $result = $this->db->get('account')->result();
		 return $result;
	 }
	 
	 function get_boards($account_id)
	 {
         $query = $this->db->get_where('board', array('account_id' => $account_id));
		 $result = $query->result();
		 
		 return $result;
	 }

	 function get_all_web_app_ids($account_id)
	 {
		 $this->db->select('board_app.web_app_id');
		 $this->db->from('board_app');
		 $this->db->join('board', 'board.board_id = board_app.board_id');
		 $this->db->where('board.account_id', $account_id);
		 $result = $this->db->get()->result();

		 $arr = array();

		 foreach($result as $r){
			 $arr[] = $r->web_app_id;
		 }

		 return $arr;
	 }
 }