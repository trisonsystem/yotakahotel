<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MyuserguideController extends CI_Controller {

//    public function __construct() {
//        parent::__construct();
//    }

    public function index() {

        $xparam = '[ get : "true" post : "false" ]';

        $data['branchapi'][0] = array(
            'name' => 'SELECT *',
            'api' => gUrl('infobranch', 'myapi'),
            'method' => '[ "get" , "" ]',
            'param' => $xparam,
            'example' => ''
        );

        $data['branchapi'][1] = array(
            'name' => 'EDIT BY ID',
            'api' => gUrl('ebranch', 'myapi'),
            'method' => '[ "get" , "post" ]',
            'param' => $xparam,
            'example' => ''
        );

        $data['branchapi'][2] = array(
            'name' => 'SAVE',
            'api' => gUrl('sbranch', 'myapi'),
            'method' => '[ "" , "post" ]',
            'param' => $xparam,
            'example' => ''
        );

        $data['branchapi'][3] = array(
            'name' => 'DELETE BY ID',
            'api' => gUrl('dbranch', 'myapi'),
            'method' => '[ "" , "post" ]',
            'param' => $xparam,
            'example' => ''
        );

        $data['branchapi'][3] = array(
            'name' => 'DELETE GROUP',
            'api' => gUrl('dgbranch', 'myapi'),
            'method' => '[ "" , "post" ]',
            'param' => $xparam,
            'example' => ''
        );

        $data['branchapi'][4] = array(
            'name' => 'SHOW BY ID',
            'api' => gUrl('showbyid', 'myapi'),
            'method' => ' ["get" , "post"] ',
            'param' => $xparam,
            'example' => ''
        );

        $data['customerapi'][0] = array(
            'name' => 'SELECT *',
            'api' => gUrl('infocustomer', 'myapi'),
            'method' => ' ["get" , ""] ',
            'param' => $xparam,
            'example' => ''
        );

        $data['customerapi'][1] = array(
            'name' => 'SAVE CUSTOMER',
            'api' => gUrl('scustomer', 'myapi'),
            'method' => ' ["get" , "post"] ',
            'param' => $xparam,
            'example' => ''
        );

        $data['customerapi'][2] = array(
            'name' => 'EDIT CUSTOMER BY ID',
            'api' => gUrl('ecustomer', 'myapi'),
            'method' => ' ["get" , "post"] ',
            'param' => $xparam,
            'example' => ''
        );

        $data['customerapi'][3] = array(
            'name' => 'DELETE CUSTOMER BY ID',
            'api' => gUrl('dcustomer', 'myapi'),
            'method' => ' ["" , "post"] ',
            'param' => $xparam,
            'example' => ''
        );

        $data['customerapi'][4] = array(
            'name' => 'DELETE CUSTOMER GROUP ',
            'api' => gUrl('dgcustomer', 'myapi'),
            'method' => ' ["" , "post"] ',
            'param' => $xparam,
            'example' => ''
        );

        $data['customerapi'][5] = array(
            'name' => 'SHOW BY ID CUSTOMER',
            'api' => gUrl('showcusbyid', 'myapi'),
            'method' => ' ["get" , ""] ',
            'param' => $xparam,
            'example' => '/id?parameter'
        );
        
        $data['customerapi'][6] = array(
            'name' => 'SHOW BY ID CARD OR PASSPORT NUMBER',
            'api' => gUrl('showcusbyidc', 'myapi'),
            'method' => ' ["get" , ""] ',
            'param' => $xparam,
            'example' => '/idcard or passport number?parameter'
        );

        $data['usecaseapi'][6] = array(
            'name' => 'SHOW USECASE SELECT BY ID ',
            'api' => gUrl('usecase', 'myapi'),
            'method' => ' ["get" , ""] ',
            'param' => $xparam,
            'example' => '/Use case?parameter'
        );

        $this->load->view('api/myuserguide', $data);
    }

}
