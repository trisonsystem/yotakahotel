<?php 

class PersonnelModel extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function infoPersonnelModel(){
      $sql = 'SELECT * FROM PER WHERE PERdelete = 0';

      $query = $this->db->query($sql);
      $num = $query->num_rows();
      if ($num > 0) {
        $row = $query->result_array();
        foreach ($row as $key => $value) {        
          $row[$key]['branchName'] = $this->personnelBranch($value['PERbrhid']);        
        }
        return $row;
      }else {
        return $row = NULL;
      }
    }

    public function personnelBranch($id) {
        $sql = 'SELECT * FROM BRH WHERE BRHid IN (' . $id . ')';
        $query = $this->db->query($sql);
        $row = $query->row_array();
    
        return $row;
      }

    public function FilterDepartment($id){
        $sql = 'SELECT * FROM DPO WHERE DPOdepid = ' . $id;
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function SavePersonnel($d){
      $runid = $this->SystemControl->RunCode('PER', '01');

      $data = array(
        'PERcode' => $runid,
        'PERidc' => $d['PERidc'],
        'PERtitle' => $d['PERtitle'],
        'PERfname' => $d['PERfname'],
        'PERlname' => $d['PERlname'],
        'PERdepid' => $d['PERdepid'],
        'PERadr' => $d['PERadr'],
        'PERbday' => $d['PERbday'],
        'PERemail' => $d['PERemail'],
        'PERnphone' => $d['PERnphone'],
        'PERlevel' => $d['PERlevel'],
        'PERuname' => $d['PERuname'],
        'PERpawo' => getHashedPassword($d['PERpawo']),
        'PERbrhid' => $d['PERbrhid'],
        'PERcreatedDT' => date('Y-m-d H:i:s'),
        'PEReditedDT' => date('Y-m-d H:i:s'),
        'PERdelete' => 0,
        'PERdeleteBy' => $d['PERses'],
        'PERdeleteDT' => date('Y-m-d H:i:s')
      );

      return $this->db->insert('PER', $data);

    }

    public function DeletePersonnelByGroup($d){
      $str = json_decode($d['chkmydel']);
      $x = implode(",",$str);
      $y = str_replace("1,", "", $x);
      $sql = 'UPDATE PER SET PERdelete = 1, PERdeleteBy = '.$d['psid'].' WHERE PERid IN ('.$x.')';
      
      return $this->db->query($sql);
    }

    public function ShowbyidPersonnel($id){
      $sql = 'SELECT * FROM PER WHERE PERdelete = 0 AND PERid =' . $id;
      $query = $this->db->query($sql);
      $num = $query->num_rows();
      if ($num > 0) {
        $row = $query->result_array();
        foreach ($row as $key => $value) {        
          $row[$key]['titleName'] = $this->titleName($value['PERtitle']);        
        }
        foreach ($row as $key => $value) {        
          $row[$key]['department'] = $this->department($value['PERdepid']);        
        }
        foreach ($row as $key => $value) {        
          $row[$key]['position'] = $this->position($value['PERlevel']);        
        }
        return $row;
      }else {
        return $row = NULL;
      }
    }

    public function titleName($id){
      $sql = 'SELECT * FROM USC WHERE USCuse = 13  AND USCcode = ' . $id;

      $query = $this->db->query($sql);
      $row = $query->row_array();
  
      return $row;
    }

    public function department($id){
      $sql = 'SELECT * FROM DEP WHERE DEPid = ' . $id;

      $query = $this->db->query($sql);
      $row = $query->row_array();
  
      return $row;
    }

    public function position($id){
      $sql = 'SELECT * FROM DPO WHERE DPOid = ' . $id;

      $query = $this->db->query($sql);
      $row = $query->row_array();
  
      return $row;
    }

    public function EditPersonnel($d){
      $data = array(
        'PERidc' => $d['ePERidc'],
        'PERtitle' => $d['ePERtitle'],
        'PERfname' => $d['ePERfname'],
        'PERlname' => $d['ePERlname'],
        'PERdepid' => $d['ePERdepid'],
        'PERadr' => $d['ePERadr'],
        'PERbday' => $d['ePERbday'],
        'PERemail' => $d['ePERemail'],
        'PERnphone' => $d['ePERnphone'],
        'PERbrhid' => $d['ePERbrhid'],
        'PEReditedDT' => date('Y-m-d H:i:s')
      );

      $this->db->where('PERid', $d['ePERid']);
      return $this->db->update('PER', $data);
    }

    public function ShowbyidPromotion($id){
      $sql = 'SELECT * FROM PER WHERE PERdelete = 0 AND PERid = ' . $id;
  
      $query = $this->db->query($sql);
      $num = $query->num_rows();
      if ($num > 0) {
        $row = $query->result_array();
        foreach ($row as $key => $value) {        
          $row[$key]['titleName'] = $this->titleName($value['PERtitle']);        
        }
        foreach ($row as $key => $value) {        
          $row[$key]['department'] = $this->department($value['PERdepid']);        
        }
        foreach ($row as $key => $value) {        
          $row[$key]['position'] = $this->position($value['PERlevel']);        
        }
        return $row;
      }else {
        return $row = NULL;
      }
    }

    public function DeletePersonnel($d){
      
      $data = array(
        'PERdelete' => '1',
        'PERdeleteBy' => $d['delPERperid'],
        'PERdeleteDT' => date('Y-m-d H:i:s')
      );
  
      $this->db->where('PERid', $d['delPERid']);
      return $this->db->update('PER', $data);
    }
}