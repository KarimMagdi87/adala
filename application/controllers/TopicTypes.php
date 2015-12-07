<?php

class TopicTypes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('topicType_model');
        $this->load->helper('url_helper');
        $this->load->library('pagination');
        $this->load->library('session');
    }

    public function index() {
        $data['topicTypes'] = $this->topicType_model->get_topicTypes();
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('topicTypes/index', $data);
    }
    
    public function filter() {
        if(null != $this->input->get('name') && '' != $this->input->get('name')) {
            $this->db->like('Name', $this->input->get('name'));
        }
        
        if(null != $this->input->get('color') && '' != $this->input->get('color')) {
            $this->db->like('Color', $this->input->get('color'));
        }
        $data['topicTypes'] = $this->db->get_where('topictype')->result_array();
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('topicTypes/index', $data);
    }

    public function view($id = NULL) {
        $topicType = $this->topicType_model->get_topicTypes(false, false, $id);

        if (empty($topicType)) {
            show_404();
        }

        echo json_encode($topicType);
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('Color', 'Color', 'required');
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('topicTypes/create', $data);
        } else {
            $this->topicType_model->createTopicType();
            $this->session->set_flashdata('success', "Topic type has been created successfully");
            redirect('topic-types/index');
        }
    }

    public function delete($id) {
        $result = $this->topicType_model->delete_topic_type($id);

        if(false === $result) {
            $this->session->set_flashdata('error', "Topic type #$id has been assigned to topics or document types");
        } else {
            $this->session->set_flashdata('success', "Topic type #$id has been deleted successfully");
        }
        redirect('topic-types/index');
    }

    public function edit() {
        $id = $this->uri->segment(3);

        if (empty($id)) {
            $this->session->set_flashdata('error', "Topic type id is'nt correct");
            redirect('topic-types/index');
        } 
        $data = $this->topicType_model->get_topicTypes(false, false, $id);
        if(empty($data)) {
            $this->session->set_flashdata('error', "Topic type hasn't been found");
            redirect('topic-types/index');
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('Color', 'Color', 'required');
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('topicTypes/edit', $data);
            return;
        } else {
            $result = $this->topicType_model->editTopicType($id);
            $this->session->set_flashdata('success', "Topic type has been updated successfully");
            redirect('topic-types/index');
        }
    }

}
