<?php
	class Researcher_model extends CI_Model{
		public function register($enc_password, $image_name){
			// Client data array
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $enc_password,
		        'photo' => $image_name,
		        'description'=> $this->input->post('description'),
		        'bank_acc'=> $this->input->post('bank_acc'),
			);

			// Insert user
			return $this->db->insert('researchers', $data);
		}

		// Log user in
		public function login($username, $password){
			// Validate
			$this->db->where('username', $username);
			$this->db->where('password', $password);

			$result = $this->db->get('researchers');

			if($result->num_rows() == 1){
				return $result->row(0)->id;
			} else {
				return false;
			}
		}

		// Check username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('researchers', array('username' => $username));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('researchers', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		// change Password
		public function update_passsword($enc_password){
			$data = array(
				'password' => $enc_password
			);

			$this->db->where('id', $this->session->userdata('user_id'));
			return $this->db->update('researchers', $data);
		}

		// get all researchs by one author
		public function get_resources_by_author($id, $limit = FALSE, $offset = FALSE){
			if($limit){
				$this->db->limit($limit, $offset);
			}
			$query = $this->db->get_where('resources', array('researcher_id', $id));
			return $query->result_array();

		}

		// select all researchers
		public function get_researchers($id= FALSE, $limit = FALSE, $offset = FALSE){
			if($limit){
				if (!$offset) {
					$offset =0;
				}
				$query = $this->db->query('SELECT *, (SELECT count(researcher_id) FROM resources where resources.researcher_id = researchers.id) as resources from researchers order by resources desc LIMIT '.$limit .' OFFSET '. $offset );
				return $query->result_array();
			}

			if ($id) {
				$query = $this->db->query('SELECT *, (SELECT count(researcher_id) FROM resources where resources.researcher_id = researchers.id) as resources from researchers where id ="'.$id.'"');
				return $query->row_array();
			}
			// $this->db->join('resources', 'resources.researcher_id');
			$query = $this->db->query('SELECT *, (SELECT count(researcher_id) FROM resources where resources.researcher_id = researchers.id) as resources from researchers order by resources desc');
			return $query->result_array();
		}
		// get researcher info
		public function get_researcher($id)
		{
			$query = $this->db->get_where('researchers', array('id' => $id));
			return $query->row_array();
		}

		// get researcher info by email
		public function get_researcher_by_email($email)
		{
			$query = $this->db->get_where('researchers', array('email' => $email));
			if ( empty($query->row_array()))
			{
				return false;
			}
			else {
				return $query->row_array();
			}
		}
	}
