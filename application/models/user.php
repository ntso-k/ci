<?php
 class User extends CI_Model {
	 public $id;
	 public $username;
	 public $password;
	 public $email;

	 function __construct()
	 {
		 parent::__construct();

		 $this->load->database();
	 }

	 function get($id)
	 {
		 $query = $this->db->get_where('user', array('id'=>$id));
		 return $query->row();
	 }

	 function get_last_ten()
	 {
		 $query = $this->db->get('user', 10);
		 return $query->result();
	 }

	 function save($user)
	 {
		 if($user['id'])
		 {
			 $this->db->where('id', $user['id']);
			 $this->db->update('user', $user);
		 }
		 else
		 {
		    $this->db->insert('user', $user);
		 }
	 }

	 function get_by_username_password($username, $password)
	 {
		 $this->db->select('*');
		 $this->db->where('username', $username);
		 $this->db->where('password', $password);
		 $this->db->limit(1);
		 $result = $this->db->get('user')->result();
		 return $result;
	 }
 }