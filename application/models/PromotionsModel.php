<?php

class PromotionsModel extends CI_Model{

  public function __construct()
  {
    parent::__construct();

  }

  public function SavePromotions($data){
    return $this->db->insert('POM', $data);
  }

  public function infoPromotions(){
    $sql = 'SELECT * FROM POM WHERE POMdelete = 0';

    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
      $row = $query->result_array();
      foreach ($row as $key => $value) {        
        $row[$key]['branchName'] = $this->promotionBranch($value['POMbrhid']);        
      }
      return $row;
    }else {
      return $row = NULL;
    }
  }

  public function promotionBranch($id) {
    $sql = 'SELECT * FROM BRH WHERE BRHid IN (' . $id . ')';
    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
  }

  public function DeletePromotionsByGroup($d){
    $str = json_decode($d['chkmydel']);
    $x = implode(",",$str);
    $y = str_replace("1,", "", $x);
    $sql = 'UPDATE POM SET POMdelete = 1, POMdeleteBy = '.$d['psid'].' WHERE POMid IN ('.$x.')';
    
    return $this->db->query($sql);
  }

  public function ShowbyidPromotions($id){
    $sql = 'SELECT * FROM POM WHERE POMdelete = 0 AND POMid =' . $id;
    $query = $this->db->query($sql);
    $row = $query->row_array();

    return $row;
  }

  public function DeletePromotions($d){
    $data = array(
      'POMdelete' => '1',
      'POMdeleteBy' => $d['delPOMperid'],
      'POMdeleteDT' => date('Y-m-d H:i:s')
    );

    $this->db->where('POMid', $d['delPOMid']);
    return $this->db->update('POM', $data);
    
  }

  public function ShowbyidPromotion($id){
    $sql = 'SELECT * FROM POM WHERE POMdelete = 0 AND POMid = ' . $id;

    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
      $row = $query->result_array();
      foreach ($row as $key => $value) {
        $row[$key]['branchName'] = $this->promotionBranch($value['POMbrhid']);        
      }
      return $row;
    }else {
      return $row = NULL;
    }
  }

  public function EditPromotions($d){
    $this->db->where('POMid', $d['POMid']);
    return $this->db->update('POM', $d);
  }

}