<?php

class DocumentItems extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Document_model');
        $this->load->model('DocumentItem_model');
        $this->load->helper('url_helper');
        $this->load->library('pagination');
        $this->load->library('session');
    }

    public function index() {
        $config['base_url'] = '/document-items/index/';
        $config['per_page'] = 20;
        $config['total_rows'] = $data['total_rows'] = $this->db->get('documentitem')->num_rows();

        $this->pagination->initialize($config);

        $data['documentItems'] = $this->DocumentItem_model->get_documentItems($config['per_page'], $this->uri->segment(3));
        $data['topicTypes'] = $this->Document_model->get_documents();
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('documentItems/index', $data);
    }
    
    public function filter() {
        $query = "SELECT * FROM `documentitem` ";
        
        $search = $this->input->get('search');
        if(null != $search && '' != $search) {
            $query = "SELECT * FROM `documentitem` "
                    . "WHERE `DocumentItemId` LIKE '%" . $search . "%' ESCAPE '!' OR `DocumentId` LIKE '%" . $search . "%' ESCAPE '!' OR `ParentItemId` LIKE '%" . 
                    $search . "%' ESCAPE '!' OR `Title` LIKE '%" . $search . "%' ESCAPE '!' OR `Text` LIKE '%" . $search . "%' ESCAPE '!' OR `Note` LIKE '%" . $search . 
                    "%' ESCAPE '!' OR `ItemOrder` LIKE '%" . $search . "%' ESCAPE '!' OR `CleanText` LIKE '%" . $search . "%' ESCAPE '!' ";
        }
        
        $data['documentItems'] = $this->db->query($query)->result_array();
        
        $config['total_rows'] = $data['total_rows'] = count($data['documentItems']);
        $config['base_url'] = '/document-items/index/';
        $config['per_page'] = 20;

        $this->pagination->initialize($config);
        
        $data['topicTypes'] = $this->Document_model->get_documents();
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->view('documentItems/index', $data);
    }
    
    public function view($id) {
        $documentItem = $this->DocumentItem_model->get_documentItems(false, false, $id);
        
        if (empty($documentItem)) {
            show_404();
        }
        
        echo json_encode($documentItem);
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('DocumentId', 'DocumentId', 'required');
        $this->form_validation->set_rules('ItemOrder', 'ItemOrder', 'required');
        $this->form_validation->set_rules('ItemOrder', 'ItemOrder', 'required|numeric');
        
        $data['documents'] = $this->Document_model->get_documents();
        $data['parentItems'] = $this->DocumentItem_model->get_documentItems();
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('documentItems/create', $data);
        } else {
            $this->DocumentItem_model->createDocumentItem();
            $this->session->set_flashdata('success', "Document item has been created successfully");
            redirect('document-items/index');
        }
    }

    public function delete($id) {
        $result = $this->DocumentItem_model->deleteDocumentItem($id);

        if(false === $result) {
            $this->session->set_flashdata('error', "Document item #$id has been assigned to other child Documents");
        } else {
            $this->session->set_flashdata('success', "Document item #$id has been deleted successfully");
        }
        
        redirect('document-items/index');
    }

    public function edit() {
        $id = $this->uri->segment(3);

        if (empty($id)) {
            $this->session->set_flashdata('error', "Document item id is'nt correct");
            redirect('document-items/index');
        } 
        $data['documentItem'] = $this->DocumentItem_model->get_documentItems(false, false, $id);
        if(empty($data)) {
            $this->session->set_flashdata('error', "Document item hasn't been found");
            redirect('document-items/index');
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['documents'] = $this->Document_model->get_documents();
        $data['parentItems'] = $this->DocumentItem_model->get_documentItems();
        
        $this->form_validation->set_rules('DocumentId', 'DocumentId', 'required');
        $this->form_validation->set_rules('ItemOrder', 'ItemOrder', 'required');
        $this->form_validation->set_rules('ItemOrder', 'ItemOrder', 'required|numeric');
        
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('documentItems/edit', $data);
            return;
        } else {
            $result = $this->DocumentItem_model->editDocumentItem($id);
            $this->session->set_flashdata('success', "Document item has been updated successfully");
            redirect('document-items/index');
        }
    }

}
