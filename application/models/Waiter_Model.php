<?php

class Waiter_Model extends CI_Model
{

    function get_categories()
    {
        $result = $this->db->query('SELECT * FROM main_categories');
        return $result->result_array();
    }

    function get_tables()
    {
        $result = $this->db->query('SELECT * FROM tables');
        return $result->result_array();
    }

    function get_first_menu($first_category_id)
    {
        $result = $this->db->query('SELECT * FROM menu_items WHERE item_cat=' . $first_category_id.' ORDER BY item_name');
        return $result->result_array();
    }

    function get_menu_item_info($id)
    {
        $result = $this->db->query('SELECT * FROM menu_items WHERE id=' . $id);
        return $result->result_array();
    }

    function get_price_info($id)
    {
        $result = $this->db->query('SELECT * FROM price WHERE item_id=' . $id);
        return $result->result_array();
    }
    
    function get_item_price($id, $currentSize)
    {
        $result = $this->db->query("SELECT * FROM price WHERE item_id='$id' AND size='$currentSize'");
        return $result->result_array();
    }

    function insert_current_order_data($current_table, $itemNameData, $sizeData, $qtyData, $amountData, $totalAmount, $waiter, $discount, $type)
    {

        if ($current_table == 0) {
            if($type == 2){
                $this->db->query("INSERT INTO current_orders (`table_no`, `items`, `quantity`, `size`, `total_amount`, `items_amount`, `waiter`,`status` , `discount` , `type`) VALUES ('$current_table','$itemNameData','$qtyData','$sizeData','$totalAmount','$amountData','$waiter','pending' , '$discount' , 'Delivery') ");
            }else{
                $this->db->query("INSERT INTO current_orders (`table_no`, `items`, `quantity`, `size`, `total_amount`, `items_amount`, `waiter`,`status` , `discount` , `type`) VALUES ('$current_table','$itemNameData','$qtyData','$sizeData','$totalAmount','$amountData','$waiter','pending' , '$discount' , 'Take Away') ");
            }
        } else {
            $result = $this->db->query("SELECT * FROM current_orders WHERE table_no='$current_table'");

            $rows = $result->num_rows();


            if ($rows > 0) {
                $this->db->query("UPDATE current_orders SET items='$itemNameData', size='$sizeData' , quantity='$qtyData', total_amount='$totalAmount' , items_amount='$amountData' , status='pending' , discount='$discount' WHERE table_no='$current_table'");
                $this->db->query("UPDATE tables SET current_status=1 WHERE table_num=$current_table");
            } else {
        
                $this->db->query("INSERT INTO current_orders (`table_no`, `items`, `quantity`, `size`, `total_amount`, `items_amount`, `waiter`,`status` , `discount`) VALUES ('$current_table','$itemNameData','$qtyData','$sizeData','$totalAmount','$amountData','$waiter','pending' , '$discount') ");
                $this->db->query("UPDATE tables SET current_status=1 WHERE table_num=$current_table");
            }
        }
        return $this->db->insert_id();
    }

    function get_current_order($table_no)
    {
        $result = $this->db->query("SELECT * FROM  current_orders WHERE table_no=$table_no");
        return $result->result_array();
    }

    function get_item_id($item)
    {
        $result = $this->db->query("SELECT * FROM  menu_items WHERE item_name='$item'");
        return $result->result_array();
    }

    function get_employees()
    {
        $result = $this->db->query("SELECT * FROM  employees");
        return $result->result_array();
    }
}
