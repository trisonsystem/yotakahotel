<?php

class BookingusepageModel extends CI_Model
{

  public function __construct()
  {
    parent::__construct();

  }

  public function infoBookingUsePage()
  {
      $sql = 'SELECT
              PU03.PU03id,PU03.PU03brhid,PU03.PU03descTH,
              PU03.PU03descEN,PU03.PU03noteTH,PU03.PU03noteEN,PU03.PU03sta,
              PU03.PU03createdDT,PU03.PU03editedDT,PU03.PU03delete,
              PU03.PU03deleteBy,PU03.PU03deleteDT,BRH.BRHid,
              BRH.BRHcode,BRH.BRHdescTH,BRH.BRHdescEN,
              USC.USCcode,USC.USCdescTH,USC.USCdescEN
              FROM BRH INNER JOIN PU03 ON PU03.PU03brhid = BRH.BRHid
              INNER JOIN USC ON PU03.PU03sta = USC.USCcode WHERE
              PU03.PU03delete = 0 AND BRH.BRHdelete = 0 AND USC.USCuse = 27';

      $query = $this->db->query($sql);
      $row = $query->result_array();

      return $row;
  }

  public function SaveBeforeBookingUsePage($d, $select)
  {
    // debug($d);
    // exit();
    if ($select == 0) {
      $data = array(
        'PU03sta' => '1',
        'PU03editedDT' => date('Y-m-d H:i:s')
      );
      $this->db->where('PU03sta', '0');
      $this->db->where('PU03brhid', $d['PU03brhid']);
      $this->db->update('PU03', $data);
      return 'OK';

    }else {
      $data = array(
        'PU03sta' => '1',
        'PU03editedDT' => date('Y-m-d H:i:s')
      );
      $this->db->where('PU03sta', '0');
      $this->db->where('PU03brhid', $d['editPU03brhid']);
      $this->db->update('PU03', $data);

      $sdata = array(
        'PU03sta' => '0',
        'PU03editedDT' => date('Y-m-d H:i:s')
      );
      $this->db->where('PU03id', $d['editPU03id']);
      $this->db->update('PU03', $sdata);
    }

  }

  public function SaveBookingUsePage($d)
  {
      $data = array(
        'PU03brhid' => $d['PU03brhid'],
        'PU03descTH' => $d['PU03descTH'],
        'PU03descEN' => $d['PU03descEN'],
        'PU03noteTH' => $d['PU03noteTH'],
        'PU03noteEN' => $d['PU03noteEN'],
        'PU03sta' => '0',
        'PU03createdDT' => date('Y-m-d H:i:s'),
        'PU03editedDT' => date('Y-m-d H:i:s'),
        'PU03delete' => '0',
        'PU03deleteBy' => '00',
        'PU03deleteDT' => date('Y-m-d H:i:s')
      );

      // debug($data);
      // exit();
      return $this->db->insert('PU03', $data);
  }

  public function ShowbyidPageBooking($id){
    $sql = 'SELECT
            PU03.PU03id,PU03.PU03brhid,PU03.PU03descTH,
            PU03.PU03descEN,PU03.PU03noteTH,PU03.PU03noteEN,PU03.PU03sta,
            PU03.PU03createdDT,PU03.PU03editedDT,PU03.PU03delete,
            PU03.PU03deleteBy,PU03.PU03deleteDT,BRH.BRHid,
            BRH.BRHcode,BRH.BRHdescTH,BRH.BRHdescEN,
            USC.USCcode,USC.USCdescTH,USC.USCdescEN
            FROM BRH INNER JOIN PU03 ON PU03.PU03brhid = BRH.BRHid
            INNER JOIN USC ON PU03.PU03sta = USC.USCcode WHERE
            PU03.PU03delete = 0 AND BRH.BRHdelete = 0 AND USC.USCuse = 27
            AND PU03.PU03id = ' . $id;
    $query = $this->db->query($sql);
    $row = $query->row_array();

    return $row;
  }

  public function EditPageBooking($d){

    $data = array(
      'PU03brhid' => $d['editPU03brhid'],
      'PU03sta' => $d['editPU03sta'],
      'PU03descTH' => $d['editPU03descTH'],
      'PU03descEN' => $d['editPU03descEN'],
      'PU03noteTH' => $d['editPU03noteTH'],
      'PU03noteEN' => $d['editPU03noteEN']
    );

    $this->db->where('PU03id', $d['editPU03id']);
    return $this->db->update('PU03', $data);
  }

  public function ShowbyidBookingUsePage($id){
    $sql = 'SELECT
            PU03.PU03id,PU03.PU03brhid,PU03.PU03descTH,
            PU03.PU03descEN,PU03.PU03noteTH,PU03.PU03noteEN,PU03.PU03sta,
            PU03.PU03createdDT,PU03.PU03editedDT,PU03.PU03delete,
            PU03.PU03deleteBy,PU03.PU03deleteDT,BRH.BRHid,
            BRH.BRHcode,BRH.BRHdescTH,BRH.BRHdescEN,
            USC.USCcode,USC.USCdescTH,USC.USCdescEN
            FROM BRH INNER JOIN PU03 ON PU03.PU03brhid = BRH.BRHid
            INNER JOIN USC ON PU03.PU03sta = USC.USCcode WHERE
            PU03.PU03delete = 0 AND BRH.BRHdelete = 0 AND USC.USCuse = 27
            AND PU03.PU03id = ' . $id;
    $query = $this->db->query($sql);
    $row = $query->row_array();

    return $row;
  }

