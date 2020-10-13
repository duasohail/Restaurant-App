<?php

class Kitchen_Model extends CI_Model{

    function current_order(){
        $result = $this->db->query('SELECT * FROM current_orders ORDER BY id DESC' );
        return $result->result_array();
        
    }

    function status_change($table){
        
        $data=$this->db->query("UPDATE current_orders  SET status='cooking'  WHERE table_no='".$table."'");
        //return true;
        $result = $this->db->query('SELECT * FROM current_orders WHERE table_no="'.$table.'"' );
        $status= $result->result_array();
        return $status[0]['status'];
    }

    function status_change_ready($table){

        $data=$this->db->query("UPDATE current_orders  SET status='Ready'  WHERE table_no='".$table."'");
        //return true;
        $result = $this->db->query('SELECT * FROM current_orders WHERE table_no="'.$table.'"' );
        $status= $result->result_array();
        return $status[0]['status'];

    }
  
    
}

?>