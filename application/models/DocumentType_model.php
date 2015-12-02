<?php

class DocumentType_model extends CI_Model {

    public $has_one = array('topictype');
    
    public function __construct() {
        $this->load->database();
    }

    public function get_documentTypes($perPage = false, $offset = false, $id = FALSE) {
        
        if ($id === FALSE) {
            $this->db->select('documenttype.*, topictype.*');
            $this->db->from('documenttype');
            $this->db->join('topictype', 'topictype.TopicTypeId = documenttype.TopicTypeId', 'left');
            $this->db->limit($perPage, $offset);
            $query = $this->db->get();
//            print_r($query->result_array());
            return $query->result_array();
        }

        $query = $this->db->get_where('documenttype', array('DocumentTypeId' => $id));
        return $query->row_array();
    }

    public function createDocumentType() {
        $data = array(
            'Name' => $this->input->post('Name'),
            'Color' => $this->input->post('Color'),
            'TopicTypeId' => $this->input->post('TopicTypeId')
        );

        return $this->db->insert('documenttype', $data);
    }

    public function editDocumentType($id) {
        $data = array(
            'Name' => $this->input->post('Name'),
            'Color' => $this->input->post('Color')
        );

        $this->db->where('DocumentTypeId', $id);
        return $this->db->update('documenttype', $data);
    }
    
    public function deleteDocumentType($id) {
        return $this->db->delete('documenttype', array('DocumentTypeId' => $id));
    }
}
