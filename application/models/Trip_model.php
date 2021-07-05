<?php
	class Trip_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function create_trip()
		{

			// get the specification of the bus added

			$busInfo= $this->get_info_by_bus($this->input->post('bus'));
			$data = array
			(
				'bus' => $busInfo['number'],
				'route' => $busInfo['route_id'],
				'seats' => $busInfo['size'],
				'date' => $this->input->post('trip_date'),
				'time' => $this->input->post('trip_time')

			);

			return $this->db->insert('availability', $data);
		}
		public function edit_trip(){
			$data = array(
				'bus' => $busInfo['number'],
				'route' => $busInfo['route_id'],
				'seats' => $busInfo['size'],
				'date' => $this->input->post('trip_date'),
				'time' => $this->input->post('trip_time')
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('availability', $data);
		}
		public function get_businfo($id){
			$query = $this->db->get_where('availability', array('id' => $id));
			return $query->row_array();
		}
		public function get_info_by_bus($id){
			$query = $this->db->get_where('buses', array('id' => $id));
			return $query->row_array();
		}
		public function delete_trip($id){
			
			$this->db->where('id', $id);
			$this->db->delete('availability');
			return true;
		}

		public function get_availability_by_route($id){
			$query = $this->db->get_where('availability', array('route' => $id));
			return $query->result_array();
		}
		public function get_trips(){
			$query = $this->db->get_where('availability', array('status' => 'available'));
			return $query->result_array();
		}

	}