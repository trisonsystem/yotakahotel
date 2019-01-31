<?php

class RoomModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getRoomByid($id){
        
        if ($id == 0) {
            $sql = 'SELECT * FROM ROM WHERE ROMdelete = 0';
        } else {
            $sql = 'SELECT * FROM ROM WHERE ROMdelete = 0 AND ROMbrhid ='. $id;
        }
        
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $key => $value) {
                $row[$key]['branch'] = $this->branch($value['ROMbrhid']);      
            }

            foreach ($row as $nkey => $nvalue) {
                $row[$nkey]['nature'] = $this->roomNature($nvalue['ROMnature']);      
            }

            foreach ($row as $tkey => $tvalue) {
                $row[$tkey]['type'] = $this->roomType($tvalue['ROMtype']);      
            }

            foreach ($row as $akey => $avalue) {
                $row[$akey]['accessories'] = $this->accessories($avalue['ROMrasid']);      
            }

            return $row;
        } else {
            return $row = null;
        }
        
    }    

    public function branch($bid) {
        $sql = 'SELECT * FROM BRH WHERE BRHid =' . $bid;
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
      }

    public function roomNature($nid){
        $sql = 'SELECT USCcode, USCdescTH, USCdescEN FROM USC WHERE USCuse = 14 AND USCcode IN (' . $nid . ')';
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function roomType($tid){
        $sql = 'SELECT USCcode, USCdescTH, USCdescEN FROM USC WHERE USCuse = 21 AND USCcode IN (' . $tid . ')';
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function accessories($aid){
        $sql = 'SELECT * FROM RAS WHERE RASdelete = 0 AND RASid IN ('. $aid .')';
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function countRoomFromBarnch(){
        $sql = 'SELECT * FROM BRH WHERE BRHdelete = 0';
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $key => $value) {
                $row[$key]['rooms'] = $this->countRoom($value['BRHid']);      
            }

            return $row;
        } else {
            return $row = null;
        }
    }

    public function countRoom($bid){
        $sql = 'SELECT COUNT(ROMid) AS myRoom FROM ROM WHERE ROMbrhid = '. $bid;
        $query = $this->db->query($sql);
        $row = $query->row_array();
    
        return $row;
    }

    public function GetAccessories($id){
        $sql = 'SELECT * FROM RAS WHERE RASdelete = 0 AND RASbrhid = ' . $id;
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function chksumRooms($rno, $bid){
        $sql = 'SELECT COUNT(ROMno) AS myRoom FROM ROM WHERE ROMdelete = 0 AND ROMno = "'. $rno .'" AND ROMbrhid = ' . $bid;
        $query = $this->db->query($sql);
        $row = $query->row_array();
    
        return $row;
    }

    public function SaveRooms($d){
        return $this->db->insert('ROM', $d);
    }

    public function ShowbyidRooms($id){
        $sql = 'SELECT * FROM ROM WHERE ROMdelete = 0 AND ROMid =' . $id;
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $key => $value) {
                $row[$key]['branch'] = $this->branch($value['ROMbrhid']);      
            }

            foreach ($row as $nkey => $nvalue) {
                $row[$nkey]['nature'] = $this->roomNature($nvalue['ROMnature']);      
            }

            foreach ($row as $tkey => $tvalue) {
                $row[$tkey]['type'] = $this->roomType($tvalue['ROMtype']);      
            }

            foreach ($row as $akey => $avalue) {
                $row[$akey]['accessories'] = $this->accessories($avalue['ROMrasid']);      
            }

            return $row;
        } else {
            return $row = null;
        }
    }

    public function EditRoom($d){
        $data = array(
            'ROMno' => $d['eROMnum'],
            'ROMdescTH' => $d['eROMdescTH'],
            'ROMdescEN' => $d['eROMdescEN'],
            'ROMnature' => $d['eROMnature'],
            'ROMtype' => $d['eROMtype'],
            'ROMrasid' => $d['eROMrasid'],
            'ROMlimit' => $d['eROMlimit'],
            'ROMpice' => $d['eROMpice'],
            'ROMbrhid' => $d['eROMbrhid'],
            'ROMeditedDT' => date('Y-m-d H:i:s'),
        );
        
        $this->db->where('ROMid', $d['eROMid']);
        return $this->db->update('ROM', $data);
    }

    public function DeleteRoom($d){
        $data = array(
            'ROMdelete' => '1',
            'ROMdeleteBy' => $d['delROMperid'],
            'ROMactiveDT' => date('Y-m-d H:i:s')
          );
      
          $this->db->where('ROMid', $d['delROMid']);
          return $this->db->update('ROM', $data);
    }

}
