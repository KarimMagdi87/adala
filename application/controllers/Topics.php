<?php

class Topics extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('topic_model');
        $this->load->model('TopicType_model');
        $this->load->helper('url_helper');
        $this->load->library('pagination');
        $this->load->library('session');
    }

    public function index() {
        $data['topics'] = $this->topic_model->get_topics();
        
        $data['topicTypes'] = $this->TopicType_model->get_topicTypes();
        $data['parentTopics'] = $this->topic_model->get_topics();
        
        $this->load->view('topics/index', $data);
    }
    
    public function filter() {
        if(null != $this->input->get('name') && '' != $this->input->get('name')) {
            $this->db->like('Name', $this->input->get('name'));
        }
        
        if(null != $this->input->get('topicType') && '' != $this->input->get('topicType')) {
            $this->db->where('TopicTypeId', $this->input->get('topicType'));
        }
        
        if(null != $this->input->get('parentTopic') && '' != $this->input->get('parentTopic')) {
            $this->db->where('ParentTopicId', $this->input->get('parentTopic'));
        }
        $data['topics'] = $this->db->get_where('topic')->result_array();
        
        $data['topicTypes'] = $this->TopicType_model->get_topicTypes();
        $data['parentTopics'] = $this->topic_model->get_topics();
        
        $this->load->view('topics/index', $data);
    }
    
    public function view($id = NULL) {
        $data['topic'] = $this->topic_model->get_topics(false, false, $id);

        if (empty($data['topic'])) {
            show_404();
        }

        $this->load->view('topics/view', $data);
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('TopicTypeId', 'TopicTypeId', 'required');
        
        $data['topicTypes'] = $this->TopicType_model->get_topicTypes();
        $data['parentTopics'] = $this->topic_model->get_topics();
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('topics/create', $data);
        } else {
            $this->topic_model->set_topic();
            $this->session->set_flashdata('success', "Topic has been created successfully");
            redirect('topics/index');
        }
    }

    public function edit() {
        $id = $this->uri->segment(3);

        if (empty($id)) {
            $this->session->set_flashdata('error', "topic id is'nt correct");
            redirect('topics/index');
        } 
        $data['topic'] = $this->topic_model->get_topics(false, false, $id);
        $data['topicTypes'] = $this->TopicType_model->get_topicTypes();
        $data['parentTopics'] = $this->topic_model->get_topics();
        
        if(empty($data)) {
            $this->session->set_flashdata('error', "topic hasn't been found");
            redirect('topics/index');
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['topicTypes'] = $this->TopicType_model->get_topicTypes();
        
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('TopicTypeId', 'TopicTypeId', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('topics/edit', $data);
            return;
        } else {
            $result = $this->topic_model->editTopic($id);
            $this->session->set_flashdata('success', "topic has been updated successfully");
            redirect('topics/index');
        }
    }
    
    public function delete($id) {
        $this->topic_model->delete_topic($id);
        
        $this->session->set_flashdata('success', "Topic #$id has been deleted successfully");
        redirect('topics/index');
    }
}
