<?php
 class User extends CI_Model {
	 public $id;
	 public $name;
	 public $password;
	 public $email;

	 function __construct()
	 {
		 parent::__construct();

		 $this->load->database();
	 }

	 function get_last_ten()
	 {
		 $query = $this->db->get('user', 10);
		 return $query->result();
	 }

	 function insert()
	 {
		 $this->db->insert('user', $this);
	 }
 }