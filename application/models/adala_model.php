<?php

class Adala_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getTopicTypes()
    {
        $q = $this -> db -> query("SELECT name, topictypeid FROM topictype ORDER BY name DESC");

        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return FALSE;
        }
    }

    public function getDocumentType() //TO DO check documenttypeid
    {
        $q = $this -> db -> query("SELECT dt.name, dt.documenttypeid, tt.topictypeid
                                   FROM documenttype dt inner join topictype tt
                                   on dt.topictypeid = tt.topictypeid");

        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return FALSE;
        }
    }

    public function getTypes($id)               //Get primary topics (first select box)
    {
        $q = $this -> db -> query("SELECT * FROM topic WHERE topic.topicid IN (SELECT topicid FROM documenttypetopic
                                   WHERE documenttypetopic.documenttypeid=".$id." )AND parenttopicid is Null ORDER BY NAME ASC");

        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return FALSE;
        }
    }

    public function getSecondTypes($primaryId, $topicId)        //Get secondary topics (second select box)
    {
        $q = $this -> db -> query("SELECT * FROM topic WHERE topic.topicid IN (SELECT topicid FROM documenttypetopic
                                   WHERE documenttypetopic.documenttypeid=".$primaryId." )
                                   AND parenttopicid = ".$topicId." ORDER BY NAME ASC");

        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return FALSE;
        }
    }

    public function getDocuments($documentTypeId)         //get Document and fill them in the table
    {
        $q = $this -> db -> query("select * from document where DocumentTypeId =".$documentTypeId);

        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return FALSE;
        }
    }

    public function getDocumentDisplay($documentId)                 //get Document Data for display
    {
        $q = $this -> db -> query("SELECT * FROM documentitem WHERE documentid =". $documentId);

        if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return FALSE;
        }
    }
}