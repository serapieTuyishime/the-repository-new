<?php
	class department_model extends CI_Model{
		public function create(){

			$data = array(
				'name'=>$this->input->post('name'),
            );
			// Insert department
            return $this->db->insert('departments', $data); 
        }
        public function getdepartments( $limit = FALSE, $offset = FALSE){
			if($limit){
				$this->db->limit($limit, $offset);
			}
			$query = $this->db->get('departments');
			return $query->result_array();
		}

		// Check name exists
		public function check_name_exists($name){
			$query = $this->db->get_where('departments', array('name' => $name));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
        }
	}