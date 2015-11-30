<?php

class Admin_model extends CI_Model{

    public function login($username, $password)
    {
        $this -> db -> select('id, username, password');
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

    public function save_account()
    {
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars($this->input->post('password'));
        $sdate = htmlspecialchars($this->input->post('sdate'));
        $edate = htmlspecialchars($this->input->post('edate'));
        $accnum = htmlspecialchars($this->input->post('accnumber'));
        $tag = htmlspecialchars($this->input->post('tag'));
        for($i=1; $i<=$accnum; $i++){
            $data = array(
                'username'=>$username.$i,
                'password'=>md5($password),
                'start_date'=> $sdate,
                'end_date'=>$edate,
                'tag'=>$tag
            );
            $this->db->insert('users',$data);

        }
    }
}