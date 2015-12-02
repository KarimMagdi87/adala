<?php

class Topic_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_topics($perPage = false, $offset = false, $id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('topic', $perPage, $offset);
            return $query->result_array();
        }

        $query = $this->db->get_where('topic', array('TopicId' => $id));
        return $query->row_array();
    }

    public function set_topic() {
        $data = array(
            'Name' => $this->input->post('Name'),
            'TopicTypeId' => $this->input->post('TopicTypeId'),
            'ParentTopicId' => is_numeric($this->input->post('ParentTopicId'))? $this->input->post('ParentTopicId'): null
        );

        return $this->db->insert('topic', $data);
    }

    public function editTopic($id) {
        $data = array(
            'Name' => $this->input->post('Name'),
            'TopicTypeId' => $this->input->post('TopicTypeId'),
            'ParentTopicId' => is_numeric($this->input->post('ParentTopicId'))? $this->input->post('ParentTopicId'): null
        );

        $this->db->where('TopicId', $id);
        return $this->db->update('topic', $data);
    }
    
    public function delete_topic($id) {
        return $this->db->delete('topic', array('TopicId' => $id));
    }

}
