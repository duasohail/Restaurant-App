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
    function edit_category($cat_id,$cat_name){
		
        // $result=$this->db->query('DELETE FROM main_categories WHERE id='.$cat_id);
        $this->db->query('UPDATE main_categories SET cat_name="'.$cat_name.'"  WHERE id='.$cat_id);
        return TRUE;
    }
    function get_category_id($cat_name){
		
        $result=$this->db->query('SELECT id FROM main_categories WHERE cat_name='.$cat_name);
        return $result->row_array();
    }
    function show_menu($id){
		
        $result=$this->db->query('SELECT item_name FROM menu_items WHERE item_cat='.$id);
        return $result->result_array();
    }
    function add_menu($id,$item,$image){
        $this->db->query('INSERT INTO menu_items ( item_name, item_cat, item_image) 
        VALUES ("'.$item.'" ,"'.$id.'","'.$image.'")');

    }

    function add_category($cat){
		
        $this->db->query('INSERT INTO main_categories(cat_name) 
                        VALUES ("'.$cat.'")');


        return true;
    }
}

?>