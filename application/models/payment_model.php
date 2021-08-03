<?php

    /**
     *
     */
    class Payment_model extends CI_Model
    {

        public function check_balance($client_id, $client_type= 'client'){
            $query= $this->db->get_where('balances', array('client_id'=>$client_id, 'client_type'=>$client_type));
            return $query->row_array();
        }
        public function create_transaction($data){
            return $this->db->insert('transactions', $data);
        }
        public function update_client_price($balance, $client_id, $client_type){
            $data= array('balance'=>$balance);
            $this->db->where('client_id', $client_id);
            $this->db->where('client_type', $client_type);
            return $this->db->update('balances', $data);
        }

        public function createAccount($data){
            return $this->db->insert('balances', $data);
        }
        public function get_money_made($status){
            $this->db->select_sum('amount');
            $this->db->where('status', $status);
            $query= $this->db->get('transactions');
            return $query->row_array();
        }
    }

 ?>
