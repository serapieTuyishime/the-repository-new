<?php
	class search_model extends CI_Model{
		public function search($data){
			$this->db->like($data['column_name'], $data['word'], 'after');
			$this->db->select('id, '.$data['column_name']);
			$query= $this->db->get($data['table_name']);
			return $query->result_array();
		}
    }
?>
