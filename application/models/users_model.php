<?php

class Users_model extends CI_Model{

    public function save_account(){

        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars($this->input->post('password'));
        $sdate = htmlspecialchars($this->input->post('sdate'));
        $edate = htmlspecialchars($this->input->post('edate'));
        $accnum = htmlspecialchars($this->input->post('accnumber'));
        $tag = htmlspecialchars($this->input->post('tag'));

        if($accnum == 0 || $accnum == 1 ){
            $data = array(
                'username'=>$username,
                'password'=>md5($password),
                'start_date'=> strtotime($sdate),
                'end_date' => strtotime($edate),
                'tag'=>$tag
            );
            $this->db->insert('users',$data);

        }else{
            for($i=1; $i<=$accnum; $i++){
                $data = array(
                    'username'=>$username.$i,
                    'password'=>md5($password),
                    'start_date'=> strtotime($sdate),
                    'end_date'=> strtotime($edate),
                    'tag'=>$tag
                );
                $this->db->insert('users',$data);

            }
        }
    }

    public function getUsers(){
        $q = $this -> db -> get('users');;

        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return FALSE;
        }
    }

    public function enablAll($id){
        $data = array(
            'cpy_status'=> 1,
            'dnld_status' => 1
        );
        $this -> db -> where("id", $id);
        return $this -> db -> update('users', $data);
    }

    public function enablCopy($id, $val){
        if($val == 0){
            $data = array('cpy_status'=> 1);
        }else{
            $data = array('cpy_status'=> 0);
        }
        $this -> db -> where("id", $id);
        return $this -> db -> update('users', $data);
    }

    public function enablDownload($id, $val){
        if($val == 0){
            $data = array('dnld_status'=> 1);
        }else{
            $data = array('dnld_status'=> 0);
        }
        $this -> db -> where("id", $id);
        return $this -> db -> update('users', $data);
    }
}