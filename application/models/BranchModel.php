<?php

class BranchModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->SystemControl = new SystemControl();
    }

    public function SeInfoBranch() {
        $sql = 'SELECT * FROM BRH WHERE BRHdelete = 0';
        $query = $this->db->query($sql);
        $row = $row = $query->result_array();

        return $row;
    }

    public function ShowbyidBranch($id) {
        $sql = 'SELECT * FROM BRH WHERE BRHid = ' . $id;
        $query = $this->db->query($sql);
        $row = $query->row();

        return $row;
    }

    public function aShowbyidBranch($id) {
        $sql = 'SELECT * FROM BRH WHERE BRHid = ' . $id;
        $query = $this->db->query($sql);
        $row = $query->row_array();

        return $row;
    }
    
    public function RegisterBranch($d) {
        $runid = $this->SystemControl->RunCode('BRH', '00');

        $data = array(
            'BRHcode' => $runid,
            'BRHdescTH' => $d['BRHdescTH'],
            'BRHdescEN' => $d['BRHdescEN'],
            'BRHadr' => $d['BRHadr'],
            'BRHpic' => $d['BRHpic'],
            'BRHzipc' => $d['BRHzipc'],
            'BRHvnum' => $d['BRHvnum'],
            'BRHbday' => $d['BRHbday'],
            'BRHemail' => $d['BRHemail'],
            'BRHnphone' => $d['BRHnphone'],
            'BRHcreatedDT' => date('Y-m-d H:i:s'),
            'BRHeditedDT' => date('Y-m-d H:i:s'),
            'BRHdelete' => '0',
            'BRHdeleteBy' => '00',
            'BRHdeleteDT' => date('Y-m-d H:i:s')
        );
        
        $this->db->insert('BRH', $data);
        return $this->db->insert_id();
    }

    public function EditBranch($d) {

        $data = array(
            'BRHid' => $d['BRHid'],
            // 'BRHcode' => $d['BRHcode'],
            'BRHdescTH' => $d['BRHdescTH'],
            'BRHdescEN' => $d['BRHdescEN'],
            'BRHadr' => $d['BRHadr'],
            // 'BRHpic' => $d['BRHpic'],
            'BRHzipc' => $d['BRHzipc'],
            'BRHvnum' => $d['BRHvnum'],
            'BRHbday' => $d['BRHbday'],
            'BRHemail' => $d['BRHemail'],
            'BRHnphone' => $d['BRHnphone'],
            'BRHeditedDT' => date('Y-m-d H:i:s')
        );

        $this->db->where('BRHid', $data['BRHid']);
        return $this->db->update('BRH', $data);
    }

    public function DeleteBranch($d){
        // debug($d);
        // exit();
        $data = array(
            'BRHdelete' => '1',
            'BRHdeleteBy' => $d['delPERid']
        );

        $this->db->where('BRHid', $d['BRHid']);
        return $this->db->update('BRH', $data);
    }

    public function DeleteBranchByGroup($d){

        $str = json_decode($d['chkmydel']);
        $x = implode(",",$str);
        $y = str_replace("1,", "", $x);
        $sql = 'UPDATE BRH SET BRHdelete = 1, BRHdeleteBy = '.$d['psid'].' WHERE BRHid IN ('.$y.')';

        return $this->db->query($sql);
    }



}
