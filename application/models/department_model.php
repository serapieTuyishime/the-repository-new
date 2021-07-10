<?php
	class department_model extends CI_Model{
		public function create(){

			$data = array(
				'name'=>$this->input->post('name'),
            );
			// Insert department
            return $this->db->insert('departments', $data);
        }

		// edit department info
		public function update($id){
			$data = array(
				'name'=>$this->input->post('name'),
            );
			// Update department
            $this->db->where('id', $id);
			return $this->db->update('departments', $data);
		}
		public function delete($id){
			$this->db->db->where('id', $id);
			return $this->db->delete('departments');
		}
        public function getdepartments($id= FALSE, $limit = FALSE, $offset = FALSE){
			if($limit){
				if (!$offset) {
					$offset =0;
				}
				$query = $this->db->query('SELECT *, (SELECT count(department) FROM resources where resources.department = departments.id) as resources from departments order by resources desc LIMIT '.$limit .' OFFSET '. $offset );
				return $query->result_array();
			}

			if ($id) {
				$query = $this->db->get_where('departments', array('id' => $id));
				return $query->row_array();
			}
			// $this->db->join('resources', 'resources.department');
			$query = $this->db->query('SELECT *, (SELECT count(department) FROM resources where resources.department = departments.id) as resources from departments ');
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
