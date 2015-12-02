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
        redirect(base_url(), 'refresh');
        }
    }

    public function home(){
        $this->load->view('admin/backend');
    }

    public function logout(){
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect(base_url(), 'refresh');
    }

   /* public function create(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $this->load->view('admin/create_account', $data);
        }
        else{
            //If no session, redirect to login page
            redirect(base_url(), 'refresh');
        }
    }

    public function execute(){
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]|callback_usermsg');
        //$this->form_validation->set_message('is_unique', 'هذا الاسم موجود من قبل');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('sdate', 'Start Date', 'trim|required');
        $this->form_validation->set_rules('edate', 'End Date', 'trim|required|callback_compareDates');

        $this->form_validation->set_rules('accnumber', 'Accounts number', 'trim|required|numeric|max_length[4]|callback_max_pst');
        $this->form_validation->set_rules('tag', 'Tag', 'trim|required|is_unique[users.tag]|callback_tagmsg');

        //$this->form_validation->set_message('is_unique', ' هذا التصنيف موجود');

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
            redirect('adala', 'refresh');
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

    public function max_pst()
    {
        if($this->input->post('accnumber')<1)
        {
            $this->form_validation->set_message('max_pst','الرجاء ادخال رقم واحد أو أكثر في عدد التسجيلات');
            return FALSE;
        }
        return TRUE;
    }*/


}