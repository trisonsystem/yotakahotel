<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class RoomsController extends BaseController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RoomModel');
        $this->load->model('SystemModel');
        $this->SystemControl = new SystemControl();
        $this->load->helper('cookie');

        // $MyLang = $this->SystemControl->CheckYourIPapi();
        // $country = strtolower($MyLang->geoplugin_countryName);
        // if (!isset($_COOKIE['lang'])) {
        //     if ($country == 'thailand') {
        //         $lang = 'thailand';
        //     } else {
        //         $lang = 'english';
        //     }
        //     setcookie('lang', $lang);
        // } else {
        //     $lang = $_COOKIE['lang'];
        // }
        //     $this->lang->load($lang, $lang);
    }

    public function getAccessories($id){

        $cdata['access'] = $this->RoomModel->GetAccessories($id);

        if (count($cdata['access']) > 0) {
            $cdata['chk'] = 'getAccessories';
            $cdata['nature'] = $this->SystemModel->Usecase('14');
            $cdata['rtype'] = $this->SystemModel->Usecase('21');
            $this->load->view('employee/showdatahtml', $cdata);
        } else {
            echo("<h1>No data accessories fom branch</h1>");
        }
        
    }

    public function saveRooms(){
        $post = $this->input->post();
        
        if ($post) {

            if ($post['ROMstart'] != "") {
                $start = $post['ROMstart'];
            } else {
                $start = '';
            }

            if ($post['ROMend'] != "") {
                $end = $post['ROMend'];
            } else {
                $end = '';
            }
            
            for($i = 0; $i < $post['ROMcount']; $i++){
                $len = strlen($post['ROMnum']);
                $nums = $post['ROMnum'] + $i;
                $rid = str_pad($nums, $len, "0", STR_PAD_LEFT);
                $rno = $start . $rid . $end;
                $chkRoom = $this->RoomModel->chksumRooms($rno, $post['ROMbrhid']);
                if($chkRoom['myRoom'] != 0){                    
                    $this->session->set_flashdata('error', 'Can not save data' . $rno);
                    return false;
                }
            }

            for($i = 0; $i < $post['ROMcount']; $i++){

                $len = strlen($post['ROMnum']);
                $nums = $post['ROMnum'] + $i;
                $rid = str_pad($nums, $len, "0", STR_PAD_LEFT);
                $rno = $start . $rid . $end;

                $data = array(
                    'ROMno' => $rno,
                    'ROMdescTH' => $post['ROMdescTH'],
                    'ROMdescEN' => $post['ROMdescEN'],
                    'ROMnature' => $post['ROMnature'],
                    'ROMtype' => $post['ROMtype'],
                    'ROMrasid' => $post['ROMrasid'],
                    'ROMlimit' => $post['ROMlimit'],
                    'ROMpice' => $post['ROMpice'],
                    'ROMbrhid' => $post['ROMbrhid'],
                    'ROMcreatedBy' => $post['ROMcreatedBy'],
                    'ROMcreatedDT' => date('Y-m-d H:i:s'),
                    'ROMeditedDT' => date('Y-m-d H:i:s'),
                    'ROMdelete' => 0,
                    'ROMdeleteBy' => 0,
                    'ROMactiveDT' => date('Y-m-d H:i:s')
                );
                // debug($data);
                $this->RoomModel->SaveRooms($data);
            }
            
            $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
        } else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
        
    }

    public function showbyidRooms($id){
        $get = $this->input->get();
        
        if($get){
            if (isset($get['param'])) {
                // echo("5555");
                $showby = $this->RoomModel->ShowbyidRooms($id); 
                if ($showby) {
                    $this->load->model('BranchModel');
                    $cdata['mysession'] = $_SESSION;
                    $cdata['branch'] = $this->BranchModel->SeInfoBranch();
                    $cdata['access'] = $this->RoomModel->GetAccessories($showby[0]['ROMbrhid']);
                    if (count($cdata['access']) < 0) {
                        $cdata['access'] = null;
                    }
                    // debug($cdata['access']);
                    $cdata['nature'] = $this->SystemModel->Usecase('14');
                    $cdata['rtype'] = $this->SystemModel->Usecase('21');
                    $cdata['chk'] = 'showbyidRooms';
                    $cdata['room'] = $showby;

                    $this->load->view('employee/showdatahtml', $cdata);
                }
            }
        }
    }

    public function editRoom(){
        $post = $this->input->post();
        
        if ($post) {
            if ($this->RoomModel->EditRoom($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
        
    }

    public function delbyidRoom($id){
        $get = $this->input->get();
        
        if ($get) {
          if (isset($get['param'])) {
            $showby = $this->RoomModel->ShowbyidRooms($id); 
            
            if ($showby) {  
              $cdata['mysession'] = $_SESSION;
              $cdata['chk'] = 'delbyidRoom';
              $cdata['room'] = $showby;
  
              $this->load->view('employee/showdatahtml', $cdata);
            }
          }
        }
    }

    public function deleteRoom(){
        $post = $this->input->post();
        
        if ($post) {
            if ($this->RoomModel->DeleteRoom($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }
}