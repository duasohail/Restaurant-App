<?php

class Login_Model extends CI_Model{

    function login($email , $password){
        $result = $this->db->query('SELECT * FROM users WHERE email="'.$email.'" AND password="'.$password.'" ' );

        return $result;
    }

}

?>