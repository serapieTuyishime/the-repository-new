<?php
	class Package_model extends CI_Model{
		public function create(){
			$data = array(
				'name'=>$this->input->post('name'),
				'price'=>$this->input->post('price'),
				'description'=>$this->input->post('description'),
            );
			// Insert package
            $this->db->insert('packages', $data);

			// get the id of the current inserted package
			$package_id= $this->db->insert_id();

			// a loop to insert package details in the package_details table

			$departments= $this->input->post('departments[]'); #selected departments
			foreach ($departments as $key => $value) {
				$details= array(
					'package_id'=>$package_id,
					'department_id' => $value,
				);

				// insert one line
				$this->db->insert('package_detail', $details);
			}

			return ;
        }
		public function get_packages(){
			$query = $this->db->query('SELECT *, (SELECT count(package_id) from package_detail where packages.id = package_detail.package_id) as details from packages');
			return $query->result_array();
		}

		// Check name exists
		public function check_name_exists($name){
			$query = $this->db->get_where('packages', array('name' => $name));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
        }
	}
