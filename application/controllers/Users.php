<?php
//session_start(); //we need to call PHP's session object to access it through CI
class Users extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->model('users_model','',TRUE);
        $this->session->set_flashdata('feedback', 'تم بنجاح');
    }

    public function index(){

        $data['rowUsers'] =  $this->users_model->getUsers();

        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $this->load->view('users/index', $data);
        }
        else{
            //If no session, redirect to login page
            redirect(base_url(), 'refresh');
        }
    }

    public function create(){

        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $this->load->view('users/create_account', $data);
        }
        else{
            //If no session, redirect to login page
            redirect(base_url(), 'refresh');
        }
    }

    public function execute(){
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'username', 'Username',
            'required|is_unique[users.username]',
            array(
                'is_unique' => 'اسم المستخدم موجود من قبل , الرجاء اختيار اسم اخر'
            )
        );
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('sdate', 'Start Date', 'trim|required');
        $this->form_validation->set_rules('edate', 'End Date', 'trim|required|callback_compareDates');

        if(isset($_POST[$this->input->post('accnumber')]) && isset($_POST[$this->input->post('tag')])){
            $this->form_validation->set_rules('accnumber', 'Accounts number', 'trim|required|numeric|max_length[4]|callback_max_pst');

            $this->form_validation->set_rules(
                'tag', 'Tag',
                'required|is_unique[users.tag]',
                array(
                    'is_unique' => 'هذا التصنيف موجود من قبل , الرجاء اختيار اسم اخر'
                )
            );
        }

        if($this->form_validation->run() == FALSE){
            //Field validation failed.  User redirected to login page
            // $this->load->view('admin/create_account');

            if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                $data['username'] = $session_data['username'];
                $this->load->view('users/create_account', $data);
            }

        }
        else
        {
            //Go to private area
            $this->users_model->save_account();
            redirect('backend', 'refresh');
        }

    }


    public function compareDates(){          //compare date validation
        $start = htmlspecialchars(strtotime($this->input->post('sdate')));
        $end = htmlspecialchars(strtotime($this->input->post('edate')));
        if ($start > $end) {
            $this->form_validation->set_message('compareDates', 'تاريخ الانتهاء لابد أن يكون أكبر من تاريخ الابتداء');
            return false;
        }
    }


    public function max_pst(){
        if($this->input->post('accnumber')<1)
        {
            $this->form_validation->set_message('max_pst','الرجاء ادخال رقم واحد أو أكثر في عدد التسجيلات');
            return FALSE;
        }
        return TRUE;
    }


    public function enablAll(){
        if(!isset($_POST['id'])){
            redirect(base_url(), 'refresh');
        }else {
            $id = $_POST['id'];
            $this->users_model->enablAll($id);
            echo $this->session->flashdata('feedback');
        }
    }

    public function enablCopy(){
        if(!isset($_POST['id']) || !isset($_POST['val'])){
            redirect(base_url(), 'refresh');
        }else {
            $id = $_POST['id'];
            $val = $_POST['val'];
            $this->users_model->enablCopy($id, $val);
            echo $this->session->flashdata('feedback');
        }
    }

    public function enablDownload(){
        if(!isset($_POST['id']) || !isset($_POST['val'])){
            redirect(base_url(), 'refresh');
        }else {
            $id = $_POST['id'];
            $val = $_POST['val'];
            $this->users_model->enablDownload($id, $val);
            echo $this->session->flashdata('feedback');
        }
    }

    public function enablUser(){
        if(!isset($_POST['id']) || !isset($_POST['val'])){
            redirect(base_url(), 'refresh');
        }else {
            $id = $_POST['id'];
            $val = $_POST['val'];
            $this->users_model->enablUser($id, $val);
            echo $this->session->flashdata('feedback');
        }
    }

    public function resetPassword(){
        if(!isset($_POST['id'])){
            redirect(base_url(), 'refresh');
        }else {
            $id = $_POST['id'];
            $this->users_model->resetPassword($id);
            echo $this->session->flashdata('feedback');
        }
    }

    public function deleteUser(){
        if(!isset($_POST['id'])){
            redirect(base_url(), 'refresh');
        }else {
            $id = $_POST['id'];
            $this -> db -> where("id", $id);
            return $this -> db -> delete('users');
        }
    }
}