<?php
	class Notification_model extends CI_Model{
		public function register(){
			// User data array
			$data = array(
				'name' => $this->input->post('name'),
			);

			// Insert user
			return $this->db->insert('users', $data);
		}

		public function get_unread()
		{
			$this->db->where('status', 'unread');
			$this->db->order_by('timeStamp', 'DESC');
			$query = $this->db->get('notification');
			return $query->result_array();
		}

	}