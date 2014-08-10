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
	 
	 function add_to_account($account_id, $app_id)
	 {
		 $result = $this->db->get_where('account_app', array('account_id'=>$account_id, 'app_id'=>$app_id))->row();
		 if(empty($result))
		 {
			$this->db->insert('account_app', array('account_id'=>$account_id, 'app_id'=>$app_id, 'add_date'=>time()));
		 }
	 }
 }