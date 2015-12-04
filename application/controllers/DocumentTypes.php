<?php

class DocumentTypes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('DocumentType_model');
        $this->load->model('TopicType_model');
        $this->load->helper('url_helper');
        $this->load->library('pagination');
        $this->load->library('session');
    }

    public function index() {
        $data['documentTypes'] = $this->DocumentType_model->get_documentTypes();
        $data['topicTypes'] = $this->TopicType_model->get_topicTypes();
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('documentTypes/index', $data);
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
        $data['topicTypes'] = $this->TopicType_model->get_topicTypes();
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('documentTypes/index', $data);
    }
    
    public function view($id) {
        $documentType = $this->DocumentType_model->get_documentTypes(false, false, $id);
        
        if (empty($documentType)) {
            show_404();
        }
        
        echo json_encode($documentType);
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('TopicTypeId', 'TopicTypeId', 'required');
        $this->form_validation->set_rules('Color', 'Color', 'required');
        
        $data['topicTypes'] = $this->TopicType_model->get_topicTypes();
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('documentTypes/create', $data);
        } else {
            $this->DocumentType_model->createDocumentType();
            $this->session->set_flashdata('success', "Document type has been created successfully");
            redirect('document-types/index');
        }
    }

    public function delete($id) {
        $this->DocumentType_model->deleteDocumentType($id);

        $this->session->set_flashdata('success', "Document type #$id has been deleted successfully");
        redirect('document-types/index');
    }

    public function edit() {
        $id = $this->uri->segment(3);

        if (empty($id)) {
            $this->session->set_flashdata('error', "Document type id is'nt correct");
            redirect('document-types/index');
        } 
        $data['documentType'] = $this->DocumentType_model->get_documentTypes(false, false, $id);
        if(empty($data)) {
            $this->session->set_flashdata('error', "Document type hasn't been found");
            redirect('document-types/index');
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['topicTypes'] = $this->TopicType_model->get_topicTypes();
        
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('Color', 'Color', 'required');
        $this->form_validation->set_rules('TopicTypeId', 'TopicTypeId', 'required');
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('documentTypes/edit', $data);
            return;
        } else {
            $result = $this->DocumentType_model->editDocumentType($id);
            $this->session->set_flashdata('success', "Document type has been updated successfully");
            redirect('document-types/index');
        }
    }

}
