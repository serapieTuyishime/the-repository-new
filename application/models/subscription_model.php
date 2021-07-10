<?php
	class Subscription_model extends CI_Model{
		public function get_subscriptions($id = FALSE, $limit = FALSE, $offset = FALSE){
			if($limit){
				if (!$offset) {
					$offset =0 ;
				}
				$query = $this->db->query('SELECT *, (SELECT name from school where school.id = subscription.school_id) as school, (SELECT name from packages where packages.id = subscription.package_id) as package FROM subscription LIMIT '. $limit . ' OFFSET ' . $offset);
				return $query->result_array();
			}
			if($id === FALSE){
				$this->db->order_by('id', 'DESC');
				$query = $this->db->query('SELECT *, (SELECT name from school where school.id = subscription.school_id) as school, (SELECT name from packages where packages.id = subscription.package_id) as package FROM subscription');
				return $query->result_array();
			}

			$query = $this->db->get_where('subscription', array('id' => $id));
			return $query->row_array();
		}

	}
