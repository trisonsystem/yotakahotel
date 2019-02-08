<?php

header("Content-type: text/plain; chrset=utf-8");
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CommentModel');

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


    public function infoComment() {
        $get = $this->input->get();
//        $post = $this->input->post();

        $res = array(
            'status' => FALSE,
            'msg' => '',
        );

        if (isset($get['param'])) {
            $info = $this->CommentModel->SeInfoComment();

            if ($info) {
                $res['status'] = true;
                $res['data'] = $info;
            } else {
                $res['msg'] = "branch is not exist.";
            }
        } else {
            $res['msg'] = "Comment protocal get only.";
        }

        echo json_encode($res);
    }

    public function sentCommentToCustomer($cid){
      $get = $this->input->get();

      if($get){
        if (isset($get['param'])) {
          // http://122.155.201.37/adminYotaka/api/email?sendTo=kwang143001@gmail.com&Titel=test%20sen&form=confirm&cc=nat_taw_ut001@hmail.co.th&conten=%22test%22
          $cdata['mycomment'] = $this->CommentModel->ShowCommentByID($cid);
          $cdata['mysession'] = $_SESSION;
          $cdata['chk'] = 'sentCommentToCustomer';

          $this->load->view('employee/showdatahtml', $cdata);

        }
      }
    }

    public function saveToCustomer(){
      $post = $this->input->post();

      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->form_validation->set_rules('CMEresmessage', 'CMEresmessage', 'required');

      if(($this->form_validation->run() == TRUE) && $post){
        if ($oldcomment = $this->CommentModel->SaveCommentAndSend($post)) {
          $ctent = '<h2>Yotaka Hotel</h2>
                    <p><b>Reply your comment (ตอบกลับความคิดเห็น) :</b></p><br>
                    <div class="media border p-3">
                      <img src="https://new.yotakagroup.com/assets/img/mem1.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                      <div class="media-body">
                        <h4> '. $post['CMEname'] .' <small><i>Posted on '. $post['CMEcomdate'] .'</i></small></h4>
                        <p>'. $post['CMEcomment'] .'</p>
                        <hr>
                        <div class="media p-3 ">
                          <img src="https://new.yotakagroup.com/assets/img/mem2.png" alt="Jane Doe" class="mr-3 mt-3 rounded-circle" style="width:45px;">
                          <div class="media-body">
                            <h4>Mr. Yotaka Hotel <small><i>Posted on '. date("Y-F-d", strtotime($oldcomment['CMEcomdate'])) .'</i></small></h4>
                            <p>'. $oldcomment['CMEresmessage'] .'</p>
                          </div>
                        </div>
                      </div>
                    </div>';

          $strsend = sentEmailToCustomer($oldcomment['CMEemail'], 'Yotaka Hotel : Reply your comment (ตอบกลับความคิดเห็น)', adminAPI('mEmail'), adminAPI('mEmail'), $ctent);
          $ssecess = cUrlAdmin($strsend, 'get');

          $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
        }else {
          $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }


    }

}
