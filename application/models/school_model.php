<?php
	class School_model extends CI_Model{
		public function create($enc_password){
			// school data array
			$data = array(
				'name'=>$this->input->post('name'),
					'email'=>$this->input->post('email'),
					'telephone'=>$this->input->post('telephone'),
					'description'=>$this->input->post('description'),
					'bank_acc'=>$this->input->post('bank_acc'),
					'username'=>$this->input->post('username'),
					'password'=>$enc_password
			);

			// Insert user
			return $this->db->insert('school', $data);
		}

		// Log user in
		public function login($username, $password){
			// Validate
			$this->db->where('username', $username);
			$this->db->where('password', $password);

			$result = $this->db->get('school');

			if($result->num_rows() == 1){
				return $result->row(0)->id;
			} else {
				return false;
			}
		}

		// Check username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('school', array('username' => $username));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('school', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}
	}