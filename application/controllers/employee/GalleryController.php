<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class GalleryController extends BaseController{

  function __construct(){
    parent::__construct();
    $this->load->model('GalleryModel');
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

  public function saveImgGroup(){
    $post = $this->input->post();

    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('PU04descTH', 'PU04descTH', 'required');
    $this->form_validation->set_rules('PU04descEN', 'PU04descEN', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
    }else {
      if ($post) {
        if ($this->GalleryModel->SaveImgGroup($post)) {
          $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
        }
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
    }

  }

  public function showGroupByImg($idb){
    $cdata['sbbyimg'] = $this->GalleryModel->ShowGroupByImg($idb);
    $cdata['mysession'] = $_SESSION;
    $cdata['chk'] = 'showGroupByImg';
    $this->load->view('employee/showdatahtml', $cdata);
  }

  public function saveImgToGallery(){
    $post = $this->input->post();
    //  debug($_FILES );
    // debug($post);
    // exit();
    if ($post) {
      $config['upload_path'] = './assets/img/uploads/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $this->load->library('upload', $config);

      if ($this->upload->do_upload('PICpic')) {
          $img = $this->upload->data();
          $post['PICpic'] = $img['file_name'];
      } else {
          $post['PICpic'] = 'no-image.png';
      }

      if ($this->GalleryModel->SaveImg($post)) {
        $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }


    }
  }

  public function deleteGroupGallery(){
    $post = $this->input->post();

    if ($post) {
      if ($this->GalleryModel->DeleteGalleryPageByGroup($post)) {
        $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
    }else {
      $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
    }
  }

  public function delbyidGallery($id){
    $get = $this->input->get();

    if ($get) {
      if (isset($get['param'])) {
        $showby = $this->GalleryModel->ShowbyidGalleryUsePage($id);
        $cdata['mysession'] = $_SESSION;
        $cdata['chk'] = 'delbyidGallery';
        $cdata['shgallery'] = $showby;

        $this->load->view('employee/showdatahtml', $cdata);
      }
    }
  }

  public function deleteGallery(){
    $post = $this->input->post();

    if ($post) {
      if ($this->GalleryModel->DeleteGallery($post)) {
        $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
    }else {
      $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
    }
  }

  public function showbyidGallery($id){
    $get = $this->input->get();
    if($get){
      if (isset($get['param'])) {
        $showby = $this->GalleryModel->ShowbyidGalleryUsePage($id);
        $cdata['mysession'] = $_SESSION;
        $cdata['chk'] = 'showbyidGallery';
        $cdata['shgallery'] = $showby;

        $this->load->view('employee/showdatahtml', $cdata);
      }
    }
  }

  public function editGallery(){
    $post = $this->input->post();

    if ($this->GalleryModel->EditGallery($post)) {
      $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
    }else {
      $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
    }
  }

  public function deleteImgGalleryp($id){
    $get = $this->input->get();

    if (isset($get['param'])) {
      $delby = $this->GalleryModel->DeleteImgGalleryp($id);
      if ($delby) {
        $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
    }

  }

  public function showDeletegroupgallery($id){
    $get = $this->input->get();

    if($get){
      if (isset($get['param'])) {
        $showby = $this->GalleryModel->ShowbyidGalleryUsePage($id);
        $cdata['mysession'] = $_SESSION;
        $cdata['chk'] = 'showDeletegroupgallery';
        $cdata['shgallery'] = $showby;

        $this->load->view('employee/showdatahtml', $cdata);
      }
    }
  }

  public function deleteGroupPicGallery(){
    $post = $this->input->post();

    if ($this->GalleryModel->DebugeleteGroupPicGallery($post)) {
      $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
    }else{
      $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
    }
  }

}
