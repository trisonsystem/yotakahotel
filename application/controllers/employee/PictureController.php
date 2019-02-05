<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 *
 */
class PictureController extends BaseController
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('PictureModel');
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

  public function index()
  {
      echo 'xxxx';
  }

  public function InfoPictureBranch()
  {
    $get = $this->input->get();
   // $post = $this->input->post();

    $res = array(
        'status' => FALSE,
        'msg' => '',
    );

    if (isset($get['param'])) {
        $info = $this->PictureModel->infoPictureBranch();
        if ($info) {
            $res['status'] = true;
            $res['data'] = $info;
        } else {
            $res['msg'] = "branch is not exist.";
        }
    } else {
        $res['msg'] = "user protocal get only.";
    }
    echo json_encode($res);
  }

  public function savePictureBranch()
  {
    $post = $this->input->post();

    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('PICsid', 'PICsid', 'required');

    if($this->form_validation->run() == FALSE){
      $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
    }else {
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

        if ($this->PictureModel->SaveBranch($post)) {
            $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
        }else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
      }
    }
  }

  public function showbyidPicture($picid)
  {
      $get = $this->input->get();
      if($get){
        if (isset($get['param'])) {
          $showby = $this->PictureModel->ShowbyidPicture($picid);
          if ($showby) {
            $url = base_url(uri_string());
            // $myapib = 'infobranch?param=true';
            // $bdata = gUrl($myapib, 'showpicbyid/');

            $cdata['mysession'] = $_SESSION;
            $cdata['branch'] = cUrl($this->config->item('apiBranch'), 'get');
            $cdata['chk'] = 'showbyidPicture';
            $cdata['shpicture'] = $showby;

            $this->load->view('employee/showdatahtml', $cdata);
          }
        }
      }
  }

  public function delbyidPicture($picid)
  {
    $get = $this->input->get();
    if($get){
      if (isset($get['param'])) {
        $showby = $this->PictureModel->ShowbyidPicture($picid);
        if ($showby) {
          $url = base_url(uri_string());
          // $myapib = 'infobranch?param=true';
          // $bdata = gUrl($myapib, 'showpicbyid/');

          $cdata['mysession'] = $_SESSION;
          $cdata['branch'] = cUrl($this->config->item('apiBranch'), 'get');
          $cdata['chk'] = 'delbyidPicture';
          $cdata['shpicture'] = $showby;

          $this->load->view('employee/showdatahtml', $cdata);
        }
      }
    }
  }

  public function editPicture()
  {
      $post = $this->input->post();

      if ($post) {
        $config['upload_path'] = './assets/img/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        // print_r($_FILES);
        // exit();
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

        $newdata = array(
          'PICid' => $post['editPICid'],
          'PICsid' => $post['editPICsid'],
          'PICname' => $pic,
          'PICnote' => $post['editPICnote']
        );

        if ($this->PictureModel->EditPicture($newdata)) {
          $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
        }else {
          $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }

      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
  }

  public function deletePicture()
  {
      $post = $this->input->post();

      if ($post) {
        if ($this->PictureModel->DeletePicture($post)) {
          $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
        }else {
          $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
  }

  public function deleteGroupPicture()
  {
      $post = $this->input->post();

      if ($post) {
        if ($this->PictureModel->DeletePictureByGroup($post)) {
            $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
        }
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }
  }

}
