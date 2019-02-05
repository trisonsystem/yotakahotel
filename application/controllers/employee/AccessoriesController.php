<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class AccessoriesController extends BaseController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AccessoriesModel');
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
            // $lang = $_COOKIE['lang'];
        // }
        // $this->lang->load($lang, $lang);
    }

    public function saveAccessories(){
        $post = $this->input->post();
        if ($post) {
            if ($this->AccessoriesModel->SaveAccessories($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else{
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        } else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
        
    }

    public function deleteGroupAccessories(){
        $post = $this->input->post();
        
        if ($post) {
            if ($this->AccessoriesModel->DeleteAccessoriesByGroup($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    public function delbyidAccessories($id){
        $get = $this->input->get();
        
        if ($get) {
          if (isset($get['param'])) {
            $showby = $this->AccessoriesModel->ShowbyidAccessories($id);
            // debug($showby);
            // exit();
            if ($showby) {  
              $cdata['mysession'] = $_SESSION;
              $cdata['chk'] = 'delbyidAccessories';
              $cdata['access'] = $showby;
  
              $this->load->view('employee/showdatahtml', $cdata);
            }
          }
        }
    }

    public function deleteAccessories(){
        $post = $this->input->post();
        if ($post) {
            if ($this->AccessoriesModel->DeleteAccessories($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    public function showbyidAccessories($id){
        $get = $this->input->get();
        if ($get) {
            if (isset($get['param'])) {
              $showby = $this->AccessoriesModel->ShowbyidAccessories($id);
              
              if ($showby) {
                  $this->load->model('BranchModel');
                  $this->load->model('SystemModel');
                  $cdata['mysession'] = $_SESSION;
                  $cdata['chk'] = 'showbyidAccessories';
                  $cdata['warranty'] = $this->SystemModel->Usecase('30');
                  $cdata['branch'] = $this->BranchModel->SeInfoBranch();
                  $cdata['access'] = $showby;
      
                  $this->load->view('employee/showdatahtml', $cdata);
              }
            }
        }
    }

    public function editAccessories(){
        $post = $this->input->post();
        if ($post) {
            if ($this->AccessoriesModel->EditAccessories($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        } else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }
}