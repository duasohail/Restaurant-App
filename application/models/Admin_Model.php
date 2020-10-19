<?php

class Admin_Model extends CI_Model{

    function add_table($table){
		
        $this->db->query('INSERT INTO tables (table_num , current_status) 
                        VALUES ("'.$table.'" ,"0")');


        return true;
    }
    function show_table(){
		
        $result=$this->db->query('SELECT *FROM tables');
        return $result->result_array();
    }
    function dlt_table($id){
		
        $this->db->query('DELETE FROM tables Where id='.$id);
        return true;
    }
    function show_category(){
		
        $result=$this->db->query('SELECT * FROM main_categories');
        return $result->result_array();
    }
    function dlt_category($cat_id){
		
        $result=$this->db->query('DELETE FROM main_categories WHERE id='.$cat_id);
        return TRUE;
    }
    function dlt_menu_item($id){
		
        $result=$this->db->query('DELETE FROM menu_items WHERE id='.$id);
        $result=$this->db->query('DELETE FROM price WHERE item_id='.$id);
        return TRUE;
    }
    function edit_category($cat_id,$cat_name){
		
        // $result=$this->db->query('DELETE FROM main_categories WHERE id='.$cat_id);
        $this->db->query('UPDATE main_categories SET cat_name="'.$cat_name.'"  WHERE id='.$cat_id);
        return TRUE;
    }
    function edit_item($id,$item_name){
		
        // $result=$this->db->query('DELETE FROM main_categories WHERE id='.$cat_id);
        $this->db->query('UPDATE menu_items SET item_name="'.$item_name.'"  WHERE id='.$id);
        return TRUE;
    }
    function get_category_id($cat_name){
		
        $result=$this->db->query('SELECT id FROM main_categories WHERE cat_name='.$cat_name);
        return $result->row_array();
    }
    function show_menu($id){
		
        $result=$this->db->query('SELECT * FROM menu_items WHERE item_cat='.$id);
        return $result->result_array();
    }
    function add_price_size($id,$price,$size){
		
        $result=$this->db->query("SELECT * FROM price WHERE item_id='$id' AND size='$size'");
        $rows = $result->num_rows();
        if($rows >0 ){
            //update
            $this->db->query("UPDATE price SET price='$price' WHERE item_id='$id' AND size='$size'");
        }else{
            //in
            $this->db->query("INSERT INTO price (item_id , size , price) VALUES ('$id' , '$size'  ,'$price')");
        }
        return true;
    }
    
    function get_sales_report($s_d , $e_d){
		
        $result=$this->db->query("SELECT * FROM orders_history WHERE date = '$s_d'  ");
        return $result->result_array();
    }
    function get_cancle_report($s_d , $e_d){
		
        $result=$this->db->query("SELECT * FROM cancle_orders_history WHERE date = '$s_d'  ");
        return $result->result_array();
    }
    
    function add_menu($id,$item,$image){
        $this->db->query('INSERT INTO menu_items ( item_name, item_cat, item_image) 
        VALUES ("'.$item.'" ,"'.$id.'","'.$image.'")');
        return true;
    }

    function add_category($cat){
		
        $this->db->query('INSERT INTO main_categories(cat_name) 
                        VALUES ("'.$cat.'")');

        return true;
    }
}

?>