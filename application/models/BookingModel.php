<?php 

class BookingModel extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRoomsByBranchID($id){
        $sql = 'SELECT * FROM ROM WHERE ROMdelete = 0 AND ROMbrhid = ' . $id;
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

            foreach ($row as $akey => $rvalue) {
                $row[$akey]['roomstatus'] = $this->RoomStatus($rvalue['ROMbrhid'], $rvalue['ROMid']);      
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

    public function RoomStatus($bid, $rid){
        $sql = 'SELECT BOKid, BOKsta, BOKcusid FROM BOK WHERE BOKdelete = 0 AND BOKbrhid = ' . $bid .' AND BOKromid = ' . $rid . ' ORDER BY BOKid DESC';
        $query = $this->db->query($sql);
        $num = $query->num_rows();
        if ($num > 0) {
            $row = $query->row_array();
            $row['customer'] = $this->Customer($row['BOKcusid']);      
            return $row;
        }else{
            return null;
        }
    }

    public function accessories($aid){        
        $sql = 'SELECT * FROM RAS WHERE RASdelete = 0 AND RASid IN ('. $aid .')';
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function GetRoomByID($id){
        $sql = 'SELECT * FROM ROM WHERE ROMdelete = 0 AND ROMid = ' . $id;
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

    public function getBookingByBranchID($id){
        $sql = 'SELECT * FROM BOK WHERE BOKdelete = 0 AND BOKsta != 4 AND BOKbrhid = ' . $id;

        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $key => $value) {
                $row[$key]['BookingFrom'] = $this->BookingFrom($value['BOKfrom']);      
            }

            foreach ($row as $key => $value) {
                $row[$key]['Promotion'] = $this->Promotion($value['BOKpomid']);      
            }

            foreach ($row as $key => $value) {
                $row[$key]['Room'] = $this->GetRoomByID($value['BOKromid']);      
            }

            foreach ($row as $key => $value) {
                $row[$key]['Customer'] = $this->Customer($value['BOKcusid']);      
            }

            foreach ($row as $key => $value) {
                $row[$key]['Status'] = $this->BookingStatus($value['BOKsta']);      
            }

            return $row;
        } else {
            return $row = null;
        }
    }

    public function BookingFrom($id){
        $sql = 'SELECT * FROM USC WHERE USCuse = 16  AND USCcode = ' . $id;
  
        $query = $this->db->query($sql);
        $row = $query->row_array();
    
        return $row;
    }

    public function Promotion($id){
        $sql = 'SELECT * FROM POM WHERE POMdelete = 0 AND POMid =' . $id;
        $query = $this->db->query($sql);
        $row = $query->row_array();

        return $row;
    }

    public function Customer($id){
        $sql = 'SELECT * FROM CUS WHERE CUSdelete = 0 AND CUSid =' . $id;
        $query = $this->db->query($sql);
        $row = $query->row_array();

        return $row;
    }

    public function BookingStatus($id){
        $sql = 'SELECT * FROM USC WHERE USCuse = 19  AND USCcode = ' . $id;
  
        $query = $this->db->query($sql);
        $row = $query->row_array();
    
        return $row;
    }

    public function getBookingByCustomerID($id){
        $sql = 'SELECT * FROM BOK WHERE BOKdelete = 0 AND BOKsta = 0 AND BOKid = ' . $id;

        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $ckey => $cvalue) {
                $row[$ckey]['Customer'] = $this->Customer($cvalue['BOKcusid']);      
            }

            foreach ($row as $rkey => $rvalue) {
                $row[$rkey]['Room'] = $this->GetRoomByID($rvalue['BOKromid']);      
            }
           
            return $row;
        } else {
            return $row = null;
        }
    }

    public function SearchidcbyCustomer($idc){
        $sql = 'SELECT COUNT(CUSidc) AS COUNTidc FROM CUS WHERE CUSdelete = 0 AND CUSidc = "' . $idc . '"';
        $query = $this->db->query($sql);
        $row = $query->row_array();
    
        return $row;
    }

    public function ShowbyidCustomer($idc){
        $sql = 'SELECT * FROM CUS WHERE CUSidc = "' . $idc . '"';
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function EditCustomer($d){
        $data = array(
            'CUStitle' => $d['editCUStitle'],
            'CUSfname' => $d['editCUSfname'],
            'CUSlname' => $d['editCUSlname'],
            'CUSadr' => $d['editCUSadr'],
            'CUSzipc' => $d['editCUSzipc'],
            'CUSbday' => $d['editCUSbday'],
            'CUSemail' => $d['editCUSemail'],
            'CUSnphone' => $d['editCUSnphone'],
            'CUSbrhid' => $d['editCUSbrhid'],
            'CUSeditedDT' => date('Y-m-d H:i:s')
        );

        $this->db->where('CUSid', $d['editCUSid']);
        return $this->db->update('CUS', $data);
    }

    public function SaveBookingFrontOffice($d){
        $BOKcusid = $this->GetIdFromIDC($d['ROMidc']);
        $sd = substr($d['BOKdate'],0,10);
        $ed = substr($d['BOKdate'],13,10);

        $data = array(
            'BOKfrom' => $d['BOKfrom'],
            'BOKromid' => $d['BOKromid'],
            'BOKcusid' => $BOKcusid['CUSid'],
            'BOKnote' => $d['BOKnote'],
            'BOKstartDT' => date("Y-m-d 12:00:00", strtotime($sd)),
            'BOKendDT' => date("Y-m-d 11:59:59", strtotime($ed)),
            'BOKsta' => 0,
            'BOKbrhid' => $d['BRHid'],
            'BOKcreatedDT' => date('Y-m-d H:i:s'),
            'BOKcreatedBy' => $d['PERid'],
            'BOKeditedDT' => date('Y-m-d H:i:s'),
            'BOKeditBy' => $d['PERid'],
            'BOKdelete' => 0,
            'BOKdeleteBy' => $d['PERid'],
            'BOKdeleteDT' => date('Y-m-d H:i:s'),
        );
        return $this->db->insert('BOK', $data);
    }

    public function GetIdFromIDC($idc){
        $sql = 'SELECT CUSid FROM CUS WHERE CUSdelete = 0 AND CUSidc = "' . $idc . '"';
        $query = $this->db->query($sql);
        $row = $query->row_array();
    
        return $row;
    }

    public function SaveBookingFrontOfficeSta0($d){        
        $data = array(
            'BOKfrom' => $d['BOKfrom'],
            'BOKromid' => $d['BOKromid'],
            'BOKcusid' => $d['BOKcusid'],
            'BOKnote' => $d['BOKnote'],
            'BOKstartDT' => date("Y-m-d 12:00:00", strtotime($d['BOKstartDT'])),
            'BOKendDT' => date("Y-m-d 11:59:59", strtotime($d['BOKendDT'])),
            'BOKsta' => $d['BOKsta'],
            'BOKbrhid' => $d['BOKbrhid'],
            'BOKcreatedDT' => date('Y-m-d H:i:s'),
            'BOKcreatedBy' => $d['PERid'],
            'BOKeditedDT' => date('Y-m-d H:i:s'),
            'BOKeditBy' => $d['PERid'],
            'BOKdelete' => 0,
            'BOKdeleteBy' => $d['PERid'],
            'BOKdeleteDT' => date('Y-m-d H:i:s'),
        );

        $this->db->where('BOKid', $d['BOKid']);
        return $this->db->update('BOK', $data);
    }

    public function getRoomToCheckout($id){
        $sql = 'SELECT * FROM BOK WHERE BOKdelete = 0 AND BOKsta = 1 AND BOKid = ' . $id;

        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $ckey => $cvalue) {
                $row[$ckey]['Customer'] = $this->Customer($cvalue['BOKcusid']);      
            }

            foreach ($row as $rkey => $rvalue) {
                $row[$rkey]['Room'] = $this->GetRoomByID($rvalue['BOKromid']);      
            }
           
            return $row;
        } else {
            return $row = null;
        }
    }

    public function getBookingByBookingID($boid){
        $sql = 'SELECT * FROM BOK WHERE BOKdelete = 0 AND BOKsta = 1 AND BOKid = ' . $boid;

        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $rkey => $rvalue) {
                $row[$rkey]['Room'] = $this->GetRoomByID($rvalue['BOKromid']);      
            }

            return $row;
        } else {
            return $row = null;
        }
    }

    public function getBookingByBookingID2($boid){
        $sql = 'SELECT * FROM BOK WHERE BOKdelete = 0 AND BOKsta = 1 AND BOKid = ' . $boid;

        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $rkey => $rvalue) {
                $row[$rkey]['Room'] = $this->GetRoomByID2($rvalue['BOKid'], $rvalue['BOKromid']);      
            }

            return $row;
        } else {
            return $row = null;
        }
    }

    public function GetRoomByID2($bid, $id){
        $sql = 'SELECT * FROM ROM WHERE ROMdelete = 0 AND ROMid = ' . $id;
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $akey => $avalue) {
                $row[$akey]['accessories'] = $this->accessories2($bid, $avalue['ROMrasid']);
            }

            return $row;
        } else {
            return $row = null;
        }
    }

    public function equipment($bid, $xaid){
        $sql = 'SELECT * FROM RAD WHERE RADdelete = 0 AND RADbokid = ' . $bid . ' AND RADromrisid = ' . $xaid;
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function accessories2($bid, $aid){
        $sql = 'SELECT * FROM RAS WHERE RASdelete = 0 AND RASid IN ('. $aid .')';
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $xakey => $xavalue) {
                $row[$xakey]['equipment'] = $this->equipment($bid, $xavalue['RASid']);      
            }

            return $row;
        } else {
            return $row = null;
        }
    
        return $row;
    }

    public function checkEquipment($d){
        $sql = 'SELECT * FROM RAD WHERE RADbokid = ' . $d;
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $this->db->where('RADbokid', $d);
            $this->db->delete('RAD');
        }
    
        return 0;
    }

    public function SaveEquipment($d){        
        $data = array(
            'BOKhard' => '1'
        );
        $this->db->where('BOKid', $d['RADbokid']);
        $this->db->update('BOK', $data);
        return $this->db->insert('RAD', $d);
    }

    public function getItemMiniBar($id){
        $sql = 'SELECT  * FROM MNB WHERE MNBdelete = 0 AND MNBisinout = 0 AND MNBromid = '. $id .' GROUP BY MNBstkid';
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $xakey => $xavalue) {
                $row[$xakey]['item'] = $this->getProductItem($xavalue['MNBstkid']);   
                $row[$xakey]['quantity'] = $this->getQuantity($xavalue['MNBromid'], $xavalue['MNBstkid']);   
            }

            return $row;
        } else {
            return $row = null;
        }
    
        return $row;
    }

    public function getItemMiniBar2($rid, $bid){
        $sql = 'SELECT  * FROM MNB WHERE MNBdelete = 0 AND MNBisinout = 0 AND MNBromid = '. $rid .' GROUP BY MNBstkid';
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $xakey => $xavalue) {
                $row[$xakey]['item'] = $this->getProductItem($xavalue['MNBstkid']);                 
                $row[$xakey]['quantity'] = $this->getQuantity($xavalue['MNBromid'], $xavalue['MNBstkid']);
                $row[$xakey]['outquantity'] = $this->getSellQuotation($bid, $xavalue['MNBstkid']);
            }

            return $row;
        } else {
            return $row = null;
        }
    
        return $row;
    }

    public function getSellQuotation($bid, $sid){
        $sql = 'SELECT * FROM MNS WHERE MNSdelete = 0 AND MNSbokid = ' . $bid . ' AND MNSstkid = ' . $sid;
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function getOutQuantity($bid, $stkid){
        $sql = 'SELECT * FROM MNS WHERE MNSbokid = ' . $bid . '';
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function getProductItem($id){
        $sql = 'SELECT * FROM STK WHERE STKdelete = 0 AND STKid = ' . $id;
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $xakey => $xavalue) {
                $row[$xakey]['unit'] = $this->getUnit($xavalue['STKid']);                      
            }

            return $row;
        } else {
            return $row = null;
        }
    
        return $row;
    }

    public function getUnit($id){
        $sql = 'SELECT * FROM UNT WHERE UNTid = ' . $id;
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function getQuantity($MNBromid, $MNBstkid){
        // $sql = 'SELECT (SELECT COALESCE(SUM(MNBqty), 0) AS TOT1 FROM MNB WHERE MNBdelete = 0 AND MNBisinout = 0 AND MNBromid = ' . $MNBromid . ' AND MNBstkid = ' . $MNBstkid . ') - (SELECT COALESCE(SUM(MNBqty), 0) AS TOT2 FROM MNB WHERE MNBdelete = 0 AND MNBisinout = 1 AND MNBromid = ' . $MNBromid . ' AND MNBstkid =  ' . $MNBstkid . ') AS QTYbyid';
        $sql = 'SELECT COALESCE(SUM(MNBqty), 0) AS QTYbyid FROM MNB WHERE MNBdelete = 0 AND MNBisinout = 0 AND MNBromid = ' . $MNBromid . ' AND MNBstkid = ' . $MNBstkid;
        $query = $this->db->query($sql);
        $row = $query->row_array();
    
        return $row;
    }

    public function checkMinibar($d){
        $sql = 'SELECT * FROM MNS WHERE MNSbokid = ' . $d;
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $this->db->where('MNSbokid', $d);
            $this->db->delete('MNS');
        }
    
        return 0;
    }

    public function getItemByMNBid($romid, $stkid){
        $sql = 'SELECT * FROM MNB WHERE MNBromid = ' . $romid . ' AND MNBstkid = ' . $stkid;
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $xakey => $xavalue) {
                $row[$xakey]['item'] = $this->getProductItem($xavalue['MNBstkid']);   
            }

            return $row;
        } else {
            return $row = null;
        }
    
        return $row;
    }

    public function SaveMiniBar($d){
        $data = array(
            'BOKmini' => '1'
        );
        $this->db->where('BOKid', $d['MNSbokid']);
        $this->db->update('BOK', $data);

        return $this->db->insert('MNS', $d);
    }

    public function SaveMiniBarWayOut($d){
        $sql = 'SELECT * FROM MNB WHERE MNBdelete = 0 AND MNBisinout = 1 AND MNBromid = ' . $d['MNBromid'] . ' AND MNBstkid = ' . $d['MNBstkid'];
        $query = $this->db->query($sql);
        $num = $query->num_rows();
        
        if($num == 0){
            return $this->db->insert('MNB', $d);
        }else{
            $sql = 'UPDATE MNB 
                    SET MNBdelete = 1
                    WHERE MNBdelete = 0 AND MNBisinout = 1 AND MNBromid = ' . $d['MNBromid'] . ' AND MNBstkid = ' . $d['MNBstkid'];
                    
            $query = $this->db->query($sql);
            return $this->db->insert('MNB', $d);
        }
    }

    public function SaveBookingFrontOfficeSta01($d){
        $data = array(
            'BOKfrom' => $d['BOKfrom'],
            'BOKromid' => $d['BOKromid'],
            'BOKcusid' => $d['BOKcusid'],
            'BOKnote' => '',
            'BOKstartDT' => date("Y-m-d 12:00:00", strtotime($d['BOKstartDT'])),
            'BOKendDT' => date('Y-m-d H:i:s'),
            'BOKsta' => 2,
            'BOKbrhid' => $d['BOKbrhid'],
            'BOKcreatedDT' => date('Y-m-d H:i:s'),
            'BOKcreatedBy' => $d['PERid'],
            'BOKeditedDT' => date('Y-m-d H:i:s'),
            'BOKeditBy' => $d['PERid'],
            'BOKdelete' => 0,
            'BOKdeleteBy' => $d['PERid'],
            'BOKdeleteDT' => date('Y-m-d H:i:s'),
        );

        $this->db->where('BOKid', $d['BOKid']);
        $this->db->update('BOK', $data);

        $data2 = array('RADcheckout' => 1);
        $this->db->where('RADbokid', $d['BOKid']);
        $this->db->update('RAD', $data2);

        $data3 = array('MNScheckout' => 1);
        $this->db->where('MNSbokid', $d['BOKid']);
        $this->db->update('MNS', $data3);

        if ($d['extrabed'] == 1) {
            $data4 = array(
                'REDbokid' => $d['BOKid'],
                'REDcheckout' => 1,
                'REDqty' => 1,
                'REDprice' => $d['REDprice'],
                'REDtot' => $d['REDprice'],
                'REDnote' => $d['REDnote'],
                'REDdelete' => 0,
                'REDdeleteBy' => $d['PERid'],
                'REDdeleteDT' => date('Y-m-d H:i:s')
            );
            $this->db->insert('RED', $data4);

            $data5 = array('BOKexbed' => 1);
            $this->db->where('BOKid', $d['BOKid']);
            $this->db->update('BOK', $data5);
        }        
        
        return $d['BOKid'];
    }

    public function SaveBookingFrontOfficeSta02($id, $perid){
        $sql = 'SELECT * FROM BOK WHERE BOKdelete = 0 AND BOKsta = 2 AND BOKid = ' . $id;
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();
            $d = $row[0];
            debug($d);
            $data = array(
                'BOKfrom' => $d['BOKfrom'],
                'BOKromid' => $d['BOKromid'],
                'BOKcusid' => $d['BOKcusid'],
                'BOKnote' => $d['BOKnote'],
                'BOKstartDT' => date("Y-m-d 12:00:00", strtotime($d['BOKstartDT'])),
                'BOKendDT' => date("Y-m-d 11:59:59", strtotime($d['BOKendDT'])),
                'BOKsta' => 3,
                'BOKbrhid' => $d['BOKbrhid'],
                'BOKcreatedDT' => date('Y-m-d H:i:s'),
                'BOKcreatedBy' => $perid,
                'BOKeditedDT' => date('Y-m-d H:i:s'),
                'BOKeditBy' => $perid,
                'BOKdelete' => 0,
                'BOKdeleteBy' => $perid,
                'BOKdeleteDT' => date('Y-m-d H:i:s'),
            );
            
            // return $this->db->insert('BOK', $data);
            $this->db->where('BOKid', $id);
            $this->db->update('BOK', $data);

        } else {
            return $row = null;
        }
    
        return $row;
    }

    public function getBookingShowOnBill($cusid){
        $sql = 'SELECT * FROM BOK WHERE BOKbillout = 0 AND BOKdelete = 0 AND BOKsta = 2 AND BOKbillout = 0 AND BOKcusid = ' . $cusid;

        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $key => $value) {
            //     // $row[$key]['customer'] = $this->Customer($value['BOKcusid']);
            //     // $row[$key]['chkintot'] = round(abs(strtotime($value['BOKstartDT']) - strtotime($value['BOKendDT']))/60/60/24);
                $row[$key]['room'] = $this->billRoom($value['BOKromid']);
            //     $row[$key]['accessories'] = $this->billAccessories($value['BOKid']);
            //     $row[$key]['minibar'] = $this->billMiniBar($value['BOKid']);
            }

            return $row;
        } else {
            return $row = null;
        }
    }

    public function billRoom($id){
        $sql = 'SELECT * FROM ROM WHERE  ROMid = ' . $id;
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function billAccessories($id){        
        $sql = 'SELECT * FROM RAD WHERE RADbokid = ' . $id;
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $xakey => $xavalue) {
                $row[$xakey]['unit'] = $this->accessoriesname($xavalue['RADromrisid']);                      
            }

            return $row;
        } else {
            return $row = null;
        }
    
    }

    public function accessoriesname($id){
        $sql = 'SELECT * FROM RAS WHERE RASid = ' . $id;
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function billMiniBar($id){
        $sql = 'SELECT * FROM MNS WHERE MNSbokid = ' . $id;
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $xakey => $xavalue) {
                $row[$xakey]['product'] = $this->getProductItem($xavalue['MNSstkid']);                      
            }

            return $row;
        } else {
            return $row = null;
        }
    }

    public function getListBill($rid){
        $sql = 'SELECT * FROM BOK WHERE BOKdelete = 0 AND BOKsta = 2 AND BOKid IN (' . $rid . ')';
        // debug($sql);
        // exit();
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $key => $value) {
                $row[$key]['atnight'] = round(abs(strtotime($value['BOKstartDT']) - strtotime($value['BOKendDT']))/60/60/24);
                
                $row[$key]['room'] = $this->billRoom($value['BOKromid']);
                // foreach ($row[$key]['room'] as $rkey => $rvalue) {
                //     $row[$rkey]['romprice'] = $rvalue['ROMpice'] * (round(abs(strtotime($value['BOKstartDT']) - strtotime($value['BOKendDT']))/60/60/24));
                // }
                $row[$key]['accessories'] = $this->billAccessories($value['BOKid']);
                $row[$key]['minibar'] = $this->billMiniBar($value['BOKid']);
                $row[$key]['extrabed'] = $this->billExtrabed($value['BOKid']);
            }

            return $row;
        } else {
            return $row = null;
        }
    }
    
    public function billExtrabed($id){
        $sql = 'SELECT * FROM RED WHERE REDbokid = ' . $id;
        $query = $this->db->query($sql);
        $row = $query->result_array();
    
        return $row;
    }

    public function infoCustomerBill(){
        $sql = 'SELECT BOKcusid, COUNT(BOKcusid) AS BOKromcount FROM BOK WHERE BOKdelete = 0 AND BOKsta = 2 AND BOKbillout = 0 GROUP BY BOKcusid ORDER BY BOKcreatedDT DESC';
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $key => $value) {
                $row[$key]['customer'] = $this->Customer($value['BOKcusid']);                
            }

            return $row;
        } else {
            return $row = null;
        }
    }

    public function searchFromPromotionCode($d){
        $sql = 'SELECT * FROM POM WHERE POMdelete = 0 AND POMpcode = "'. $d['POMpcode'] .'"';
        $query = $this->db->query($sql);
        $num = $query->num_rows();
        // $row = $query->result_array();
        // debug($row);
        // exit();
        if ($num > 0) {
            $row = $query->result_array();
            $POMstartDT = date("Y-m-d", strtotime($d['POMstartDT']));
            $POMstartDT = date("Y-m-d", strtotime($d['POMstartDT']));
            $str = explode(',',$row[0]['POMbrhid'],-1);
            
            foreach ($str as $key => $value) {
                if ($d['POMbrhid'] == $value) {
                    // debug($value);
                    $sql2 = 'SELECT * FROM POM WHERE POMpcode = "'. $d['POMpcode'] .'" AND POMdelete = 0 AND (POMstartDT <= "'. $POMstartDT .'" AND POMendDT >= "'. $POMstartDT .'")';
                    $query2 = $this->db->query($sql2);
                    $row2 = $query2->result_array();
                    // debug("00000");
                    return $row2;
                }            
            }

            // return $row;
        } else {
            // debug("11111");
            return $row = 0;
        }
    }

    public function SaveVoucherBooking($d){
        $runidvs = $this->SystemControl->RunCode('VOC', '03');
        $bookingid = explode(',', $d['VOL']);
       
        $data = array(
            'VOCcode' => $runidvs,
            'VOCtype' => '03',
            'VOCcancel' => 0,
            'VOCcusid' => $d['VOCcusid'],
            'VOCsubadr' => $d['VOCsubadr'],
            'VOCbrhid' => $d['VOCbrhid'],
            'VOCidtab' => '201000',
            'VOCvat' => $d['VOCvat'],
            'VOCvatsum' => $d['VATsum'],
            'VOCsum' => $d['TOTsum'],
            'VOCdis' => $d['VOCdis'],
            'VOCpaytype' => 0,
            'VOCdate' => date('Y-m-d H:i:s'),
            'VOCrefer' => '',
            'VOCnote' => '',
            'VOCstartDT' => '',
            'VOCendDT' => '',
            'VOCcreatedDT' => date('Y-m-d H:i:s'),
            'VOCcreatedBY' => $d['VOCcreatedBY'],
            'VOCeditedDT' => date('Y-m-d H:i:s'),
            'VOCdelete' => 0,
            'VOCdeleteBy' => '',
            'VOCdeleteDT' => date('Y-m-d H:i:s')
        );
        
        $this->db->insert('VOC', $data);
        $vocid = $this->db->insert_id();

        if ($d['VOCsubadr'] == 1) {
            $adr = array(
                'ADRallid' => $vocid,
                'ADRidtab' => 401000,
                'ADRname' => $d['ADRname'],
                'ADRtel' => $d['ADRtel'],
                'ADRemail' => $d['ADRemail'],
                'ADRnote' => $d['ADRnote']
            );
            $this->db->insert('ADR', $adr);
        }

        $roomprice = 0; $sumacc = 0; $summinibar = 0; $sumextrabed = 0; $tot = 0; $test = 0;
        foreach ($bookingid as $key => $value) {
            $r = $this->getListBill($value);
            // debug($r[0]['accessories']);
            $atnight = round(abs(strtotime($r[0]['BOKstartDT']) - strtotime($r[0]['BOKendDT']))/60/60/24);
            $roomprice = $r[0]['room'][0]['ROMpice'] * $atnight;

            if(isset($r[0]['accessories'])){
                foreach($r[0]['accessories'] as $akey => $avalue){
                    $sumacc += $avalue['RADromristot'];
                }
            }

            if(isset($r[0]['minibar'])){
                foreach($r[0]['minibar'] as $mkey => $mvalue){
                    $summinibar += $mvalue['MNSromristot'];
                }
            }

            if(isset($r[0]['extrabed'])){
                foreach($r[0]['extrabed'] as $exkey => $exvalue){
                    $sumextrabed += $exvalue['REDprice'];
                }
            }
            
            $tot = $roomprice + $sumacc + $summinibar + $sumextrabed;
            $vat = $tot * $d['VOCvat'] / 100;
            $tv = $tot + $vat - $d['VOCdis'];
            $ldata = array(
                'VOLvocid' => $vocid,
                'VOLidtab' => $data['VOCidtab'],
                'VOLsid' => $value,
                'VOLqty' => 1,
                'VOLprice' => $tot,
                'VOLcreatedDT' => date('Y-m-d H:i:s'),
                'VOLeditedDT' => date('Y-m-d H:i:s'),
                'VOLdelete' => 0,
                'VOLdeleteBy' => '',
                'VOLdeleteDT' => date('Y-m-d H:i:s')
            );

            $this->db->insert('VOL', $ldata);
            $roomprice = 0; $sumacc = 0; $summinibar = 0; $sumextrabed = 0; 
            $tot = 0; $test = 0;
            $bdata = array('BOKbillout' => 1);
            $this->db->where('BOKid', $ldata['VOLsid']);
            $this->db->update('BOK', $bdata);
        }
        
        return $vocid;

    }

    public function loadVoucherReceipt($id){
        $sql = 'SELECT * FROM VOC WHERE VOCdelete = 0 AND VOCid = ' . $id;
        $query = $this->db->query($sql);
        $num = $query->num_rows();
        if ($num > 0) {
            $row = $query->result_array();

            if ($row[0]['VOCsubadr'] == 1) {
                foreach ($row as $akey => $avalue) {
                    $row[$akey]['addr'] = $this->aubAddress($avalue['VOCid']);
                }
            }
            
            foreach ($row as $ckey => $cvalue) {
                $row[$ckey]['customer'] = $this->Customer($cvalue['VOCcusid']);
            }

            foreach ($row as $key => $value) {
                $row[$key]['branch'] = $this->branch($value['VOCbrhid']);      
            }

            foreach ($row as $key => $value) {
                $row[$key]['voucherlist'] = $this->loadVoucherReceiptList($value['VOCid']);                
            }
            

            return $row;
        } else {
            return $row = null;
        }
    }

    public function loadVoucherReceiptList($id){
        $sql = 'SELECT * FROM VOL WHERE VOLdelete = 0 AND VOLvocid = ' . $id;
        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $key => $value) {
                $row[$key]['sublist'] = $this->getListBill($value['VOLsid']);                
            }

            return $row;
        } else {
            return $row = null;
        }
    }

    public function aubAddress($id){
        $sql = 'SELECT * FROM ADR WHERE ADRidtab = 401000 AND ADRallid = ' . $id;
        $query = $this->db->query($sql);
        $row = $query->result_array();
        return $row;
    }

    public function selectRoom($brhid, $rnature){
        $sql = 'SELECT * FROM ROM  WHERE (ROMid NOT IN (SELECT BOKromid FROM BOK WHERE BOKbrhid = ' . $brhid .' AND BOKdelete = 0)) AND ROMdelete = 0 AND ROMbrhid = ' . $brhid .' AND ROMnature = ' . $rnature . ' LIMIT 1';

        $query = $this->db->query($sql);
        $row = $query->result_array();

        return $row;
    }

    public function SaveBookingByCustomer($data){        
        $this->db->insert('BOK', $data);
        return $this->db->insert_id();
    }

    public function getBookingByBookingID3($boid){
        $sql = 'SELECT * FROM BOK WHERE BOKdelete = 0 AND BOKsta = 0 AND BOKid = ' . $boid;

        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            foreach ($row as $key => $value) {
                $row[$key]['Promotion'] = $this->Promotion($value['BOKpomid']);      
            }

            foreach ($row as $rkey => $rvalue) {
                $row[$rkey]['Room'] = $this->GetRoomByID($rvalue['BOKromid']);      
            }

            foreach ($row as $ckey => $cvalue) {
                $row[$ckey]['customer'] = $this->Customer($cvalue['BOKcusid']);      
            }

            return $row;
        } else {
            return $row = null;
        }
    }

    public function infoBillBooking(){
        $sql = 'SELECT * FROM BOK LEFT JOIN USC ON BOK.BOKfrom = USC.USCcode WHERE BOKdelete = 0 AND BOKbillout = 0 AND USCuse = 16';

        $query = $this->db->query($sql);
        $num = $query->num_rows();

        if ($num > 0) {
            $row = $query->result_array();

            // foreach ($row as $key => $value) {
            //     $row[$key]['Promotion'] = $this->Promotion($value['BOKpomid']);      
            // }

            foreach ($row as $rkey => $rvalue) {
                $row[$rkey]['Room'] = $this->GetRoomByID($rvalue['BOKromid']);      
            }

            foreach ($row as $ckey => $cvalue) {
                $row[$ckey]['customer'] = $this->Customer($cvalue['BOKcusid']);      
            }

            return $row;
        } else {
            return $row = null;
        }
    }
    
}