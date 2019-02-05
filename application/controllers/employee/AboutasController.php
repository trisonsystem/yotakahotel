<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class AboutasController extends BaseController{

  function __construct(){
    parent::__construct();
    $this->load->model('AboutasModel');
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

  public function saveAboutas(){
    $post = $this->input->post();

    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('PU01titleTH', 'PU01titleTH', 'required');
    $this->form_validation->set_rules('PU01titleEN', 'PU01titleEN', 'required');
    $this->form_validation->set_rules('PU01descTH', 'PU01descTH', 'required');
    $this->form_validation->set_rules('PU01descEN', 'PU01descEN', 'required');

    if (($this->form_validation->run() == TRUE) && $post) {

      $config['upload_path'] = './assets/img/uploads/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $this->load->library('upload', $config);

      if ($this->upload->do_upload('PICpic')) {
          $img = $this->upload->data();
          $post['PICpic'] = $img['file_name'];
      } else {
          $post['PICpic'] = 'no-image.png';
      }

      if ($this->AboutasModel->SaveAboutas($post)) {
          $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
      }else {
          $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }

    }else {
      $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
    }
  }

  public function deleteGroupAboutas(){
    $post = $this->input->post();

    if ($post) {
      if ($this->AboutasModel->DeleteAboutasByGroup($post)) {
          $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
      }
    }else {
      $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
    }
  }

  public function showbyidAboutas($id){
    $get = $this->input->get();

    if($get){
      if (isset($get['param'])) {
        $showby = $this->AboutasModel->ShowbyidAboutas($id);

        if ($showby) {
          $cdata['mysession'] = $_SESSION;
          $cdata['chk'] = 'showbyidAboutas';
          $cdata['shaboutas'] = $showby;

          $this->load->view('employee/showdatahtml', $cdata);
        }
      }
    }
  }

  public function editAboutas(){
    $post = $this->input->post();

    if ($post) {
      $config['upload_path'] = './assets/img/uploads/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $this->load->library('upload', $config);

      if (isset($_FILES['editPICpic']['name']) == '') {
        $pic = $post['ePICpic'];
      }else {
        if ($this->upload->do_upload('editPICpic')) {
            $img = $this->upload->data();
            $pic = $img['file_name'];
        } else {
            $pic = 'no-image.png';
        }
      }

      $post['xpic'] = array(
        'PICid' => $post['editPICid'],
        'PICsid' => $post['editPU01perid'],
        'PICname' => $pic,
      );
      
      if ($this->AboutasModel->EditAboutas($post)) {
        $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }

    }else {
      $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
    }

  }

  public function delbyidAboutas($id){
    $get = $this->input->get();

    if($get){
      if (isset($get['param'])) {
        $showby = $this->AboutasModel->ShowbyidAboutas($id);
        if ($showby) {
          $cdata['mysession'] = $_SESSION;
          $cdata['chk'] = 'delbyidAboutas';
          $cdata['shaboutas'] = $showby;

          $this->load->view('employee/showdatahtml', $cdata);
        }
      }
    }
  }

  public function deleteAboutas(){
    $post = $this->input->post();
    if ($post) {
      if ($this->AboutasModel->DeleteAboutas($post)) {
        $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
    }else {
      $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
    }
  }

}

?>
