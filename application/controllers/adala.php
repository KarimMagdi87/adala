<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adala extends CI_Controller{

    public function index(){

        $this -> load -> model('adala_model');

        $data['rowsTopicTypes'] = $this -> adala_model -> getTopicTypes();

        $data['rowsDocumentType'] = $this-> adala_model -> getDocumentType();

        //print_r($data);
        $this->load->view('adala/index', $data);
    }

    public function getTypes(){         //Get Primary topics (First select box)
        $id = $_POST['id'];
        $returnArray = array();

        $this -> load -> model('adala_model');
        $data['rows'] = $this -> adala_model -> getTypes($id);

        foreach($data as $d){
            foreach($d as $ob){
                $arr['name'] = $ob->Name;
                $arr['topicID'] = $ob->TopicId;
                $arr['parentTopicID'] = $ob->ParentTopicId;
                array_push($returnArray, $arr);
            }
        }
        echo json_encode($returnArray);
    }


    public function getSecondTypes(){        //Get Secondary topics(Second select box)
        $topicId = $_POST['topicId'];
        $primaryId = $_POST['primaryId'];
        $returnArray = array();

        $this -> load -> model('adala_model');
        $data['rows'] = $this -> adala_model -> getSecondTypes($primaryId, $topicId);
       //print_r($data);
        foreach($data as $d){
            foreach($d as $ob){
                $arr['name'] = $ob->Name;
                $arr['topicID'] = $ob->TopicId;
                $arr['parentTopicID'] = $ob->ParentTopicId;
                array_push($returnArray, $arr);
            }
        }
        echo json_encode($returnArray);
    }

    public function getDocuments(){     //getDocuments fired on DOcumentType (menu leve 2)
        $documentTypeId = $_POST['documentTypeId'];
        $returnArray = array();

        $this -> load -> model('adala_model');
        $data['rows'] = $this -> adala_model -> getDocuments($documentTypeId);
        //print_r($data); exit;
        foreach($data as $d){
            foreach($d as $ob){
                $arr['documentId'] = $ob->DocumentId;
                $arr['title'] = $ob->Title;
                $arr['number'] = $ob->Number;
                $arr['year'] = $ob->Year;
                array_push($returnArray, $arr);
            }
        }
        echo json_encode($returnArray);
    }

    public function getDocumentDisplay(){         //get Document Data for dispaly
        $documentId = $_POST['documentId'];
        $returnArray = array();
        //echo $documentId;
        $this -> load -> model('adala_model');
        $data['rows'] = $this -> adala_model -> getDocumentDisplay($documentId);
        //print_r($data); exit;
        foreach($data as $d){
            foreach($d as $ob){
                $arr['documentItemID'] = $ob->DocumentItemId;
                $arr['title'] = strip_tags($ob->Title);
                $arr['text'] = strip_tags($ob->Text);
                array_push($returnArray, $arr);
            }
        }
        echo json_encode($returnArray);
    }

}