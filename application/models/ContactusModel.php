<?php

  /**
   *
   */
  class ContactusModel extends CI_Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function saveCommentsByCus($d){

      $data = array(
        'CMEname' => $d['commname'],
        'CMEemail' => $d['commemail'],
        'CMEcomment' => $d['commcomment'],
        'CMEresmessage' => '',
        'CMEvote' => $d['commvote'],
        'CMErespond' => '',
        'CMEcomdate' => date('Y-m-d H:i:s'),
        'CMEresdate' => date('Y-m-d H:i:s'),
        'CMEperid' => 00
      );

      return $this->db->insert('CME', $data);
    }

  }


 ?>
