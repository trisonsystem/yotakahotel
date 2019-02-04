<?php

header("Content-type: text/plain; chrset=utf-8");
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerModel');
        $this->load->model('SystemModel');
    }

//    no api
    public function RegisterCustomer() {
        $post = $this->input->post();
        $data = array(
            'status' => FALSE,
            'data' => '',
            'msg' => ''
        );

        $rcus = $this->SystemModel->CheckSumCUS($post['CUSuname']);
        $rper = $this->SystemModel->CheckSumPER($post['CUSuname']);

        if (($rcus == 0) && ($rper == 0)) {

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('CUSpawo', 'Password', 'required');
            $this->form_validation->set_rules('CUSconfpass', 'Password Confirmation', 'required|matches[CUSpawo]');

            if ($this->form_validation->run() == FALSE) {
                $res['status'] = FALSE;
                $res['msg'] = "user protocal post only.";
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            } else {
                if ($this->CustomerModel->CustomerRegister($post)) {
                    $res['status'] = TRUE;
                }
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            }
            redirect('index');
//            echo json_encode($res);
        } else {

            $this->session->set_flashdata('error', 'This username is not available.');
            redirect('index');
        }
    }

    public function ForgotPassword() {
        $post = $this->input->post();
        $data = array(
            'status' => FALSE,
            'data' => '',
            'msg' => ''
        );

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('');
    }

    public function infoCustomer() {
        $get = $this->input->get();
        $post = $this->input->post();

        $res = array(
            'status' => FALSE,
            'msg' => '',
        );

        if ($get) {
            if (isset($get['param'])) {
                $info = $this->CustomerModel->SeInfoCustomer();
                if ($info) {
                    $res['status'] = true;
                    $res['data'] = $info;
                } else {
                    $res['msg'] = "Customer is not exist.";
                }
            } else {
                $res['msg'] = "Customer protocal get only.";
            }
        } elseif ($post) {
            $res['msg'] = "Customer protocal post only.";
        } else {
            $res['msg'] = "Please check type is post or get.";
        }

        echo json_encode($res);
    }

    public function saveCustomer() {
        $get = $this->input->get();
        $post = $this->input->post();

        $res = array(
            'status' => FALSE,
            'msg' => '',
        );

        ## check param
        // $arrParam = array('CUSidc', 'CUSuname', 'CUSidc', 'CUSemail');
        // foreach ($arrParam as $key) {
        //    if(!isset($post[$key])){
        //     $arrRetrun = array( "status"=>false, "msg"=>"Parameter Error ".$key);
        //     echo json_encode($arrRetrun);
        //     return;
        //    }
        // }
        ## --

        $rcusidc = $this->SystemModel->CheckSumPassIdcCUS($post['CUSidc'], 0);
        $rcus = $this->SystemModel->CheckSumCUS($post['CUSuname']);
        $rper = $this->SystemModel->CheckSumPER($post['CUSuname']);
        $tot = $rcusidc + $rcus + $rper;

        if ($post && $tot == 0) {
            // $info = $this->CustomerModel->saveCustomer($post);
            if ($this->CustomerModel->saveCustomer($post)) {
                $res['status'] = true;
                // $res['data'] = $info;
            } else {
                $res['status'] = false;
                $res['msg'] = "Customer is not exist.";
            }
        } else {
          if ($rcusidc > 0) {
            $res['msg'] = "Please check ID Card or Passport No.";
          }elseif ($rcus > 0 or $rper > 0) {
            $res['msg'] = "Please check Username";
          }else {
            $res['msg'] = "Please check type is post or get.";
          }
        }

        echo json_encode($res);
    }

    public function showbyidCustomer($cusid) {
        $get = $this->input->get();

        $res = array(
            'status' => false,
            'msg' => '',
        );

        if ($get) {
            if (isset($get['param'])) {
                $showby = $this->CustomerModel->ShowbyidCustomer($cusid);

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
            $res['msg'] = "branch protocal post only.";
        } else {
            $res['msg'] = "Please check type is post or get.";
        }

        echo json_encode($res);
    }

    public function showbyIDC($idc) {
        $get = $this->input->get();
        $post = $this->input->post();
        $res = array(
            'status' => false,
            'msg' => '',
        );

        if ($get) {
            if (isset($get['param'])) {
                $showby = $this->CustomerModel->ShowbyidcardCustomer($idc);
                $picurl = $this->config->item('mypathpic');
                
                if ($showby) {
                    $res['status'] = true;
                    $res['data'] = $showby;
                    $res['data']['picurl'] = $picurl . $res['data']['CUSpic'];
                } else {
                    $res['msg'] = "id card and passport no is not exist.";
                }
            } else {
                $res['msg'] = "id card and passport no is not exist.";
            }
        } elseif ($post) {
            $res['msg'] = "id card and passport no protocal post only.";
        } else {
            $res['msg'] = "Please check type is post or get.";
        }

        echo json_encode($res);
    }

    public function editCustomer() {
        $get = $this->input->get();
        $post = $this->input->post();
        $res = array(
            'status' => false,
            'msg' => '',
        );
        
        ## check param
        // $arrParam = array('CUSidc', 'CUSuname', 'CUSidc', 'CUSemail');
        // foreach ($arrParam as $key) {
        //    if(!isset($post[$key])){
        //     $arrRetrun = array( "status"=>false, "msg"=>"Parameter Error ".$key);
        //     echo json_encode($arrRetrun);
        //     return;
        //    }
        // }
        ## --

        $rcusidc = $this->SystemModel->CheckSumPassIdcCUS($post['editCUSidc'], $post['editCUSid']);
        $rcus = $this->SystemModel->CheckSumCUS($post['editCUSuname']);
        $rper = $this->SystemModel->CheckSumPER($post['editCUSuname']);
        $tot = $rcusidc + $rcus + $rper;

        if ($post && $tot == 0) {
            $config['upload_path'] = './assets/img/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            if (isset($_FILES['editCUSpic']['name']) == '') {
                $post['pic'] = $post['eCUSpic'];  //no img
            } else {
                if ($this->upload->do_upload('editCUSpic')) {
                    $img = $this->upload->data();
                    $post['pic'] = $img['file_name'];
                } else {
                    $post['pic'] = $post['eCUSpic'];
                }
            }

            if ($_SESSION['isLoggedIn'] == TRUE) {
                $PERsession = $_SESSION;
                $post['PERsession_id'] = $PERsession['id'];
            } else {
                $post['PERsession_id'] = '00';
            }

            if ($this->CustomerModel->EditCustomer($post)) {
                $res['status'] = true;
            }
        } elseif ($get) {
            $res['msg'] = "branch protocal get only.";
        } else {
            $res['msg'] = "Please check type is post or get.";
        }

        echo json_encode($res);
    }

    public function deleteCustomer() {
        $get = $this->input->get();
        $post = $this->input->post();
        $res = array(
            'status' => false,
            'msg' => '',
        );

        ## check param
        $arrParam = array('CUSidc');
        foreach ($arrParam as $key) {
           if(!isset($post[$key])){
            $arrRetrun = array( "status"=>false, "msg"=>"Parameter Error ".$key);
            echo json_encode($arrRetrun);
            return;
           }
        }
        ## --

        if ($post) {
            if (isset($post['delCUSid']) && $post['delCUSid'] != 1) {
                if ($this->CustomerModel->DeleteCustomer($post)) {
                    $res['status'] = true;
                }
            } else {
                $res['status'] = FALSE;
            }
        } elseif ($get) {
            $res['msg'] = "branch protocal get only.";
        } else {
            $res['msg'] = "Please check type is post or get.";
        }

        echo json_encode($res);
    }

    public function deleteCustomerByGroup(){

        $get = $this->input->get();
        $post = $this->input->post();
        $res = array(
            'status' => false,
            'msg' => '',
        );

        if ($post) {
            if ($this->CustomerModel->DeleteCustomerByGroup($post)) {
                $res['status'] = true;
            }
        } elseif ($get) {
            $res['msg'] = "branch protocal get only.";
        } else {
            $res['msg'] = "Please check type is post or get.";
        }
        echo json_encode($res);
    }

}