  public function DeleteBookingUsePage($d){

    $data = array(
      'PU03delete' => '1',
      'PU03deleteBy' => $d['delPU03perid'],
      'PU03deleteDT' => date('Y-m-d H:i:s')
    );

    $this->db->where('PU03id', $d['delPU03id']);
    return $this->db->update('PU03', $data);
  }

  public function DeleteBookingUsePageByGroup($d){
    $str = json_decode($d['chkmydel']);
    $x = implode(",",$str);
    $y = str_replace("1,", "", $x);
    $sql = 'UPDATE PU03 SET PU03delete = 1, PU03deleteBy = '.$d['psid'].' WHERE PU03id IN ('.$x.')';

    return $this->db->query($sql);
  }

  public function ShowAllMyContent(){
    $sql = 'SELECT
            BRH.BRHid,BRH.BRHcode,BRH.BRHdescTH,
            BRH.BRHdescEN,BRH.BRHadr,BRH.BRHpic,
            BRH.BRHzipc,BRH.BRHvnum,BRH.BRHbday,
            BRH.BRHemail,BRH.BRHnphone,BRH.BRHlocation,
            PU03.PU03id,PU03.PU03brhid,PU03.PU03descTH,
            PU03.PU03descEN,PU03.PU03noteTH,PU03.PU03noteEN,PU03.PU03sta
            FROM BRH INNER JOIN PU03 ON PU03.PU03brhid = BRH.BRHid
            WHERE PU03.PU03delete = 0 AND BRH.BRHdelete = 0 AND
            PU03.PU03sta = 0';
    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
      $row = $query->result_array();
      foreach ($row as $key => $value) {
        $row[$key]['pic'] = $this->picShowBookingPage($value['BRHid']);
      }
      return $row;
    }else {
      return $row = NULL;
    }
  }

  public function ShowAllMyContentByid($id){
    $sql = 'SELECT
            BRH.BRHid,BRH.BRHcode,BRH.BRHdescTH,
            BRH.BRHdescEN,BRH.BRHadr,BRH.BRHpic,
            BRH.BRHzipc,BRH.BRHvnum,BRH.BRHbday,
            BRH.BRHemail,BRH.BRHnphone,BRH.BRHlocation,
            PU03.PU03id,PU03.PU03brhid,PU03.PU03descTH,
            PU03.PU03descEN,PU03.PU03noteTH,PU03.PU03noteEN,PU03.PU03sta
            FROM BRH INNER JOIN PU03 ON PU03.PU03brhid = BRH.BRHid
            WHERE PU03.PU03delete = 0 AND BRH.BRHdelete = 0 AND
            PU03.PU03sta = 0 AND BRH.BRHid = ' . $id;
    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
      $row = $query->result_array();
      foreach ($row as $key => $value) {
        $row[$key]['pic'] = $this->picShowBookingPage($value['BRHid']);
      }
      return $row;
    }else {
      return $row = NULL;
    }
  }

  public function searchBookingPageBy($d){
    // debug($d);
    // exit();
    $sql = 'SELECT
            BRH.BRHid,BRH.BRHcode,BRH.BRHdescTH,
            BRH.BRHdescEN,BRH.BRHadr,BRH.BRHpic,
            BRH.BRHzipc,BRH.BRHvnum,BRH.BRHbday,
            BRH.BRHemail,BRH.BRHnphone,BRH.BRHlocation,
            PU03.PU03id,PU03.PU03brhid,PU03.PU03descTH,
            PU03.PU03descEN,PU03.PU03noteTH,PU03.PU03noteEN,PU03.PU03sta
            FROM BRH INNER JOIN PU03 ON PU03.PU03brhid = BRH.BRHid
            WHERE PU03.PU03delete = 0 AND BRH.BRHdelete = 0 AND
            PU03.PU03sta = 0 AND BRH.BRHid = ' . $d;

    $query = $this->db->query($sql);
    $num = $query->num_rows();
    if ($num > 0) {
      $row = $query->result_array();
      foreach ($row as $key => $value) {
        $row[$key]['pic'] = $this->picShowBookingPage($value['BRHid']);
      }
      return $row;
    }else {
      return $row = NULL;
    }
  }

  public function picShowBookingPage($bid){
    $sql = 'SELECT
            PIC.PICsid,PIC.PICname,PIC.PICnote
            FROM BRH INNER JOIN PU03 ON PU03.PU03brhid = BRH.BRHid
            INNER JOIN PIC ON BRH.BRHid = PIC.PICsid WHERE
            PU03.PU03delete = 0 AND BRH.BRHdelete = 0 AND
            PU03.PU03sta = 0 AND PIC.PICidtab = "103000" AND
            PIC.PICtype = 1 AND PIC.PICdelete = 0 AND PIC.PICsid = ' . $bid;

    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
  }



}
