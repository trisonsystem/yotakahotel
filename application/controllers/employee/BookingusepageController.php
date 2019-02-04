<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class BookingusepageController extends BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->SystemControl = new SystemControl();
        $this->load->model('SystemModel');
        $this->load->model('BookingusepageModel');
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

    public function saveBookingUsePage()
    {
        $post = $this->input->post();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('PU03brhid', 'PU03brhid', 'required');
        $this->form_validation->set_rules('PU03descTH', 'PU03descTH', 'required');
        $this->form_validation->set_rules('PU03descEN', 'PU03descEN', 'required');

        if ($this->form_validation->run() == FALSE) {
          $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }else {
          if ($post) {
            $idbefore = $this->BookingusepageModel->SaveBeforeBookingUsePage($post, '0');
            if ($this->BookingusepageModel->SaveBookingUsePage($post) && $idbefore == 'OK') {
              $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }
          }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
          }
        }
    }

    public function showbyidPageBooking($id){
      $get = $this->input->get();

      if ($get) {
        if (isset($get['param'])) {
          $showby = $this->BookingusepageModel->ShowbyidPageBooking($id);

          if($showby){
            // $url = base_url(uri_string());
            // $myapib = 'infobranch?param=true';
            // $bdata = gUrl($myapib, 'showpbookingbyid/');
            $this->load->model('BranchModel');
            $cdata['mysession'] = $_SESSION;
            $cdata['branch'] = $this->BranchModel->SeInfoBranch();
            $cdata['chk'] = 'showbyidPageBooking';
            $cdata['status'] = $this->SystemModel->Usecase('27');
            $cdata['shpagebooking'] = $showby;

            $this->load->view('employee/showdatahtml', $cdata);
          }

        }
      }
    }

    public function editBookingUsePage(){
      $post = $this->input->post();

      if ($post) {
        $lstatus = $this->SystemModel->LastMyStatus($post['editPU03id'], 'PU03');

        if ($post['editPU03sta'] != $lstatus) {
          $this->BookingusepageModel->SaveBeforeBookingUsePage($post, '1');
        }

        if ($this->BookingusepageModel->EditPageBooking($post)) {
          $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
        }else {
          $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
    }

    public function delbyidBookingUsePage($id){
      $get = $this->input->get();

      if ($get) {
        if (isset($get['param'])) {
          $showby = $this->BookingusepageModel->ShowbyidBookingUsePage($id);
          if ($showby) {
            // $url = base_url(uri_string());
            // $myapib = 'infobranch?param=true';
            // $bdata = gUrl($myapib, 'delbookingusepagebyid/');
            $this->load->model('BranchModel');
            $cdata['mysession'] = $_SESSION;
            $cdata['branch'] = $this->BranchModel->SeInfoBranch();
            $cdata['chk'] = 'delbyidBookingUsePage';
            $cdata['shpagebooking'] = $showby;

            $this->load->view('employee/showdatahtml', $cdata);
          }
        }
      }
    }

    public function deleteBookingUsePage(){
      $post = $this->input->post();

      if ($post) {
        if ($this->BookingusepageModel->DeleteBookingUsePage($post)) {
          $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
        }else {
          $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
    }

    public function deleteGroupBookingUsePage(){
      $post = $this->input->post();
      
      if ($post) {
        if ($this->BookingusepageModel->DeleteBookingUsePageByGroup($post)) {
          $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
        }else {
          $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
    }


}
