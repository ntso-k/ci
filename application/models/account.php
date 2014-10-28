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
 }