<?php

class PictureModel extends CI_MOdel
{

  function __construct()
  {
    parent::__construct();
    $this->SystemControl = new SystemControl();

  }

  public function infoPictureBranch()
  {
      $sql = 'SELECT
              PIC.PICid, PIC.PICidtab, PIC.PICsid,
              BRH.BRHcode, BRH.BRHdescTH, BRH.BRHdescEN,
              PIC.PICtype, PIC.PICname, PIC.PICnote, PIC.PICcreatedDT,
              PIC.PICeditedDT
              FROM BRH INNER JOIN PIC ON PIC.PICsid = BRH.BRHid
              WHERE PIC.PICidtab = "103000" AND PIC.PICdelete = 0
              AND PIC.PICtype = 1';
      $query = $this->db->query($sql);
      $row = $query->result_array();

      return $row;
  }

  public function SaveBranch($d)
  {

      $data = array(
        'PICidtab' => '103000',
        'PICsid' => $d['PICsid'],
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

  public function ShowbyidPicture($id)
  {
      $sql = 'SELECT
              PIC.PICid, PIC.PICidtab, PIC.PICsid,
              BRH.BRHcode, BRH.BRHdescTH, BRH.BRHdescEN,
              PIC.PICtype, PIC.PICname, PIC.PICnote, PIC.PICcreatedDT,
              PIC.PICeditedDT
              FROM BRH INNER JOIN PIC ON PIC.PICsid = BRH.BRHid
              WHERE PIC.PICidtab = "103000" AND PIC.PICdelete = 0
              AND PIC.PICtype = 1 AND PIC.PICid = ' . $id;
      $query = $this->db->query($sql);
      $row = $query->row_array();

      return $row;
  }

  
  public function EditPicture($d)
  {
      $this->db->where('PICid', $d['PICid']);
      return $this->db->update('PIC', $d);
  }

  public function DeletePicture($d)
  {
      $data = array(
        'PICdelete' => '1',
        'PICdeleteBy' => $d['delPICperid'],
        'PICdeleteDT' => date('Y-m-d H:i:s')
      );

      $this->db->where('PICid', $d['delPICid']);
      return $this->db->update('PIC', $data);
  }

  public function DeletePictureByGroup($d)
  {
    $str = json_decode($d['chkmydel']);
    $x = implode(",",$str);
    $y = str_replace("1,", "", $x);
    $sql = 'UPDATE PIC SET PICdelete = 1, PICdeleteBy = '.$d['psid'].' WHERE PICid IN ('.$x.')';

    return $this->db->query($sql);
  }

}
