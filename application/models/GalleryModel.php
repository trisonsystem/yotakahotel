<?php

class GalleryModel extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function SaveImgGroup($d){

    $data = array(
      'PU04brhid' => $d['PU04brhid'],
      'PU04descTH' => $d['PU04descTH'],
      'PU04descEN' => $d['PU04descEN'],
      'PU04note' => $d['PU04note'],
      'PU04createdDT' => date('Y-m-d H:i:s'),
      'PU04editedDT' => date('Y-m-d H:i:s'),
      'PU04delete' => '0',
      'PU04deleteBy' => '00',
      'PU04deleteDT' => date('Y-m-d H:i:s'),
    );

    return $this->db->insert('PU04', $data);
  }

  public function ShowGroupByImg($id){
    $sql = 'SELECT * FROM PU04 WHERE PU04delete = 0 AND PU04brhid =' . $id;

    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
  }

  public function SaveImg($d){

    $data = array(
      'PICidtab' => '980003',
      'PICsid' => $d['PICsid'],
      'PICtype' => '1',
      'PICname' => $d['PICpic'],
      'PICnote' => $d['PICnote'],
      'PICcreatedDT' => date('Y-m-d H:i:s'),
      'PICeditedDT' => date('Y-m-d H:i:s'),
      'PICdelete' => '0',
      'PICdeleteBy' => '00',
      'PICdeleteDT' => date('Y-m-d H:i:s')
    );

    return $this->db->insert('PIC', $data);
  }

  public function infoGallery(){
    $sql = 'SELECT * FROM PU04 WHERE PU04delete = 0';

    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
      $row = $query->result_array();
      foreach ($row as $key => $value) {
        $row[$key]['pic'] = $this->joinPIC($value['PU04id']);
        $row[$key]['brh'] = $this->joinBRH($value['PU04brhid']);
      }
      return $row;
    }else {
      return $row = NULL;
    }
    return $row;
  }

  public function joinPIC($id){
    $sql = 'SELECT * FROM PIC WHERE PIC.PICidtab = "980003"
            AND PIC.PICdelete = 0 AND PIC.PICsid = ' . $id;
    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
  }

  public function joinBRH($id){
    $sql = 'SELECT BRHid, BRHdescTH, BRHdescEN FROM BRH WHERE BRHid =' . $id;
    $query = $this->db->query($sql);
    $row = $query->row_array();

    return $row;
  }

  public function DeleteGalleryPageByGroup($d){
    $str = json_decode($d['chkmydel']);
    $x = implode(",",$str);
    $y = str_replace("1,", "", $x);
    $sql = 'UPDATE PU04 SET PU04delete = 1, PU04deleteBy = '.$d['psid'].' WHERE PU04id IN ('.$x.')';

    return $this->db->query($sql);
  }

  public function ShowbyidGalleryUsePage($id){
    $sql = 'SELECT * FROM PU04 WHERE PU04delete = 0 AND PU04id ='.$id;

    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
      $row = $query->result_array();
      foreach ($row as $key => $value) {
        $row[$key]['pic'] = $this->joinPIC($value['PU04id']);
        $row[$key]['brh'] = $this->joinBRH($value['PU04brhid']);
      }
      return $row;
    }else {
      return $row = NULL;
    }
    return $row;
  }

  public function DeleteGallery($d){
    debug($d);
    $data = array(
      'PU04delete' => '1',
      'PU04deleteBy' => $d['delPU04perid'],
      'PU04deleteDT' => date('Y-m-d H:i:s')
    );
    $this->db->where('PU04id', $d['delPU04id']);
    $this->db->update('PU04', $data);
    return $this->DeletePIC($d);
  }

  public function DeletePIC($d){
    $data = array(
      'PICdelete' => '1',
      'PICdeleteBy' => $d['delPU04perid'],
      'PICdeleteDT' => date('Y-m-d H:i:s')
    );
    $this->db->where('PICsid', $d['delPU04id']);
    $this->db->where('PICidtab', '980003');
    return $this->db->update('PIC', $data);
  }

  public function EditGallery($d){

    $data = array(
      'PU04descTH' => $d['editPU04descTH'],
      'PU04descEN' => $d['editPU04descEN'],
      'PU04note' => $d['editPU04note'],
      'PU04editedDT' => date('Y-m-d H:i:s')
    );

    $this->db->where('PU04id', $d['editPU04id']);
    return $this->db->update('PU04', $data);
  }

  public function DeleteImgGalleryp($id){
    $data = array(
      'PICdelete' => '1',
      'PICdeleteBy' => $d['delPU04perid'],
      'PICdeleteDT' => date('Y-m-d H:i:s')
    );
    $this->db->where('PICid', $id);
    $this->db->where('PICidtab', '980003');
    return $this->db->update('PIC', $data);
  }

  public function DebugeleteGroupPicGallery($d){
    $data = array(
      'PICdelete' => 1,
      'PICdeleteBy' => $d['gdelPU04perid'],
      'PICdeleteDT' => date('Y-m-d H:i:s')
    );

    $this->db->where('PICsid', $d['gdelPU04id']);
    $this->db->where('PICidtab', '980003');
    return $this->db->update('PIC', $data);
  }

  public function showGalleryByBranch(){
    $sql = 'SELECT BRH.BRHid, BRH.BRHdescTH, BRH.BRHdescEN FROM BRH WHERE BRH.BRHdelete = 0';
    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
      $row = $query->result_array();
      foreach ($row as $key => $value) {
        $row[$key]['pu04'] = $this->joinPU04($value['BRHid']);
        $row[$key]['pic'] = $this->joinPICbyBranch($value['BRHid']);
      }
      return $row;
    }else {
      return $row = NULL;
    }
    return $row;
  }

  public function joinPU04($id){
    $sql = 'SELECT * FROM PU04 WHERE PU04delete = 0 AND PU04brhid =' . $id;
    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
  }

  public function joinPICbyBranch($id){
    $sql = 'SELECT PU04.PU04id, PU04.PU04brhid, PU04.PU04descTH, PU04.PU04descEN, PIC.PICid, PIC.PICname, PIC.PICnote
            FROM PU04 INNER JOIN PIC ON PU04.PU04id = PIC.PICsid
            WHERE PIC.PICidtab = "980003" AND PIC.PICdelete = 0 AND PU04.PU04delete = 0 AND
            PU04.PU04brhid =' . $id;
    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
  }


}
