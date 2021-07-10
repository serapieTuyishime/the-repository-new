<?php
	class Admin_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}
        public function login($username, $password){
			// Validate
			$this->db->where('username', $username);
			$this->db->where('password', $password);

			$result = $this->db->get('admin');

			if($result->num_rows() == 1){
				return $result->row(0)->id;
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
			return $this->db->update('admin', $data);
		}
    }
?>
