<?php

header("Content-type: text/plain; chrset=utf-8");
defined('BASEPATH') OR exit('No direct script access allowed');

class UsecaseController extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('CustomerModel');
        $this->load->model('SystemModel');
    }

    public function index() {
        echo 'Yotaka Hotel API Version 0.0.1';
    }

    public function SelectUsecase($uscuse){
        $get = $this->input->get();
        $post = $this->input->post();

        $res = array(
            'status' => FALSE,
            'msg' => '',
        );

        if ($get) {
            if (isset($get['param'])) {
                $showby = $this->SystemModel->Usecase($uscuse);

                if ($showby) {
                    $res['status'] = true;
                    $res['data'] = $showby;

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
}
