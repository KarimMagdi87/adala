<?php

class DocumentItem_model extends CI_Model {
    
    public function __construct() {
        $this->load->database();
    }

    public function get_documentItems($perPage = false, $offset = false, $id = FALSE) {
        
        if ($id === FALSE) {
            $this->db->select('documentitem.*');
            $this->db->from('documentitem');
            $this->db->limit($perPage, $offset);
            $query = $this->db->get();
//            print_r($query->result_array());
            return $query->result_array();
        }

        $query = $this->db->get_where('documentitem', array('DocumentItemId' => $id));
        return $query->row_array();
    }

    public function createDocumentItem() {
        $data = array(
            'DocumentId' => $this->input->post('DocumentId'),
            'ParentItemId' => $this->input->post('ParentItemId'),
            'Title' => ('' !=$this->input->post('Title'))? $this->input->post('Title'): null,
            'Text' => ('' !=$this->input->post('Text'))? $this->input->post('Text'): null,
            'Note' => ('' !=$this->input->post('Note'))? $this->input->post('Note'): null,
            'ItemOrder' => is_numeric($this->input->post('ItemOrder'))? $this->input->post('ItemOrder'): null,
            'CleanText' => ('' !=$this->input->post('CleanText'))? $this->input->post('CleanText'): null,
        );

        return $this->db->insert('documentitem', $data);
    }

    public function editDocumentItem($id) {
        $data = array(
            'DocumentId' => $this->input->post('DocumentId'),
            'ParentItemId' => $this->input->post('ParentItemId'),
            'Title' => ('' !=$this->input->post('Title'))? $this->input->post('Title'): null,
            'Text' => ('' !=$this->input->post('Text'))? $this->input->post('Text'): null,
            'Note' => ('' !=$this->input->post('Note'))? $this->input->post('Note'): null,
            'ItemOrder' => is_numeric($this->input->post('ItemOrder'))? $this->input->post('ItemOrder'): null,
            'CleanText' => ('' !=$this->input->post('CleanText'))? $this->input->post('CleanText'): null,
        );

        $this->db->where('DocumentItemId', $id);
        return $this->db->update('documentitem', $data);
    }
    
    public function deleteDocumentItem($id) {
        $childDocumentItems = $this->db->get_where('documentitem', array('ParentItemId' => $id))->result_array();
        
        if(0 == count($childDocumentItems)) {
            return $this->db->delete('documentitem', array('DocumentItemId' => $id));
        } else {
            return false;
        }
        
    }
}
