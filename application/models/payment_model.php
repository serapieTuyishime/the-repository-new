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
        public function update_client_price($balance, $client_id){
            $data= array('balance'=>$balance);
            $this->db->where('client_id', $client_id);
            return $this->db->update('balances', $data);
        }

        public function createAccount($data){
            return $this->db->insert('balances', $data);
        }
    }

 ?>
