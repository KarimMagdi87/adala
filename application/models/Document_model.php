<?php

class Document_model extends CI_Model {

    public $has_one = array('topictype');
    
    public function __construct() {
        $this->load->database();
    }

    public function get_documents($perPage = false, $offset = false, $id = FALSE) {
        
        if ($id === FALSE) {
            $this->db->select('document.*', 'documenttype.*, topic.*');
            $this->db->from('document');
            $this->db->join('documenttype', 'documenttype.DocumentTypeId = document.DocumentTypeId', 'left');
            $this->db->join('topic', 'topic.TopicId = document.TopicId', 'left');
            $this->db->limit($perPage, $offset);
            $query = $this->db->get();
//            print_r($query->result_array());
            return $query->result_array();
        }

        $query = $this->db->get_where('document', array('DocumentId' => $id));
        return $query->row_array();
    }

    public function createDocument() {
        $data = array(
            'TopicId' => $this->input->post('TopicId'),
            'DocumentTypeId' => $this->input->post('DocumentTypeId'),
            'ParentDocumentId' => is_numeric($this->input->post('ParentDocumentId'))? $this->input->post('ParentDocumentId'): null,
            'Note' => $this->input->post('Note'),
            'Year' => $this->input->post('Year'),
            'Publication' => $this->input->post('Publication'),
            'Date' => $this->input->post('Date'),
            'Intro' => $this->input->post('Intro'),
            'Summary' => $this->input->post('Summary'),
            'Text' => $this->input->post('Text'),
            'Title' => $this->input->post('Title'),
            'Number' => $this->input->post('Number'),
            'EditionNumber' => $this->input->post('EditionNumber'),
            'DocumentOrder' => $this->input->post('DocumentOrder'),
            'OldId' => $this->input->post('OldId'),
            'HTML' => $this->input->post('HTML'),
            'IndexId' => $this->input->post('IndexId')
        );

        return $this->db->insert('document', $data);
    }

    public function editDocument($id) {
        $data = array(
            'TopicId' => $this->input->post('TopicId'),
            'DocumentTypeId' => $this->input->post('DocumentTypeId'),
            'ParentDocumentId' => is_numeric($this->input->post('ParentDocumentId'))? $this->input->post('ParentDocumentId'): null,
            'Note' => $this->input->post('Note'),
            'Year' => $this->input->post('Year'),
            'Publication' => $this->input->post('Publication'),
            'Date' => $this->input->post('Date'),
            'Intro' => $this->input->post('Intro'),
            'Summary' => $this->input->post('Summary'),
            'Text' => $this->input->post('Text'),
            'Title' => $this->input->post('Title'),
            'Number' => $this->input->post('Number'),
            'EditionNumber' => $this->input->post('EditionNumber'),
            'DocumentOrder' => $this->input->post('DocumentOrder'),
            'OldId' => $this->input->post('OldId'),
            'HTML' => $this->input->post('HTML'),
            'IndexId' => $this->input->post('IndexId')
        );

        $this->db->where('DocumentId', $id);
        return $this->db->update('document', $data);
    }
    
    public function deleteDocument($id) {
        $childDocuments = $this->db->get_where('document', array('ParentDocumentId' => $id))->result_array();
        
        if(0 == count($childDocuments)) {
            return $this->db->delete('document', array('DocumentId' => $id));
        } else {
            return false;
        }
    }
}
