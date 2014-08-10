<?php
 class Post extends CI_Model {

	 function __construct()
	 {
		 parent::__construct();
	 }

	 function get($id)
	 {
		 $query = $this->db->get_where('post', array('post_id'=>$id));
		 return $query->row();
	 }

	 function get_last_ten()
	 {
		 $query = $this->db->get('post', 10);
		 return $query->result();
	 }

	 function save($post)
	 {
		 if($post['post_id'])
		 {
			 $this->db->where('post_id', $post['post_id']);
			 $this->db->update('post', $post);
			 return $post['post_id'];
		 }
		 else
		 {
		    $this->db->insert('post', $post);
			 return $this->db->insert_id();
		 }
	 }
 }