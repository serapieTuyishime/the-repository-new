<?php
	class Bus_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function create_bus()
		{
			$data = array
			(
				'number' => $this->input->post('plate'),
				'route_id' => $this->input->post('route'),
				'size' => $this->input->post('size')

			);

			return $this->db->insert('buses', $data);
		}
		public function edit_bus(){
			$data = array(
				'number' => $this->input->post('plate'),
				'route_id' => $this->input->post('route'),
				'size' => $this->input->post('size')
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('buses', $data);
		}
		public function get_businfo($id){
			$query = $this->db->get_where('buses', array('id' => $id));
			return $query->row_array();
		}
		public function delete_bus($id){
			
			$this->db->where('id', $id);
			$this->db->delete('buses');
			return true;
		}

		public function get_buses()
		{

			$this->db->order_by('buses.id', 'DESC');
			$this->db->join('routes', 'routes.id = buses.route_id');
			$query = $this->db->get('buses');
			return $query->result_array();
		}


		public function get_buses_by_route($id){
			$query = $this->db->get_where('buses', array('route_id' => $id));
			return $query->result_array();
		}
	}