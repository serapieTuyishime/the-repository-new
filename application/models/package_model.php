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
		public function delete_details($package_id){
			$this->db->where('package_id',$package_id);
			return $this->db->delete('package_detail');
		}

		public function update($id){
			$data = array(
				'name'=>$this->input->post('name'),
				'price'=>$this->input->post('price'),
				'description'=>trim($this->input->post('description')),
            );
			// update package
            $this->db->where('id' , $id);
			$this->db->update('packages', $data);

			// register details once again
			$departments= $this->input->post('departments[]'); #selected departments
			foreach ($departments as $key => $value) {
				$details= array(
					'package_id'=>$id,
					'department_id' => $value,
				);
				// insert one line
				$this->db->insert('package_detail', $details);
			}
			return ;
        }

		public function delete($id){
			$this->db->where('id', $id);
			return $this->db->delete('packages');
		}
		public function get_packages($limit = FALSE, $offset= FALSE){
			if($limit){
				$query = $this->db->query('SELECT *, (SELECT count(package_id) from package_detail where packages.id = package_detail.package_id) as details from packages limit '. $limit);
				return $query->result_array();
			}
			$query = $this->db->query('SELECT *, (SELECT count(package_id) from package_detail where packages.id = package_detail.package_id) as details from packages');
			return $query->result_array();
		}

		// get package by id
		public function get_package($id){
			$query = $this->db->get_where('packages', array('id' => $id ));
			return $query->row_array();
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

		// subscribe to a package
		public function subscribe($package_id){
			// get school id
	        $school_id = $this->session->userdata('user_id');

			// generate end date based on months selected by the subscriber
			$newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " + ". $this->input->post('months')." months"));
			$data = array(
				'school_id'=> $school_id,
				'package_id'=>$package_id,
				'date_start' => date('Y-m-d'),
				'date_end' => $newEndingDate
            );
			// Insert package
            $this->db->insert('subscription', $data);
		}

		// select package details for a packages
		public function get_details($id){
			$query= $this->db->query('SELECT *, (SELECT name from departments where departments.id = package_detail.department_id limit 1) as department_name from package_detail where package_id =' .$id);
			return $query->result_array();
		}
	}
