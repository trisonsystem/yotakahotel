<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class MainpageController extends BaseController {

  public function __construct() {
      parent::__construct();

      $this->SystemControl = new SystemControl();

      $this->load->model('SystemModel');
      $this->load->model('MainpageModel');
      $this->load->helper('cookie');

    //   $MyLang = $this->SystemControl->CheckYourIPapi();
    //   $country = strtolower($MyLang->geoplugin_countryName);
    //   if (!isset($_COOKIE['lang'])) {
    //       if ($country == 'thailand') {
    //           $lang = 'thailand';
    //       } else {
    //           $lang = 'english';
    //       }
    //       setcookie('lang', $lang);
    //   } else {
        //   $lang = $_COOKIE['lang'];
    //   }
    //   $this->lang->load($lang, $lang);
  }

  public function slDelete($id){
    $data = array(
        'id' => $id,
        'PICdelete' => '1',
        'PICdeleteBy' => $_SESSION['id'],
        'PICdeleteDT' => date('Y-m-d H:i:s')
    );
    
    if ($data) {
      if ($this->MainpageModel->slDelete($data)) {
          $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
      }else {
          $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
    }else{
      $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
    }
  }

  public function slUndo($id){
    $data = array(
        'id' => $id,
        'PICdelete' => '0',
        'PICdeleteBy' => $_SESSION['id'],
        'PICdeleteDT' => date('Y-m-d H:i:s')
    );
    
    if ($data) {
        if ($this->MainpageModel->slUndo($data)) {
            $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
      }else{
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
  }

  public function saveSlideShow(){
    $post = $this->input->post();
    // debug($post);
    debug($_FILES);

      if ($post) {
        $config['upload_path'] = './assets/img/slide/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        // if ($this->upload->do_upload('PICpic')) {
        //     $img = $this->upload->data();
        //     $post['PICpic'] = $img['file_name'];
        //     // echo $this->upload->display_errors();
        // }else {
        //     $post['PICpic'] = 'no-image.png';
        // }
        if ($this->upload->do_upload('PICpic')) {
//                        $this->upload->do_upload($_FILES['BRHpic']['name']);
            $img = $this->upload->data();
            $post['PICpic'] = $img['file_name'];
        } else {
            $post['PICpic'] = 'no-image.png';
        }
        debug($post);
        exit();
        if ($this->MainpageModel->saveSlideShow($post)) {
            $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }
  }

}
