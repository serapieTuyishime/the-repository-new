<?php
	class Resources_model extends CI_Model{
        public function get_resources($id = FALSE, $limit = FALSE, $offset = FALSE){
			if($limit){
				if (!$offset) {
					$offset =0 ;
				}
				$query = $this->db->query('SELECT *, (SELECT count(resource_id) from downloads where downloads.resource_id = resources.id) as downloads, (SELECT count(resource_id) from save_for_later where save_for_later.resource_id = resources.id) as saves, (SELECT name from researchers where researchers.id = resources.researcher_id) as author FROM resources order by downloads desc LIMIT '. $limit . ' OFFSET ' . $offset);
				return $query->result_array();
			}
			if($id === FALSE){
				$this->db->order_by('id', 'DESC');
				$query = $this->db->query('SELECT *, (SELECT count(resource_id) from downloads where downloads.resource_id = resources.id) as downloads, (SELECT count(resource_id) from save_for_later where save_for_later.resource_id = resources.id) as saves, (SELECT name from researchers where researchers.id = resources.researcher_id) as author FROM resources order by downloads desc');
				return $query->result_array();
			}

			$query = $this->db->get_where('resources', array('id' => $id));
			return $query->row_array();
		}
        public function register($file_name){
            $title_slug = url_title($this->input->post('name'));
            $data = array(
				'title_slug' => $title_slug,
                // 'researcher_id'=> $this->session->userdata('user_id'),
                'researcher_id'=> 1,
                'department' => $this->input->post('department'),
				'title' => $this->input->post('name'),
				'price' => $this->input->post('price'),
                'file' => $file_name,
        			);

			// Insert user
			return $this->db->insert('resources', $data);
        }

		// update the price , department of the resource
		public function update($id){
			$data= array(
				'price' => $this->input->post('price'),
				'department'=> $this->input->post('department')
			);
			$this->db->where('id', $id);
			return $this->db->update('resources', $data);
		}
        public function check_name_exists($title){

            $title_slug = url_title($title);  # ex : the-repository-project
            $query = $this->db->get_where('resources', array('title_slug' => $title_slug));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
        }

		// save new download
		public function saveDownload($data){
			return $this->db->insert('downloads', $data);
		}
		public function save_for_later($id){
			$data= array(
				'resource_id' => $id,
				'username' => $this->session->userdata('username')
			);
			return $this->db->insert('save_for_later', $data);
		}

		// get number of saves per a resource
		public function getSaves($id){
			$query = $this->db->get_where('save_for_later', array('resource_id' => $id));
			return $query->num_rows();
		}

		// get number of downloads
		public function countDownloads($id){
			$query = $this->db->get_where('downloads', array('resource_id' => $id));
			return $query->num_rows();
		}

		// get downloads per Students the CI way
		public function downloads_per_students_old($school_id){
			$this->db->select('resource_id');
			$this->db->group_by('student_id');
			$this->db->like('student_id', $school_id.'-' ,'after');
			$query = $this->db->get('downloads');
			return $query->result_array();
		}

		public function downloads_per_students($school_id, $limit = FALSE){
			if ($limit) {
				$query = $this->db->query("SELECT `resource_id`, count(student_id) as downloads, student_id FROM `downloads` WHERE `student_id` LIKE '".$school_id."-%' ESCAPE '!' GROUP BY `student_id` ORDER BY `downloads` DESC LIMIT ". $limit);
			}
			else {
				$query = $this->db->query("SELECT `resource_id`, count(student_id) as downloads, student_id FROM `downloads` WHERE `student_id` LIKE '".$school_id."-%' ESCAPE '!' GROUP BY `student_id` ORDER BY `downloads` DESC");
			}
			return $query->result_array();
		}

		public function resources_by_researcher($id, $limit = FALSE, $offset = FALSE){
			if($limit){
				if (!$offset) {
					$offset =0 ;
				}
				$query = $this->db->query('SELECT *, (SELECT count(resource_id) from downloads where downloads.resource_id = resources.id) as downloads, (SELECT count(resource_id) from save_for_later where save_for_later.resource_id = resources.id) as saves, (SELECT name from researchers where researchers.id = resources.researcher_id) as author FROM resources where researcher_id ="'.$id.'" order by downloads desc LIMIT '. $limit . ' OFFSET ' . $offset);
				return $query->result_array();
			}
			else {
				$this->db->order_by('id', 'DESC');
				$query = $this->db->query('SELECT *, (SELECT count(resource_id) from downloads where downloads.resource_id = resources.id) as downloads, (SELECT count(resource_id) from save_for_later where save_for_later.resource_id = resources.id) as saves, (SELECT name from researchers where researchers.id = resources.researcher_id) as author FROM resources where researcher_id ="'.$id.'" order by downloads desc');
				return $query->result_array();
			}

			$query = $this->db->get_where('resources', array('id' => $id));
			return $query->row_array();
		}

		// resources in a departments
		public function resources_by_department($id, $limit = FALSE, $offset = FALSE){
			if($limit){
				if (!$offset) {
					$offset = 0 ;
				}
				$query = $this->db->query('SELECT *, (SELECT count(resource_id) from downloads where downloads.resource_id = resources.id) as downloads, (SELECT count(resource_id) from save_for_later where save_for_later.resource_id = resources.id) as saves, (SELECT name from researchers where researchers.id = resources.researcher_id) as author FROM resources where department ="'.$id.'" order by downloads desc LIMIT '. $limit . ' OFFSET ' . $offset);
				return $query->result_array();
			}
			else {
				$this->db->order_by('id', 'DESC');
				$query = $this->db->query('SELECT *, (SELECT count(resource_id) from downloads where downloads.resource_id = resources.id) as downloads, (SELECT count(resource_id) from save_for_later where save_for_later.resource_id = resources.id) as saves, (SELECT name from researchers where researchers.id = resources.researcher_id) as author FROM resources where department ="'.$id.'" order by downloads desc');
				return $query->result_array();
			}

		}

    }

?>
