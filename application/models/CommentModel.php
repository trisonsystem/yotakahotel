<?php

class CommentModel extends CI_Model{

    public function __construct() {
        parent::__construct();
    }

     public function SeInfoComment() {
        $sql = 'SELECT * FROM CME';

        $query = $this->db->query($sql);
        $row = $row = $query->result_array();

        return $row;
    }

    public function ShowCommentByID($id){
      $sql = 'SELECT * FROM CME WHERE CMEid =' . $id;
      $query = $this->db->query($sql);
      $row = $query->row_array();

      return $row;
    }

    public function SaveCommentAndSend($d){

      $data = array(
        'CMEresmessage' => $d['CMEresmessage'],
        'CMErespond' => '1',
        'CMEresdate' => date('Y-m-d H:i:s'),
        'CMEperid' => $d['CMEperid']
      );

      $this->db->where('CMEid', $d['CMEid']);
      $this->db->update('CME', $data);
      return $this->ShowCommentByID($d['CMEid']);
    }


}
