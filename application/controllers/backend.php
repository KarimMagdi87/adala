<?php
//session_start(); //we need to call PHP's session object to access it through CI
class Backend extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->model('admin_model','',TRUE);
    }

    public function index(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $this->load->view('admin/backend', $data);
            }
        else{
        //If no session, redirect to login page
        redirect('admin', 'refresh');
        }
    }

    public function home(){
        $this->load->view('admin/backend');
    }

    public function logout(){
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('admin', 'refresh');
    }

    public function create(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $this->load->view('admin/create_account', $data);
        }
        else{
            //If no session, redirect to login page
            redirect('admin', 'refresh');
        }
    }

    public function execute(){
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.  User redirected to login page
            // $this->load->view('admin/create_account');

            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $this->load->view('admin/create_account', $data);
            }

        }
        else
        {
            //Go to private area
            $this->admin_model->save_account();
            redirect('backend', 'refresh');
        }

    }


}