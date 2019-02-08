<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class PromotionsController extends BaseController{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('PromotionsModel');
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

    public function savePromotions(){
        $post = $this->input->post();

        if ($post) {
            $startDT = date_create(substr($post['bdaterange'],0,10));
            $endDT = date_create(substr($post['bdaterange'],13,10));
            // $chkbrh = explode(',', $post['chkbrh']);
            // debug($post);
            // exit();
            // foreach ($chkbrh as $key => $value) {
                $data = array(
                    'POMdescTH' => $post['POMdescTH'],
                    'POMdescEN' => $post['POMdescEN'],
                    'POMpcode' => $post['POMpcode'],
                    'POMdis' => $post['POMdis'],
                    'POMstartDT' => date_format($startDT, "Y-m-d"),
                    'POMendDT' => date_format($endDT, "Y-m-d"),
                    'POMlink' => $post['POMlink'],
                    'POMbrhid' => $post['chkbrh'],
                    'POMcreatedBy' => $post['POMperid'],
                    'POMcreatedDT' => date('Y-m-d H:i:s'),
                    'POMeditedDT' => date('Y-m-d H:i:s'),
                    'POMdelete' => 0,
                    'POMdeleteBy' => "",
                    'POMdeleteDT' => ""
                );
                // $this->PromotionsModel->SavePromotions($data);
            // }
            if ($this->PromotionsModel->SavePromotions($data)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else{
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }    
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    public function deleteGroupPromotions(){
        $post = $this->input->post();
        if ($post) {
            if ($this->PromotionsModel->DeletePromotionsByGroup($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    public function delbyidPromotions($id){
        $get = $this->input->get();
        
        if ($get) {
          if (isset($get['param'])) {
            $showby = $this->PromotionsModel->ShowbyidPromotions($id);
            
            if ($showby) {  
              $cdata['mysession'] = $_SESSION;
              $cdata['chk'] = 'delbyidPromotions';
              $cdata['promotionbid'] = $showby;
  
              $this->load->view('employee/showdatahtml', $cdata);
            }
          }
        }
    }

    public function deletePromotions(){
        $post = $this->input->post();
        if ($post) {
            if ($this->PromotionsModel->DeletePromotions($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    public function showbyidPromotions($id){
        $get = $this->input->get();

        if($get){
            if (isset($get['param'])) {
                $showby = $this->PromotionsModel->ShowbyidPromotion($id);
                
                if ($showby) {
                    $this->load->model('BranchModel');
                    $cdata['mysession'] = $_SESSION;
                    $cdata['branch'] = $this->BranchModel->SeInfoBranch();
                    $cdata['chk'] = 'showbyidPromotions';
                    $cdata['epromotion'] = $showby;

                    $this->load->view('employee/showdatahtml', $cdata);
                }
            }
        }
    }

    public function editPromotions(){
        $post = $this->input->post();
        
        if ($post) {
            $startDT = date_create(substr($post['edateranges'],0,10));
            $endDT = date_create(substr($post['edateranges'],13,10));
            
            $data = array(
                'POMid' => $post['ePOMid'],
                'POMdescTH' => $post['ePOMdescTH'],
                'POMdescEN' => $post['ePOMdescEN'],
                'POMpcode' => $post['ePOMpcode'],
                'POMdis' => $post['ePOMdis'],
                'POMstartDT' => date_format($startDT, "Y-m-d"),
                'POMendDT' => date_format($endDT, "Y-m-d"),
                'POMlink' => $post['ePOMlink'],
                'POMbrhid' => $post['echkbrh'],
                // 'POMcreatedBy' => $post['POMperid'],
                // 'POMcreatedDT' => date('Y-m-d H:i:s'),
                'POMeditedDT' => date('Y-m-d H:i:s'),
                'POMdelete' => 0,
                // 'POMdeleteBy' => $post['POMperid'],
                // 'POMdeleteDT' => date('Y-m-d H:i:s')
            );

            if ($this->PromotionsModel->EditPromotions($data)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    
}