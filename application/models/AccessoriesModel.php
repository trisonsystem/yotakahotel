<?php

class AccessoriesModel extends CI_Model{

  public function __construct()
  {
    parent::__construct();

  }

  public function infoAccessories(){
    $sql = 'SELECT * FROM RAS LEFT JOIN USC ON RAS.RASwar = USC.USCcode WHERE RASdelete = 0 AND USCuse = 30';

    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
        $row = $query->result_array();
        foreach ($row as $key => $value) {
            $row[$key]['branch'] = $this->branch($value['RASbrhid']);      
        }

      return $row;
    }else {
      return $row = NULL;
    }
  }

  public function getAccessoriesByBranchID($bid){
    $sql = 'SELECT * FROM RAS WHERE RASdelete = 0 AND RASbrhid = ' . $bid;
    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
  }

  public function branch($bid) {
    $sql = 'SELECT * FROM BRH WHERE BRHid =' . $bid;
    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
  }

  public function SaveAccessories($d){
    
    $data = array(
      'RASdescTH' => $d['RASdescTH'],
      'RASdescEN' => $d['RASdescEN'],
      'RASquan' => $d['RASquan'],
      'RASprice' => $d['RASprice'],
      'RASwar' => $d['RASwar'],
      'RASbrhid' => $d['RASbrhid'],
      'RAScreatedDT' => date('Y-m-d H:i:s'),
      'RASeditedDT' => date('Y-m-d H:i:s'),
      'RASdelete' => 0,
      'RASdeleteBy' => '',
      'RASdeleteDT' => date('Y-m-d H:i:s')
    );
    return $this->db->insert('RAS', $data);
  }

  public function DeleteAccessoriesByGroup($d){
    $str = json_decode($d['chkmydel']);
      $x = implode(",",$str);
      $y = str_replace("1,", "", $x);
      $sql = 'UPDATE RAS SET RASdelete = 1, RASdeleteBy = '.$d['psid'].' WHERE RASid IN ('.$x.')';
      
      return $this->db->query($sql);
  }

  public function ShowbyidAccessories($id){
    $sql = 'SELECT * FROM RAS WHERE RASdelete = 0 AND RASid = ' . $id;

    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
        $row = $query->result_array();
        foreach ($row as $key => $value) {
            $row[$key]['branch'] = $this->branch($value['RASbrhid']);      
        }

      return $row;
    }else {
      return $row = NULL;
    }
  }

  public function DeleteAccessories($d){
    $data = array(
      'RASdelete' => '1',
      'RASdeleteBy' => $d['delRASperid'],
      'RASdeleteDT' => date('Y-m-d H:i:s')
    );

    $this->db->where('RASid', $d['delRASid']);
    return $this->db->update('RAS', $data);
  }

  public function EditAccessories($d){
      $data = array(
        'RASdescTH' => $d['eRASdescTH'],
        'RASdescEN' => $d['eRASdescEN'],
        'RASquan' => $d['eRASquan'],
        'RASprice' => $d['eRASprice'],
        'RASwar' => $d['eRASwar'],
        'RASbrhid' => $d['eRASbrhid'],
        'RASeditedDT' => date('Y-m-d H:i:s')
      );
      $this->db->where('RASid', $d['eRASid']);
      return $this->db->update('RAS', $data);
  }

}