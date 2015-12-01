<?php

class Admin_model extends CI_Model{

    public function login($username, $password)
    {
        $this -> db -> select('id, username, password, end_date, user_status, cpy_status, dnld_status');
        $this -> db -> from('users');
        $this -> db -> where('username', $username);
        $this -> db -> where('password', MD5($password));
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }

}