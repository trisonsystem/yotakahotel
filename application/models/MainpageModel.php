<?php

class MainpageModel extends CI_Model{
  public function __construct() {
      parent::__construct();
      $this->SystemControl = new SystemControl();
  }

  public function InfoSlide(){
    $sql = 'SELECT PIC.*, USC.USCdescTH, USC.USCdescEN FROM PIC INNER JOIN USC ON PIC.PICdelete = USC.USCcode
            WHERE PIC.PICidtab = "980004" AND PIC.PICtype = 1
            AND USC.USCuse = 10  AND PIC.PICdelete = 0';

    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
  }

  public function xInfoSlide(){
    $sql = 'SELECT PIC.*, USC.USCdescTH, USC.USCdescEN FROM PIC INNER JOIN USC ON PIC.PICdelete = USC.USCcode
            WHERE PIC.PICidtab = "980004" AND PIC.PICdelete = 0 AND PIC.PICtype = 1
            AND USC.USCuse = 10';

    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
  }

  public function showSlide(){
    $sql = 'SELECT * FROM PIC WHERE PIC.PICidtab = "980004" AND PIC.PICtype = 1 AND PIC.PICdelete = 0';

    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
  }

  public function slDelete($d){
    $data = array(
      'PICdelete' => '1',
      'PICdeleteBy' => $d['PICdeleteBy'],
      'PICdeleteDT' => date('Y-m-d H:i:s')
    );

    $this->db->where('PICid', $d['id']);
    return $this->db->update('PIC', $data);
  }

  public function slUndo($d){
    $data = array(
      'PICdelete' => '0',
      'PICdeleteBy' => $d['PICdeleteBy'],
      'PICdeleteDT' => date('Y-m-d H:i:s')
    );
    
    $this->db->where('PICid', $d['id']);
    return $this->db->update('PIC', $data);
  }

  public function saveSlideShow($d){
    $data = array(
      'PICidtab' => '980004',
      'PICsid' => '0',
      'PICtype' => '1',
      'PICname' => $d['PICpic'],
      'PICnote' => $d['PICnote'],
      'PICcreatedDT' => date('Y-m-d H:i:s'),
      'PICeditedDT' => date('Y-m-d H:i:s'),
      'PICdelete' => '0',
      'PICdeleteBy' => $d['PICperid'],
      'PICdeleteDT' => date('Y-m-d H:i:s')
    );

    return $this->db->insert('PIC', $data);
  }

  public function filterRoomByBranch($id){
    // $sql = 'SELECT * FROM ROM  WHERE (ROMid NOT IN (SELECT BOKromid FROM BOK)) AND ROMdelete = 0 ';
    $sql = 'SELECT ROMnature, COUNT(ROMnature) AS countROMnature, USCcode, USCdescTH, USCdescEN FROM ROM LEFT JOIN USC ON ROM.ROMnature = USC.USCcode  WHERE (ROMid NOT IN (SELECT BOKromid FROM BOK)) AND ROMdelete = 0 AND ROMbrhid = ' . $id .' AND USCuse = 14 GROUP BY ROMnature ';

    $query = $this->db->query($sql);
    $num = $query->num_rows();

    if ($num > 0) {
        $row = $query->result_array();

        return $row;
    } else {
        return $row = null;
    }
  }

}

?>
