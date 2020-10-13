<?php

class Counter_Model extends CI_Model{

    function current_order(){
        $result = $this->db->query('SELECT * FROM current_orders ' );
        return $result->result_array();
        
    }
    function table_order($id){

        $result = $this->db->query('SELECT * FROM current_orders Where table_no ='.$id);
        return $result->result_array();

    }
    function deleteCurrentOrder($table_no){
		date_default_timezone_set("Asia/Karachi");

        $result = $this->db->query('SELECT * FROM current_orders Where table_no='.$table_no);
        $result = $result->result_array();
        $this->db->query('INSERT INTO orders_history (table_no , items , quantity , size , total_amount , items_amount , waiter  , date , time) 
                        VALUES ("'.$result[0]['table_no'].'" ,"'.$result[0]['items'].'","'.$result[0]['quantity'].'","'.$result[0]['size'].'","'.$result[0]['total_amount'].'","'.$result[0]['items_amount'].'","'.$result[0]['waiter'].'" , "'.date("d M, Y").'" , "'.date("h:ia").'" )');

        $this->db->query('DELETE  FROM current_orders Where table_no='.$table_no);
        $this->db->query('UPDATE tables SET current_status = 0 Where table_num='.$table_no);

        return true;
    }
}

?>