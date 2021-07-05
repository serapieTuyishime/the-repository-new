<?php
	class Student_model extends CI_Model{
		public function create($enc_password){
            // students data array
            
            // make last access date based on number of years selected
            $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " + ".$this->input->post('access_years')." years"));

            $school_id= $this->session->userdata('user_id');

			$data = array(
				'name'=>$this->input->post('name'),
                'email'=>$this->input->post('email'),
                'school_id'=>$school_id,
                'expiring_date'=>$newEndingDate,
                'password'=>$enc_password
            );
            

			// Insert student
            $this->db->insert('students', $data);
            
            // generate the username from the last inserted id combined with the school id
            $last_id = $this->db->insert_id();
            $newUserName= $school_id .'-'.$last_id;


            // then update the student with the new username that will be used in loging in

            $data = array(
				'username' => $newUserName
			);

			$this->db->where('id', $last_id);
			return $this->db->update('students', $data);
            
		}

		// Log student in
		public function login($username, $password){
			// Validate
			$this->db->where('username', $username);
			$this->db->where('password', $password);

			$result = $this->db->get('students');

			if($result->num_rows() == 1){
				return $result->row(0)->id;
			} else {
				return false;
			}
        }

		// Check username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('students', array('username' => $username));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('students', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
        }
        //  get the last inserted id in the studens table
        public function getNextID()
        {
            echo $this->db->insert_id();
            die();
        }
        // get students particular to a school

        public function StudentsBySchool($id, $limit = FALSE, $offset = FALSE){
			if($limit){
				$this->db->limit($limit, $offset);
			}
			
            $query = $this->db->get_where('students', array('school_id' => $id));
			return $query->result_array();
		}
	}