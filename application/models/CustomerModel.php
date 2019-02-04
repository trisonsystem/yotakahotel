<?php

class CustomerModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->SystemControl = new SystemControl();
    }

    public function CustomerRegister($d) {
        $runid = $this->SystemControl->RunCode('CUS', '01');

        $data = array(
            'CUScode' => $runid,
            'CUSidc' => $d['CUSidc'],
            'CUStitle' => $d['CUStitle'],
            'CUSfname' => $d['CUSfname'],
            'CUSlname' => $d['CUSlname'],
            'CUSadr' => $d['CUSadr'],
            'CUSzipc' => '00',
            'CUSbday' => $d['CUSbday'],
            'CUSemail' => $d['CUSemail'],
            'CUSnphone' => $d['CUSnphone'],
            'CUStype' => '0',
            'CUSuname' => $d['CUSuname'],
            'CUSpawo' => getHashedPassword($d['CUSpawo']),
            'CUSbrhid' => '00',
            'CUScreatedBy' => '00',
            'CUScreatedDT' => date('Y-m-d H:i:s'),
            'CUSeditedDT' => date('Y-m-d H:i:s'),
            'CUSdelete' => '0',
            'CUSdeleteBy' => '00',
            'CUSdeleteDT' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('CUS', $data);
    }

    public function saveCustomer($d) {
        $runid = $this->SystemControl->RunCode('CUS', '01');
        // if ($d['CUSregonweb'] == 1) {
        //   $data = [];
        //   foreach ($d as $key => $value) {
        //     $data[$key] = $value;
        //   }
        // }else {
          $data = array(
              'CUScode' => $runid,
              'CUSidc' => $d['CUSidc'],
              'CUStitle' => $d['CUStitle'],
              'CUSregonweb' => '0',
              'CUSfname' => $d['CUSfname'],
              'CUSlname' => $d['CUSlname'],
              'CUSadr' => $d['CUSadr'],
              'CUSzipc' => $d['CUSzipc'],
              'CUSbday' => $d['CUSbday'],
              'CUSemail' => $d['CUSemail'],
              'CUSnphone' => $d['CUSnphone'],
              'CUStype' => $d['CUStype'],
              'CUSuname' => $d['CUSuname'],
              'CUSpawo' => getHashedPassword($d['CUSpawo']),
              'CUSbrhid' => $d['CUSbrhid'], //session
              'CUScreatedBy' => $d['CUScreatedBy'], //session
              'CUScreatedDT' => date('Y-m-d H:i:s'),
              'CUSeditedDT' => date('Y-m-d H:i:s'),
              'CUSdelete' => '0',
              'CUSdeleteBy' => '00',
              'CUSdeleteDT' => date('Y-m-d H:i:s')
          );
        // }
        
        return $this->db->insert('CUS', $data);
    }

    public function SeInfoCustomer() {
        $sql = "SELECT a.CUSid, a.CUScode , a.CUSidc, a.CUStitle, a.CUSfname, a.CUSlname, a.CUSadr, a.CUSzipc, a.CUSbday, a.CUSemail, a.CUSnphone, a.CUStype, a.CUSuname, a.CUSpawo, a.CUSbrhid,
                    a.CUScreatedBy, a.CUScreatedDT, a.CUSeditedDT, a.CUSdelete, a.CUSdeleteBy, a.CUSdeleteDT, b.USCcode AS TITLEcode, b.USCdescTH AS TITLEdescTH, b.USCdescEN AS TITLEdescEN,
                    c.USCcode AS TYPEcode, c.USCdescTH AS TYPEdescTH, c.USCdescEN AS TYPEdescEN
                    FROM ((`CUS` `a` LEFT JOIN `USC` `b` ON((`a`.`CUStitle` = `b`.`USCcode`))) LEFT JOIN `USC` `c` ON((`a`.`CUStype` = `c`.`USCcode`)))
                    WHERE ((`b`.`USCuse` = '13') AND (`c`.`USCuse` = '11')) AND a.CUSdelete = 0";
        $query = $this->db->query($sql);
        $row = $row = $query->result_array();

        return $row;
    }

    public function ShowbyidCustomer($id) {
        $sql = 'SELECT * FROM CUS WHERE CUSid = ' . $id;
        $query = $this->db->query($sql);
        $row = $query->result_array();

        return $row;
    }

    public function ShowbyidcardCustomer($idc) {
        $sql = 'SELECT CUSid, CUSidc, CUSfname, CUSlname, CUSadr, CUSzipc, CUSemail, CUSnphone, CUSpic FROM CUS WHERE CUSidc = "' . $idc . '"';
        $query = $this->db->query($sql);
        $row = $query->row_array();

        return $row;
    }

    public function EditCustomer($d) {

        $data = array(
            'CUSidc' => $d['editCUSidc'],
            'CUStitle' => $d['editCUStitle'],
            'CUSfname' => $d['editCUSfname'],
            'CUSlname' => $d['editCUSlname'],
            'CUSadr' => $d['editCUSadr'],
            'CUSzipc' => $d['editCUSzipc'],
            'CUSbday' => $d['editCUSbday'],
            'CUSemail' => $d['editCUSemail'],
            'CUSnphone' => $d['editCUSnphone'],
            'CUSpic' => $d['pic'],
            'CUStype' => $d['editCUStype'],
            'CUSbrhid' => $d['editCUSbrhid'], //session,
            'CUSeditedDT' => date('Y-m-d H:i:s')
        );

        $this->db->where('CUSid', $d['editCUSid']);
        return $this->db->update('CUS', $data);
    }

    public function DeleteCustomer($d){

        $data = array(
            'CUSdelete' => '1',
            'CUSdeleteBy' => $d['delPERid'],
            'CUSdeleteDT' => date('Y-m-d H:i:s')
        );

        $this->db->where('CUSid', $d['delCUSid']);
        return $this->db->update('CUS', $data);
    }

    public function DeleteCustomerByGroup($d){

        $str = json_decode($d['chkmydel']);
        $x = implode(",",$str);
        $y = str_replace("1,", "", $x);
        $sql = 'UPDATE CUS SET CUSdelete = 1, CUSdeleteBy = '.$d['psid'].' WHERE CUSid IN ('.$x.')';

        return $this->db->query($sql);
    }

}
