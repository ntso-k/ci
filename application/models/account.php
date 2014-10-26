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
	 
	 function add_app($account_id, $app_id)
	 {
		$this->db->insert('account_app', array('account_id'=>$account_id, 'app_id'=>$app_id, 'add_date'=>time()));
	 }
	 
	 function get_apps($account_id)
	 {
		 $this->db->select('web_app.*');
		 $this->db->from('web_app');
		 $this->db->join('account_app', 'account_app.app_id = web_app.web_app_id');
		 $this->db->where('account_app.account_id', $account_id);
		 $result = $this->db->get()->result();
		 
		 return $result;
	 }
 }