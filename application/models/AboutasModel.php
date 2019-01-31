<?php

class AboutasModel extends CI_Model{

  public function __construct()
  {
    parent::__construct();

  }

  public function SaveAboutas($d){

    $data = array(
      'PU01titleTH' => $d['PU01titleTH'],
      'PU01titleEN' => $d['PU01titleEN'],
      'PU01descTH' => $d['PU01descTH'],
      'PU01descEN' => $d['PU01descEN'],
      'PU01youtube' => $d['PU01youtube'],
      'PU01facebook' => $d['PU01facebook'],
      'PU01line' => $d['PU01line'],
      'PU01twitter' => $d['PU01twitter'],
      'PU01createdDT' => date('Y-m-d H:i:s'),
      'PU01editedDT' => date('Y-m-d H:i:s'),
      'PU01delete' => '0',
      'PU01deleteBy' => '00',
      'PU01deleteDT' => date('Y-m-d H:i:s')
    );

    $this->db->insert('PU01', $data);
    $pid = $this->db->insert_id();

    $pic = array(
      'PU01id' => $pid,
      'pname' => $d['PICpic']
    );

    return $this->savePicture($pic);
  }

  public function savePicture($d){

    $data = array(
      'PICidtab' => '980002',
      'PICsid' => $d['PU01id'],
      'PICtype' => '1',
      'PICname' => $d['pname'],
      'PICnote' => '',
      'PICcreatedDT' => date('Y-m-d H:i:s'),
      'PICeditedDT' => date('Y-m-d H:i:s'),
      'PICdelete' => '0',
      'PICdeleteBy' => '00',
      'PICdeleteDT' => date('Y-m-d H:i:s')
    );

    return $this->db->insert('PIC', $data);
  }

  public function infoAboutas(){
    $sql = 'SELECT * FROM PU01 WHERE PU01delete = 0';

    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
      $row = $query->result_array();
      foreach ($row as $key => $value) {
        $row[$key]['pic'] = $this->picShowOnPage($value['PU01id']);
      }
      return $row;
    }else {
      return $row = NULL;
    }
  }

  public function beginShowAbout(){
    $sql = 'SELECT * FROM PU01 WHERE PU01.PU01delete = 0 ORDER BY PU01.PU01createdDT DESC LIMIT 1';

    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
      $row = $query->result_array();
      foreach ($row as $key => $value) {
        $row[$key]['pic'] = $this->picShowOnPage($value['PU01id']);
      }
      return $row;
    }else {
      return $row = NULL;
    }
  }

  public function beginShowAboutByID($id){
    $sql = 'SELECT * FROM PU01 WHERE PU01.PU01delete = 0 AND PU01.PU01id = '.$id.' ORDER BY PU01.PU01createdDT DESC LIMIT 1';

    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
      $row = $query->result_array();
      foreach ($row as $key => $value) {
        $row[$key]['pic'] = $this->picShowOnPage($value['PU01id']);
      }
      return $row;
    }else {
      return $row = NULL;
    }
  }

  public function picShowOnPage($id){
    $sql = 'SELECT * FROM PIC WHERE PIC.PICidtab = "980002"
            AND PIC.PICdelete = 0 AND PIC.PICsid = ' . $id;

    $query = $this->db->query($sql);
    $row = $query->row_array();

    return $row;
  }

  public function DeleteAboutasByGroup($d){
    $str = json_decode($d['chkmydel']);
    $x = implode(",",$str);
    $y = str_replace("1,", "", $x);
    $sql = 'UPDATE PU01 SET PU01delete = 1, PU01deleteBy = '.$d['psid'].' WHERE PU01id IN ('.$x.')';

    return $this->db->query($sql);
  }

  public function ShowbyidAboutas($id){
    $sql = 'SELECT * FROM PU01 WHERE PU01delete = 0 AND PU01id ='.$id;

    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
      $row = $query->row_array();

      foreach ($row as $key => $value) {
        $row['pic'] = $this->picShowOnPage($id);
      }
      return $row;
    }else {
      return $row = NULL;
    }
  }

  public function EditAboutas($d){

    $data = array(
      'PU01titleTH' => $d['editPU01titleTH'],
      'PU01titleEN' => $d['editPU01titleEN'],
      'PU01descTH' => $d['editPU01descTH'],
      'PU01descEN' => $d['editPU01descEN'],
      'PU01youtube' => $d['editPU01youtube'],
      'PU01facebook' => $d['editPU01facebook'],
      'PU01line' => $d['editPU01line'],
      'PU01twitter' => $d['editPU01twitter'],
      'PU01editedDT' => date('Y-m-d H:i:s')
    );

    $this->db->where('PU01id', $d['editPU01id']);
    $this->db->update('PU01', $data);
    return $this->EditAboutaspid($d['xpic']);
  }

  public function EditAboutaspid($d){

    $data = array(
      'PICname' => $d['PICname'],
      'PICeditedDT' => date('Y-m-d H:i:s')
    );

    $this->db->where('PICid', $d['PICid']);
    return $this->db->update('PIC', $data);
  }

  public function DeleteAboutas($d){
    $data = array(
      'PU01delete' => '1',
      'PU01deleteBy' => $d['delPICperid'],
      'PU01deleteDT' => date('Y-m-d H:i:s')
    );
    $this->db->where('PU01id', $d['delPU01id']);
    $this->db->update('PU01', $data);
    return $this->DeleteAboutasPicbyid($d);
  }

  public function DeleteAboutasPicbyid($d){
    $data = array(
      'PICdelete' => '1',
      'PICdeleteBy' => $d['delPICperid'],
      'PICdeleteDT' => date('Y-m-d H:i:s')
    );
    $this->db->where('PICid', $d['delPICid']);
    return $this->db->update('PIC', $data);
  }

  public function MenuInAbout(){
    $sql = 'SELECT PU01.PU01id,PU01.PU01createdDT, PU01.PU01titleTH, PU01.PU01titleEN
            FROM PU01 WHERE PU01.PU01delete = 0
            ORDER BY PU01.PU01createdDT LIMIT 15';

    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
  }

}
