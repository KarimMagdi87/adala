<?php

class TopicType_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_topicTypes($perPage = false, $offset = false, $id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('topictype', $perPage, $offset);
            return $query->result_array();
        }

        $query = $this->db->get_where('topictype', array('TopicTypeId' => $id));
        return $query->row_array();
    }

    public function createTopicType() {
        $data = array(
            'Name' => $this->input->post('Name'),
            'Color' => $this->input->post('Color')
        );

        return $this->db->insert('topictype', $data);
    }

    public function editTopicType($id) {
        $data = array(
            'Name' => $this->input->post('Name'),
            'Color' => $this->input->post('Color')
        );

        $this->db->where('TopicTypeId', $id);
        return $this->db->update('topictype', $data);
    }
    
    public function delete_topic_type($id) {
        $documentTypes = $this->db->get('documenttype', array('TopicTypeId' => $id))->result_array();
        $topics = $this->db->get('topic', array('TopicTypeId' => $id))->result_array();
        
        if(count($topics) == 0 && 0 == count($documentTypes)) {
            return $this->db->delete('topictype', array('TopicTypeId' => $id));
        } else {
            return false;
        }
    }
}
