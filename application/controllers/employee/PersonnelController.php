<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class PersonnelController extends BaseController{

    function __construct(){
        parent::__construct();
        $this->load->model('PersonnelModel');
        $this->load->model('SystemModel');
        $this->SystemControl = new SystemControl();
        $this->load->helper('cookie');
    
        $MyLang = $this->SystemControl->CheckYourIPapi();
        $country = strtolower($MyLang->geoplugin_countryName);
        if (!isset($_COOKIE['lang'])) {
            if ($country == 'thailand') {
                $lang = 'thailand';
            } else {
                $lang = 'english';
            }
            setcookie('lang', $lang);
        } else {
            $lang = $_COOKIE['lang'];
        }
        $this->lang->load($lang, $lang);
      }

    public function filterDepartment($id){
        $get = $this->input->get();
        
        if($get){
          if (isset($get['param'])) {
            $showby = $this->PersonnelModel->FilterDepartment($id);
            
            if ($showby) {
              $cdata['chk'] = 'filterDepartment';
              $cdata['position'] = $showby;
    
              $this->load->view('employee/showdatahtml', $cdata);
            }
          }
        }
    }

    public function savePersonnel(){
        $post = $this->input->post();
        $rcus = $this->SystemModel->CheckSumCUS($post['PERuname']);
        $rper = $this->SystemModel->CheckSumPER($post['PERuname']);

        if (($rcus == 0) && ($rper == 0)) {
            if ($this->PersonnelModel->SavePersonnel($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else{
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }   
        } else {
            $this->session->set_flashdata('error', 'Please check Username. Can not record your data.');
        }
        
    }

    public function deleteGroupPersonnel(){
        $post = $this->input->post();
        
        if ($post) {
            if ($this->PersonnelModel->DeletePersonnelByGroup($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    public function showbyidPersonnel($id){
        $get = $this->input->get();
        
        if ($get) {
          if (isset($get['param'])) {
            $showby = $this->PersonnelModel->ShowbyidPersonnel($id);
            
            if ($showby) {
                $this->load->model('BranchModel');
                $this->load->model('DepartmentModel');
                $this->load->model('SystemModel');
                $cdata['mysession'] = $_SESSION;
                $cdata['chk'] = 'showbyidPersonnel';
                $cdata['titlename'] = $this->SystemModel->Usecase('13');
                $cdata['department'] = $this->DepartmentModel->infoDepartment();
                $cdata['branch'] = $this->BranchModel->SeInfoBranch();
                $cdata['per'] = $showby;
    
                $this->load->view('employee/showdatahtml', $cdata);
            }
          }
        }
    }

    public function editPersonnel(){
        $post = $this->input->post();
        // debug($post);
        // exit();
        if ($post) {
            if ($this->PersonnelModel->EditPersonnel($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        } else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
        
    }

    public function delbyidPersonnel($id){
        $get = $this->input->get();
        
        if ($get) {
          if (isset($get['param'])) {
            $showby = $this->PersonnelModel->ShowbyidPersonnel($id);
            // debug($showby);
            // exit();
            if ($showby) {  
              $cdata['mysession'] = $_SESSION;
              $cdata['chk'] = 'delbyidPersonnel';
              $cdata['personnel'] = $showby;
  
              $this->load->view('employee/showdatahtml', $cdata);
            }
          }
        }
    }

    public function deletePersonnel(){
        $post = $this->input->post();
        if ($post) {
            if ($this->PersonnelModel->DeletePersonnel($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

}