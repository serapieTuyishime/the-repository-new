<?php
	class Route_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function create_route(){

			// combine the destination and depart to make a name
			$slug_in= $this->input->post('depart').' '.$this->input->post('destination');
			$slug = url_title($slug_in);

			$data = array(
				'name' => $slug,
				'depart' => $this->input->post('depart'),
				'destination' => $this->input->post('destination'),
				'amount' => $this->input->post('price'),
				'time' => $this->input->post('time'),
			);

			// conduct the actual insert query
			return $this->db->insert('routes', $data);
		}

		public function edit_route(){
			$slug_in= $this->input->post('depart').' '.$this->input->post('destination');
			$slug = url_title($slug_in);
			$data = array(
				'name' => $slug,
				'depart' => $this->input->post('depart'),
				'destination' => $this->input->post('destination'),
				'amount' => $this->input->post('price'),
				'time' => $this->input->post('time'),
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('routes', $data);
		}

		public function get_routes(){
			$this->db->order_by('amount', 'DESC');
			$query = $this->db->get('routes');
			return $query->result_array();
		}

		public function get_routeinfo($id){
			$query = $this->db->get_where('routes', array('id' => $id));
			return $query->row_array();
		}
		public function delete_route($id){
			
			$this->db->where('id', $id);
			$this->db->delete('routes');
			return true;
		}

		public function get_posts_by_category($category_id){
			$this->db->order_by('posts.id', 'DESC');
			$this->db->join('categories', 'categories.id = posts.category_id');
				$query = $this->db->get_where('posts', array('category_id' => $category_id));
			return $query->result_array();
		}
	}