<?php

class Documents extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Document_model');
        $this->load->model('DocumentType_model');
        $this->load->model('DocumentItem_model');
        $this->load->model('Topic_model');
        $this->load->helper('url_helper');
        $this->load->library('pagination');
        $this->load->library('session');
    }

    public function index() {
        $config['base_url'] = '/documents/index/';
        $config['per_page'] = 20;
        $config['total_rows'] = $this->db->get('document')->num_rows();
        $config['num_links'] = 5;

        $this->pagination->initialize($config);

        $data['documents'] = $this->Document_model->get_documents($config['per_page'], $this->uri->segment(3));
        $data['total_rows'] = $config['total_rows'];
        $data['topics'] = $this->Topic_model->get_topics();
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('documents/index', $data);
    }
    
    public function filter() {
        $query = "SELECT * FROM `document` ";
        
        $search = $this->input->get('search');
        if(null != $search && '' != $search) {
            $query = "SELECT * FROM `document` WHERE `DocumentId` LIKE '%" . $search . "%' ESCAPE '!' OR `TopicId` LIKE '%" . $search .
                    "%' ESCAPE '!' OR `DocumentTypeId` LIKE '%" . $search . "%' ESCAPE '!' OR `ParentDocumentId` LIKE '%" . $search . 
                    "%' ESCAPE '!' OR `Note` LIKE '%" . $search . "%' ESCAPE '!' OR `Year` LIKE '%" . $search . "%' ESCAPE '!' OR `Publication` LIKE '%" .
                    $search . "%' ESCAPE '!' OR `Intro` LIKE '%" . $search . "%' ESCAPE '!' OR `Summary` LIKE '%" .
                    $search . "%' ESCAPE '!' OR `Text` LIKE '%" . $search . "%' ESCAPE '!' OR `Title` LIKE '%" . $search . "%' ESCAPE '!' OR `Number` LIKE '%" . 
                    $search . "%' ESCAPE '!' OR `EditionNumber` LIKE '%" . $search . "%' ESCAPE '!' OR `DocumentOrder` LIKE '%" . $search . "%' ESCAPE '!' OR `OldId` LIKE '%" . 
                    $search . "%' ESCAPE '!' OR `HTML` LIKE '%" . $search . "%' ESCAPE '!' OR `IndexId` LIKE '%" . $search . "%' ESCAPE '!'";
            
            if(false !== strtotime($search)) {
                $query .= " OR `Date` LIKE '%" . $search . "%' ESCAPE '!' ";
            }
            
        }
        
        $data['documents'] = $this->db->query($query)->result_array();
        
        $config['base_url'] = '/documents/index/';
        $config['per_page'] = 20;
        $config['total_rows'] = $data['total_rows'] = count($data['documents']);
        $this->pagination->initialize($config);
        
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
    
    public function getDocumentItems($documentId) {
        $data['documentItems'] = $this->db->get_where('documentitem', array('DocumentId' => $documentId))->result_array();
        
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('documents/documentItems', $data);
    }
}
