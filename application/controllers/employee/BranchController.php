<?php

header("Content-type: text/plain; chrset=utf-8");
defined('BASEPATH') OR exit('No direct script access allowed');

class BranchController extends CI_Controller {

    public function __construct() {
        parent::__construct();

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
        $this->load->model('BranchModel');
    }

    public function infoBranch() {
        $get = $this->input->get();
//        $post = $this->input->post();

        $res = array(
            'status' => FALSE,
            'msg' => '',
        );

        if (isset($get['param'])) {
            $info = $this->BranchModel->SeInfoBranch();
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

    public function showbyidBranch($brhid) {

        $get = $this->input->get();
        $post = $this->input->post();
        $res = array(
            'status' => FALSE,
            'msg' => '',
        );

        if ($get) {
            if (isset($get['param'])) {
                $showby = $this->BranchModel->ShowbyidBranch($brhid);
                if ($showby) {
                    $res['status'] = true;
                    $res['data'] = $showby;
                } else {
                    $res['msg'] = "username is not exist.";
                }
            } else {
                $res['msg'] = "username is not exist.";
            }
        } elseif ($post) {
            $showby = $this->BranchModel->ShowbyidBranch($brhid);
            if ($showby) {
                $res['status'] = true;
                $res['data'] = $showby;
            } else {
                $res['msg'] = "username is not exist.";
            }
        } else {
            $res['msg'] = "Please check type is post or get.";
        }
        echo json_encode($res);
    }

    public function saveBranch() {
        $get = $this->input->get();
        $post = $this->input->post();
        $res = array(
            'status' => false,
            'msg' => '',
            'data' => ''
        );
        
        ## check param
        // $arrParam = array('BRHdescTH', 'BRHdescEN', 'BRHadr', 'BRHzipc', 'BRHvnum', 'BRHemail', 'BRHnphone');
        // foreach ($arrParam as $key) {
        //    if(!isset($post[$key])){
        //     $arrRetrun = array( "status"=>false, "msg"=>"Parameter Error ".$key);
        //     echo json_encode($arrRetrun);
        //     return;
        //    }
        // }
        ## --

        if ($post) {

            // debug($_FILES);

            $config['upload_path'] = './assets/img/uploads/';
            // $config['upload_path'] = '122.155.201.37/yotakahotel/assets/img/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            // $this->load->library('upload', $config);
            // $this->upload->do_upload('BRHpic');
            // echo $this->upload->display_errors();

            // exit();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('BRHpic')) {
//                        $this->upload->do_upload($_FILES['BRHpic']['name']);
                $img = $this->upload->data();
                $post['BRHpic'] = $img['file_name'];
            } else {
                $post['BRHpic'] = 'no-image.png';
            }
            // debug($post);
            // exit();
            if ($lid = $this->BranchModel->RegisterBranch($post)) {
                $res['status'] = true;
                $res['data'] = $lid;
            }else {
                $res['status'] = false;
            }
        } elseif ($get) {
            $res['msg'] = "branch protocal get only.";
          } else {
            $res['msg'] = "Please check type is post or get.";
        }

        echo json_encode($res);
    }

    public function editBranch() {
        $get = $this->input->get();
        $post = $this->input->post();
        $res = array(
            'status' => false,
            'msg' => '',
        );

        ## check param
        // $arrParam = array('BRHid', 'BRHdescTH', 'BRHdescEN', 'BRHadr', 'BRHzipc', 'BRHvnum', 'BRHemail', 'BRHnphone');
        // foreach ($arrParam as $key) {
        //    if(!isset($post[$key])){
        //     $arrRetrun = array( "status"=>false, "msg"=>"Parameter Error ".$key);
        //     echo json_encode($arrRetrun);
        //     return;
        //    }
        // }
        ## --

        if ($post) {
            $config['upload_path'] = './assets/img/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            
            $this->load->library('upload', $config);

            // debug($_FILES);
            
            if (isset($_FILES['BRHpic']['name']) == '') {
                $pic = $post['eBRHpic'];  //no img
            } else {
                if ($this->upload->do_upload('BRHpic')) {
                    $img = $this->upload->data();
                    $pic = $img['file_name'];
                } else {
                    $pic = $post['eCUSpic'];
                }
            }

            if (isset($post['BRHbday'])) {
                $ddate = $post['eBRHbday'];
            } else {
                $ddate = $post['BRHbday'];
            }

            $newdata = array(
                'BRHid' => $post['BRHid'],
                // 'BRHcode' => $post['BRHcode'],
                'BRHdescTH' => $post['BRHdescTH'],
                'BRHdescEN' => $post['BRHdescEN'],
                'BRHadr' => $post['BRHadr'],
                'BRHpic' => $pic,
                'BRHzipc' => $post['BRHzipc'],
                'BRHvnum' => $post['BRHvnum'],
                'BRHbday' => $ddate,
                'BRHemail' => $post['BRHemail'],
                'BRHnphone' => $post['BRHnphone']
            );

            if ($this->BranchModel->EditBranch($newdata)) {
                $res['status'] = true;
            } else {
                $res['status'] = false;
            }
        } elseif ($get) {
            $res['msg'] = "branch protocal get only.";
        } else {
            $res['msg'] = "Please check type is post or get.";
        }

        echo json_encode($res);
    }

    public function deleteBranch() {
        // $get = $this->input->get();
        $post = $this->input->post();
        // debug($post);
        // exit();
        $res = array(
            'status' => false,
            'msg' => '',
        );

        ## check param
        // $arrParam = array('BRHid');
        // foreach ($arrParam as $key) {
        //    if(!isset($post[$key])){
        //     $arrRetrun = array( "status"=>false, "msg"=>"Parameter Error ".$key);
        //     echo json_encode($arrRetrun);
        //     return;
        //    }
        // }
        ## --

        if ($post) {
//            if (isset($post['delBRHid']) && $post['delBRHid'] != 1) {
            if ($this->BranchModel->DeleteBranch($post)) {
                $res['status'] = true;
            } else {
                $res['status'] = false;
            }
        } elseif ($get) {
            $res['msg'] = "branch protocal get only.";
        } else {
            $res['msg'] = "Please check type is post or get.";
        }

        echo json_encode($res);
    }

    public function deleteBranchByGroup() {
        $get = $this->input->get();
        $post = $this->input->post();
        $res = array(
            'status' => false,
            'msg' => '',
        );

        ## check param
        $arrParam = array('BRHid');
        foreach ($arrParam as $key) {
           if(!isset($post[$key])){
            $arrRetrun = array( "status"=>false, "msg"=>"Parameter Error ".$key);
            echo json_encode($arrRetrun);
            return;
           }
        }
        ## --

        if ($post) {
            if ($this->BranchModel->DeleteBranchByGroup($post)) {
                $res['status'] = true;
            }else {
                $res['status'] = false;
            }
        } elseif ($get) {
            $res['msg'] = "branch protocal get only.";
        } else {
            $res['msg'] = "Please check type is post or get.";
        }
        echo json_encode($res);
    }


}
