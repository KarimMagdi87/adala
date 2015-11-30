<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

    function __construct(){

        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->model('admin_model','',TRUE);
    }

    public function index(){

       // $this->load->helper(array('form'));
        $this->load->view('admin/index');
    }

    function login(){
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.  User redirected to login page
            $this->load->view('admin/index');
        }
        else
        {
            //Go to private area

            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            //echo $data['username']; exit;
            if($data['username'] == "admin"){
                redirect('backend', 'refresh');
            }
            else{
                redirect('adala', 'refresh');
            }

        }
    }

    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $username = htmlspecialchars($this->input->post('username'));

        //query the database
        $result = $this->admin_model->login($username, $password);

        if($result)
        {
            $sess_array = array();
            foreach($result as $row)
            {
                $sess_array = array(
                    'id' => $row->id,
                    'username' => $row->username
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database', 'برجاء التحقق من اسم المستخدم أو كلمة المرور');
            return false;
        }
    }
}