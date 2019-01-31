<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SystemControl {
    /*
     * Check user from
     */

    public function ChkMyuserFromTB($Tabid) {
        switch ($Tabid) {

            case '101000' :
                $Tabname = "CUS";
                break;

            case '102000' :
                $Tabname = "PER";
                break;

            default:
                $Tabname = "No database name";
                break;
        }
        return $Tabname;
    }

    /*
     * Run Number
     */

    public function RunNumberByDate($startSTR, $tableName) {
        $sql = "SELECT max(orderNO) as vnum FROM " . $tableName;
        $que_sb = $this->db->query($sql);
        $r = $que_sb->row_array();
        $vn = $r['vnum'];
        $cdate = date("dmY");
        $olddate = substr($vn, 3, 8);
        if ($olddate == $cdate) {
            $nums = substr($vn, 12, 4) + 1;
            $runID = str_pad($nums, 4, "0", STR_PAD_LEFT);
            $runID = $startSTR . $cdate . "-" . $runID;
        } else {
            $runID = $startSTR . $cdate . "-0001";
        }
        return $runID;
    }

    /*
     * Run Number  code
     */

    public function RunCode($tableName, $type) {
        $CI = & get_instance();
        $CI->load->database();
        $field = $tableName . 'code';

        $sql = "SELECT max(" . $field . ") as vnum FROM " . $tableName;
        $que_sb = $CI->db->query($sql);
        $r = $que_sb->row_array();
        $vn = $r['vnum'];

        if (strlen($vn) < 20) {
            $runID = $tableName . $type . '-00000000000001';
        } else {
            $subid = substr($vn, 6, 14) + 1;
            $endID = str_pad($subid, 14, "0", STR_PAD_LEFT);
            $runID = $tableName . $type . '-' . $endID;
        }

        return $runID;
    }

    /*
     * Run Number  code
     */

    public function CheckYourIPapi() {
        if ($json = @file_get_contents("http://www.geoplugin.net/json.gp")) {
            $obj = json_decode($json);
            //        $ip = $obj->geoplugin_request;
            //        $city = $obj->geoplugin_city;
            //        $region = $obj->geoplugin_city;
            //        $country =  $obj->geoplugin_countryName;
            //        $country_code = $obj->geoplugin_countryCode;
            // strtolower(); พิมพ์เล็ก
        }
        return $obj;
    }

}
