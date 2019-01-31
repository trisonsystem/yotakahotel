<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SystemModel extends CI_Model {

    function Usecase($USCuse) {
        $this->db->select('USCcode, USCdescEN, USCdescTH');
        $this->db->from('USC');
        $this->db->where('USCuse', $USCuse);
        $query = $this->db->get();
        $usecase = $query->result_array();
        if ($query->num_rows() > 0) {
            return $usecase;
        } else {
            return array();
        }
    }

    function DefaultUsecase($USCuse, $USCcode) {
        $this->db->select('USCcode, USCdescEN, USCdescTH');
        $this->db->from('USC');
        $this->db->where('USCuse', $USCuse);
        $this->db->where('USCcode', $USCcode);
        $query = $this->db->get();
        $usecase = $query->row_array();
        if ($query->num_rows() > 0) {
            return $usecase;
        } else {
            return array();
        }
    }

    function CheckSumCUS($username) {
        $this->db->select('CUSuname, 101000 as TABid');
        $this->db->from('CUS');
        $this->db->where('CUSuname', $username);
        $this->db->where('CUSdelete', 0);
        $query = $this->db->get();
        $cusRow = $query->num_rows();

        return $cusRow;
    }

    function CheckSumEmailPER($email) {
        $this->db->select('CUSemail, 101000 as TABid');
        $this->db->from('CUS');
        $this->db->where('CUSemail', $email);
        $this->db->where('CUSdelete', 0);
        $query = $this->db->get();
        $cusRow = $query->num_rows();

        return $cusRow;
    }

    function CheckSumPER($username) {
        $this->db->select('PERuname, 102000 as TABid');
        $this->db->from('PER');
        $this->db->where('PERuname', $username);
        $this->db->where('PERdelete', 0);
        $query = $this->db->get();
        $perRow = $query->num_rows();

        return $perRow;
    }

    function CheckSumPassIdcCUS($idc, $cid) {
        $this->db->select('CUSidc, 101000 as TABid');
        $this->db->from('CUS');
        $this->db->where('CUSidc', $idc);
        $this->db->where_not_in('CUSid', $cid);
        $this->db->where('CUSdelete', 0);
        $query = $this->db->get();
        $cusRow = $query->num_rows();

        return $cusRow;
    }

    function CheckSumRoom($branchid, $roomnumber) {
        $this->db->select('ROMno, ROMbrhid, 104000 as TABid');
        $this->db->from('ROM');
        $this->db->where('ROMno', $roomnumber);
        $this->db->where('ROMbrhid', $branchid);
        $query = $this->db->get();

        $roomRow = $query->num_rows();
        return $roomRow;
    }

    function CheckTotalRoom() {
        $this->db->select('ROMno, ROMbrhid, 104000 as TABid');
        $this->db->from('ROM');
        $query = $this->db->get();

        $roomRow = $query->num_rows();
        return $roomRow;
    }



    function MaxDateTime($tb) {
//        $this->db->select_max($tb.'editedDT');
//        $query = $this->db->get('$tb');

        $sql = "SELECT max(" . $tb . 'editedDT' . ") as vnum FROM " . $tb;
        $que_sb = $this->db->query($sql);
        $r = $que_sb->row_array();
        $vn = $r['vnum'];

        return $vn;
    }

    function MaxDateTimeWhere($tb, $dwh){

      switch ($dwh) {
        case 1:
          $wstr = 'WHERE PICidtab = "103000" AND PICdelete = 0 AND PICtype = 1';
          break;

        default:
          $wstr = '';
          break;
      }

      if($wstr != ''){
        $sql = "SELECT max(" . $tb . 'editedDT' . ") as vnum FROM " . $tb . ' ' . $wstr;
        $que_sb = $this->db->query($sql);
        $r = $que_sb->row_array();
        $vn = $r['vnum'];
        return $vn;
      }else {
        return null;
      }

    }

    function LastMyStatus($id, $tb){
      $sql = 'SELECT ' . $tb . 'sta FROM ' . $tb . ' WHERE PU03id = ' . $id;

      $query = $this->db->query($sql);
      $status = $query->row_array();
      return $status['PU03sta'];
    }



}
