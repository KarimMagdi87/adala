<?php

class Documents extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Document_model');
        $this->load->model('DocumentType_model');
        $this->load->model('Topic_model');
        $this->load->helper('url_helper');
        $this->load->library('pagination');
        $this->load->library('session');
    }

    public function index() {
        $data['documents'] = $this->Document_model->get_documents();
        $data['topics'] = $this->Topic_model->get_topics();
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('documents/index', $data);
    }
    
    public function filter() {
        if(null != $this->input->get('name') && '' != $this->input->get('name')) {
            $this->db->like('Name', $this->input->get('name'));
        }
        
        if(null != $this->input->get('topicType') && '' != $this->input->get('topicType')) {
            $this->db->where('TopicTypeId', $this->input->get('topicType'));
        }
        
        if(null != $this->input->get('color') && '' != $this->input->get('color')) {
            $this->db->like('Color', $this->input->get('color'));
        }
        $data['documentTypes'] = $this->db->get_where('documenttype')->result_array();
        $data['parentDocuments'] = $this->db->get_where('document')->result_array();
        $data['topics'] = $this->Topic_model->get_topics();
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('documents/index', $data);
    }
    
    public function view($id) {
        $document = $this->Document_model->get_documents(false, false, $id);
        
        if (empty($document)) {
            show_404();
        }
        
        echo json_encode($document);
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('TopicId', 'TopicId', 'required');
        $this->form_validation->set_rules('DocumentTypeId', 'DocumentTypeId', 'required');
        
        $data['topics'] = $this->Topic_model->get_topics();
        $data['documentTypes'] = $this->db->get_where('documenttype')->result_array();
        $data['parentDocuments'] = $this->db->get_where('document')->result_array();
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('documents/create', $data);
        } else {
            $this->Document_model->createDocument();
            $this->session->set_flashdata('success', "Document type has been created successfully");
            redirect('documents/index');
        }
    }

    public function delete($id) {
        $result = $this->Document_model->deleteDocument($id);
        
        if(false === $result) {
            $this->session->set_flashdata('error', "Document #$id has been assigned to other child Documents");
        } else {
            $this->session->set_flashdata('success', "Document #$id has been deleted successfully");
        }

        
        redirect('documents/index');
    }

    public function edit() {
        $id = $this->uri->segment(3);

        if (empty($id)) {
            $this->session->set_flashdata('error', "Document id is'nt correct");
            redirect('documents/index');
        } 
        $data['document'] = $this->Document_model->get_documents(false, false, $id);
        if(empty($data)) {
            $this->session->set_flashdata('error', "Document hasn't been found");
            redirect('documents/index');
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['topics'] = $this->Topic_model->get_topics();
        $data['documentTypes'] = $this->db->get_where('documenttype')->result_array();
        $data['parentDocuments'] = $this->db->get_where('document')->result_array();
        
        $this->form_validation->set_rules('TopicId', 'TopicId', 'required');
        $this->form_validation->set_rules('DocumentTypeId', 'DocumentTypeId', 'required');
        
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('documents/edit', $data);
            return;
        } else {
            $result = $this->Document_model->editDocument($id);
            $this->session->set_flashdata('success', "Document has been updated successfully");
            redirect('documents/index');
        }
    }

}
