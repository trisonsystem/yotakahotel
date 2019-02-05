<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class EmpmainpageControllers extends BaseController {

    public function __construct() {
        parent::__construct();

        $this->SystemControl = new SystemControl();

        $this->load->model('SystemModel');
        // $this->load->model('RoomModel');
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
        // echo $this->lang->line("M1001");
        // exit();
    }

    public function index() {
        $cdata['xurl'] = '';

        $mp['startpage'] = $this->load->view('layout/emp/startpage', '', TRUE);
        $mp['menu'] = $this->load->view('layout/emp/menu', '', TRUE);

        $mp['content'] = $this->load->view('employee/branchmanagement', $cdata, TRUE);

        $mp['footer'] = $this->load->view('layout/emp/footer', '', TRUE);
        $mp['endpage'] = $this->load->view('layout/emp/endpage', '', TRUE);
        $this->load->view('employee/empmainpage', $mp);
    }

    public function empcontent($menunumber) {
        $this->load->model('SystemModel');

        switch ($menunumber) {
            case 'M0000':
                $cview = 'mainpage';
                // $cdata['datafromapi'] = cUrl($this->config->item('apiBranch'), 'get');
                break;

            case 'M0001':
                $this->load->model('MainpageModel');
                $cview = 'mage_mainpage_slideshow';
                $cdata['pslide'] = $this->MainpageModel->InfoSlide();
                // $cdata['xpslide'] = $this->MainpageModel->xInfoSlide();
                $cdata['xdate'] = $this->SystemModel->MaxDateTime('BRH');
                $cdata['startpage'] = $this->load->view('layout/startpage', '', TRUE);
                $cdata['endpage'] = $this->load->view('layout/endpage', '', TRUE);
                break;

            case 'M1001':
                $this->load->model('BranchModel');
                $cview = 'branchmanagement';                
                $cdata['xdate'] = $this->SystemModel->MaxDateTime('BRH');
                $cdata['datafromapi'] = $this->BranchModel->SeInfoBranch();
                break;

            case 'M2001':
                $this->load->model('CustomerModel');
                $cview = 'customermanagement';
                $cdata['xdate'] = $this->SystemModel->MaxDateTime('CUS');
                $cdata['custype'] = $this->SystemModel->Usecase('11');
                $cdata['titlename'] = $this->SystemModel->Usecase('13');
                // $cdata['datafromapi'] = cUrl($this->config->item('apiCustomer'), 'get');
                $cdata['datafromapi'] = $this->CustomerModel->SeInfoCustomer();
                break;

            case 'M3001':
                $this->load->model('BranchModel');
                $this->load->model('RoomModel');
                $cview = 'roommanagement';
                $cdata['xdate'] = $this->SystemModel->MaxDateTime('ROM');
                $cdata['branch'] = $this->RoomModel->countRoomFromBarnch();                
                $cdata['room'] = $this->RoomModel->getRoomByid(0);
                break;

            case 'M3002':
                $this->load->model('BranchModel');
                $this->load->model('AccessoriesModel');
                $cdata['access'] = $this->AccessoriesModel->infoAccessories(); 
                $cdata['xdate'] = $this->SystemModel->MaxDateTime('RAS');
                $cdata['branch'] = $this->BranchModel->SeInfoBranch();
                $cdata['warranty'] = $this->SystemModel->Usecase('30');
                $cview = 'accessoriesmanagement';
                break;

            case 'M4001':
                $this->load->model('BranchModel');
                $this->load->model('CommentModel');
                $cview = 'commentmanagement';

                $cdata['custype'] = $this->SystemModel->Usecase('29');
                $cdata['branch'] = $this->BranchModel->SeInfoBranch();
                $cdata['datafromapi'] = $this->CommentModel->SeInfoComment();
                
                break;

            case 'M5001':
                $this->load->model('BranchModel');
                $this->load->model('PictureModel');

                $cview = 'bookingmanagementpic';
                $cdata['branch'] = $this->BranchModel->SeInfoBranch();
                $cdata['xdate'] = $this->SystemModel->MaxDateTimeWhere('PIC', 1);
                $cdata['datafromapi'] = $this->PictureModel->infoPictureBranch();
                break;

            case 'M5002':
                $this->load->model('BookingusepageModel');
                $this->load->model('BranchModel');
                $cview = 'bookingmanagementpbooking';

                $cdata['branch'] = $this->BranchModel->SeInfoBranch();
                $cdata['xdate'] = $this->SystemModel->MaxDateTime('PU03');
                $cdata['datafromapi'] = $this->BookingusepageModel->infoBookingUsePage();
                break;

            case 'M6001':
                $this->load->model('AboutasModel');
                $cview = 'aboutasmanagement';
                $cdata['xdate'] = $this->SystemModel->MaxDateTime('PU01');
                $cdata['allaboutas'] = $this->AboutasModel->infoAboutas();
                break;

            case 'M7001':
                $this->load->model('GalleryModel');
                $this->load->model('BranchModel');
                $cview = 'gallerymanagement';
                $cdata['branch'] = $this->BranchModel->SeInfoBranch();
                $cdata['dgallery'] = $this->GalleryModel->infoGallery();                
                $cdata['xdate'] = $this->SystemModel->MaxDateTime('PU04');
                break;

            case 'M7002':
                $this->load->model('GalleryModel');
                $this->load->model('BranchModel');
                $cview = 'gallerymanagementpic';
                $cdata['branch'] = $this->BranchModel->SeInfoBranch();
                $cdata['dgallery'] = $this->GalleryModel->infoGallery();
                $cdata['xdate'] = $this->SystemModel->MaxDateTime('PU04');
                break;

            case 'M8001':
                $this->load->model('PromotionsModel');
                $this->load->model('BranchModel');
                $cview = 'promotionmanagement';
                $cdata['promotion'] = $this->PromotionsModel->infoPromotions();
                $cdata['branch'] = $this->BranchModel->SeInfoBranch();       
                $cdata['xdate'] = $this->SystemModel->MaxDateTime('POM');     
                break;

            case 'M9001':
                $this->load->model('PersonnelModel');
                $this->load->model('BranchModel');
                $this->load->model('DepartmentModel');
                $cview = 'personnelmanagement';
                $cdata['personnel'] = $this->PersonnelModel->infoPersonnelModel(); 
                $cdata['titlename'] = $this->SystemModel->Usecase('13');
                $cdata['department'] = $this->DepartmentModel->infoDepartment();
                $cdata['branch'] = $this->BranchModel->SeInfoBranch();
                $cdata['xdate'] = $this->SystemModel->MaxDateTime('PER');
                $cdata['ses'] = $_SESSION;
                break;

            case 'M1101':
                if ($_SESSION['isLoggedIn'] != TRUE) {
                    $this->logout();
                }

                $this->load->model('BookingModel');
                $cview = 'frontoffice_booking';
                $cdata['custype'] = $this->SystemModel->Usecase('11');
                
                $cdata['titlename'] = $this->SystemModel->Usecase('13');
                $cdata['rooms'] = $this->BookingModel->getRoomsByBranchID($_SESSION['brhid']);
                $cdata['cusbill'] = $this->BookingModel->infoCustomerBill();
                // debug($cdata['cusbill']);
                // exit();
                
                break;

            case 'M1102':
                $this->load->model('BookingModel');
                $cview = 'bookingmanagement';
                $cdata['bbill'] = $this->BookingModel->infoBillBooking();                
                break;

            default:
                echo 'Press check your menu number file --> views/layout/emp/menu.php';
                exit();
                break;
        }

        if ($_SESSION['isLoggedIn'] == TRUE) {

            $cdata['mysession'] = $_SESSION;
            $mp['startpage'] = $this->load->view('layout/emp/startpage', '', TRUE);
            $mp['menu'] = $this->load->view('layout/emp/menu', $_SESSION, TRUE);            
            $mp['content'] = $this->load->view('employee/' . $cview, $cdata, TRUE);
            $mp['footer'] = $this->load->view('layout/emp/footer', '', TRUE);
            $mp['endpage'] = $this->load->view('layout/emp/endpage', '', TRUE);
            
            $this->load->view('employee/empmainpage', $mp);
        } else {
            $this->logout();
        }
    }

    //    **************************************************    Branch to api
    public function showBranchByID($id) {
        $this->load->model('BranchModel');
        // $xapi = gUrl('showbyid/' . $id, 'editbranch/');
        $cdata['chk'] = 'showBranchByID';
        $cdata['shbranch'] = $this->BranchModel->aShowbyidBranch($id);

        $this->load->view('employee/showdatahtml', $cdata);
    }

    public function deleteBranchByID($id) {
        $this->load->model('BranchModel');
        // $xapi = gUrl('showbyid/' . $id, 'delbranch/');
        $cdata['chk'] = 'deleteBranchByID';
        $cdata['shbranch'] = $this->BranchModel->aShowbyidBranch($id);
        $cdata['mysession'] = $_SESSION;

        $this->load->view('employee/showdatahtml', $cdata);       
    }
  
//    **************************************************    Customer to api
    public function saveCustomer() {
        $post = $this->input->post();

        // exit();
        // $this->load->helper(array('form', 'url'));
        // $this->load->library('form_validation');
        // $this->form_validation->set_rules('CUSidc', 'CUSidc', 'required');
        // $this->form_validation->set_rules('CUStitle', 'CUStitle', 'required');
        // $this->form_validation->set_rules('CUSfname', 'CUSfname', 'required');
        // $this->form_validation->set_rules('CUSlname', 'CUSlname', 'required');
        // $this->form_validation->set_rules('CUSadr', 'CUSadr', 'required');
        // $this->form_validation->set_rules('CUSzipc', 'CUSzipc', 'required');
        // $this->form_validation->set_rules('CUSbday', 'CUSbday', 'required');
        // $this->form_validation->set_rules('CUSemail', 'CUSemail', 'valid_email');
        // $this->form_validation->set_rules('CUSnphone', 'CUSnphone', 'required|integer');
        // $this->form_validation->set_rules('CUSbrhid', 'CUSbrhid', 'required');
        $countEmail = $this->SystemModel->CheckSumCUS($post['CUSemail']);
        
        if ($post) {
            if ($_SESSION['isLoggedIn'] == TRUE) {

                $PERsession = $_SESSION;
                $np = date("Ymd", strtotime($post['CUSbday']));

                $data = array(
                    'CUSregonweb' => '0',
                    'CUSidc' => $post['CUSidc'],
                    'CUStitle' => $post['CUStitle'],
                    'CUSfname' => $post['CUSfname'],
                    'CUSlname' => $post['CUSlname'],
                    'CUSadr' => $post['CUSadr'],
                    'CUSzipc' => $post['CUSzipc'],
                    'CUSbday' => $post['CUSbday'],
                    'CUSemail' => $post['CUSemail'],
                    'CUSnphone' => $post['CUSnphone'],
                    'CUStype' => $post['CUStype'],
                    'CUSuname' => $post['CUSemail'],
                    'CUSpawo' => $np,
                    'CUSbrhid' => $PERsession['brhid'], //session
                    'CUScreatedBy' => $PERsession['code'], //session
                );
                
                if ($countEmail == 0) {
                    // $xapi = gUrl('/scustomer', '/savecustomer');
                    // $mypost = cUrl($this->config->item('apiScustomer'), 'post', $data);
                    $this->load->model('CustomerModel');
                    $this->CustomerModel->saveCustomer($data);
                    $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
                } else {
                    $this->session->set_flashdata('error', 'Please check your email. Can not record your email.');
                }
            } else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        } else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    public function showCustomerByID($id) {
        $this->load->model('CustomerModel');
        // $xapi = $this->config->item('apiShoCustomer') . $id;
        // debug($xapi);
        // exit();
        $cdata['chk'] = 'showCustomerByID';
        $cdata['shcustomer'] = $this->CustomerModel->ShowbyidCustomer($id);
        // $cdata['dcustype'] = $this->SystemModel->DefaultUsecase('11', json_decode($cdata['shcustomer'], true)['data']['CUStype']);
        // $cdata['dtitlename'] = $this->SystemModel->DefaultUsecase('13', json_decode($cdata['shcustomer'], true)['data']['CUStitle']);
        $cdata['custype'] = $this->SystemModel->Usecase('11');
        $cdata['titlename'] = $this->SystemModel->Usecase('13');
        $cdata['mysession'] = $_SESSION;

        $this->load->view('employee/showdatahtml', $cdata);
    }

    public function deleteCustomerByID($id) {
        if ($_SESSION['isLoggedIn'] == TRUE) {
            $xapi = $this->config->item('apiShoCustomer'). $id;
            $cdata['chk'] = 'deleteCustomerByID';

            $cdata['shcustomer'] = cUrl($xapi . '?param=true', 'get');
            $cdata['mysession'] = $_SESSION;

            $this->load->view('employee/showdatahtml', $cdata);
        } else {
            redirect('empmain/M0002');
        }
    }    

    public function roomByData($id){        
        $this->load->model('RoomModel');
        $this->load->model('BranchModel');
        $cdata['mysession'] = $_SESSION;
        $cdata['room'] = $this->RoomModel->getRoomByid($id); 
        $cdata['branchid'] = $this->BranchModel->aShowbyidBranch($id);
        $cdata['branch'] = $this->RoomModel->countRoomFromBarnch();
        // $cdata['nature'] = $this->SystemModel->Usecase('14');
        // $cdata['rtype'] = $this->SystemModel->Usecase('21');
        $cdata['xdate'] = $this->SystemModel->MaxDateTime('ROM');

        $mp['startpage'] = $this->load->view('layout/emp/startpage', '', TRUE);
        $mp['menu'] = $this->load->view('layout/emp/menu', $_SESSION, TRUE);
        $mp['content'] = $this->load->view('employee/' . 'roommanagement', $cdata, TRUE);
        $mp['footer'] = $this->load->view('layout/emp/footer', '', TRUE);
        $mp['endpage'] = $this->load->view('layout/emp/endpage', '', TRUE);

        $this->load->view('employee/empmainpage', $mp);
    }

}
