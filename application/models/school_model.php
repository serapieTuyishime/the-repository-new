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

		public function get_schools($id = FALSE, $limit = FALSE, $offset = FALSE){
			if($limit){
				if (!$offset) {
					$offset =0 ;
				}
				$query = $this->db->query('SELECT *, (SELECT count(school_id) from students where students.school_id = school.id) as students FROM school LIMIT '. $limit . ' OFFSET ' . $offset);
				return $query->result_array();
			}
			if($id === FALSE){
				$this->db->order_by('id', 'DESC');
				$query = $this->db->query('SELECT *, (SELECT count(school_id) from students where students.school_id = school.id) as students FROM school ');
				return $query->result_array();
			}

			$query = $this->db->get_where('resources', array('id' => $id));
			return $query->row_array();
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
		// change Password
		public function update_passsword($enc_password){
			$data = array(
				'password' => $enc_password
			);

			$this->db->where('id', $this->session->userdata('user_id'));
			return $this->db->update('school', $data);
		}

		// check if the school have an active substription
		public function subscribed($id){

			$conditions= array('school_id' => $id, 'date_start >' => date('Y-m-d'), 'date_end < ' => date('Y-m-d'), 'active'=> TRUE);
			$this->db->where($conditions);
			$query= $this->db->get('subscription');

			if(empty($query->row_array())){  #if nothing returned then there is no subscription
				return false;
			} else {
				return $query->row_array();
			}
		}
	}
