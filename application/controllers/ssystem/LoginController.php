<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class LoginController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->load->model('LoginModel');
        $this->SystemControl = new SystemControl();
    }

    public function index() {
        $this->isLoggedIn();
    }

    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn() {

        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('/HomeControllers');
        } else {
            redirect('/empmain');
        }
    }

    /**
     * This function used to logged in user
     */
    public function loginMe() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('usr', 'User', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('pwd', 'Password', 'required|max_length[32]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $user = $this->security->xss_clean($this->input->post('usr'));
            $password = $this->input->post('pwd');
            $result = $this->LoginModel->loginMe($user, $password);
            $jpubip = $this->SystemControl->CheckYourIPapi();
            $lastlang = strtolower($jpubip->geoplugin_countryName);

            if (!empty($result)) {
                $mytb = $this->SystemControl->ChkMyuserFromTB($result->TABid);

                if ($mytb == 'PER') {
                    $lastLogin = $this->LoginModel->lastLoginInfo($result->PERid);

                    $sessionArray = array(
                        'id' => $result->PERid,
                        'code' => $result->PERcode,
                        'title' => $result->PERtitle,
                        'fname' => $result->PERfname,
                        'lname' => $result->PERlname,
//                        'depid' => $result->PERdepid,
                        'picid' => $result->PERpicid,
                        'level' => $result->PERlevel,
                        'brhid' => $result->PERbrhid,
                        'tabid' => $result->TABid,
                        'deflang' => $lastlang,
                        'isLoggedIn' => TRUE
//                        'lastLogin' => $lastLogin->SLOG1createdDT
                    );
                } elseif ($mytb == 'CUS') {

                    $lastLogin = $this->LoginModel->lastLoginInfo($result->CUSid);

                    $sessionArray = array(
                        'id' => $result->CUSid,
                        'code' => $result->CUScode,
                        'idcard' => $result->CUSidc,
                        'title' => $result->CUStitle,
                        'fname' => $result->CUSfname,
                        'lname' => $result->CUSlname,
                        'adr' => $result->CUSadr,
                        'email' => $result->CUSemail,
                        'phone' => $result->CUSnphone,
                        'picid' => '',
                        'level' => $result->CUStype,
                        'brhid' => $result->CUSbrhid,
                        'tabid' => $result->TABid,
                        'deflang' => $lastlang,
                        'isLoggedIn' => TRUE
//                        'lastLogin' => $lastLogin->SLOG1createdDT
                    );
//                    echo '<pre>';
//                    print_r($sessionArray);
//                    echo '</pre>';
//                    echo '<br>';
                } else {
                    $this->session->set_flashdata('error', 'Username or password mismatch');
                    redirect('/HomeControllers');
                }

                $cid = $sessionArray['id'];
                $this->session->set_userdata($sessionArray);

//*                unset($sessionArray['id'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);
                unset($sessionArray['id'], $sessionArray['isLoggedIn']);

                $loginInfo = array(
                    'SLOG1useid' => $cid,
                    'SLOG1tabid' => $result->TABid,
                    'SLOG1sesdata' => json_encode($sessionArray),
                    'SLOG1mahip' => $jpubip->geoplugin_request,
                    'SLOG1city' => $jpubip->geoplugin_city,
                    'SLOG1region' => $jpubip->geoplugin_city,
                    'SLOG1country' => $jpubip->geoplugin_countryName,
                    'SLOG1countrycode' => $jpubip->geoplugin_countryCode,
                    'SLOG1uagent' => getBrowserAgent(),
                    'SLOG1uagentstr' => $this->agent->agent_string(),
                    'SLOG1platf' => $this->agent->platform()
                );

                $this->LoginModel->lastLogin($loginInfo);

                if ($mytb == 'PER') {
                    redirect('/empmain/M1101');
                } else {
                    redirect('index');
                }
            } else {
                $apiAuth = array(
                    'UserName' => $this->input->post('usr'),
                    'Password' => $this->input->post('pwd')
                );

                $tapi = adminAPI('login');
//                echo $tapi.'<br>';
                $auth= cUrlAdmin($tapi, 'post', $apiAuth);
                $autUser = json_decode($auth, TRUE);
//                echo '<pre>';
//                print_r($autUser['token']);
//                 echo '</pre>';
//                echo '555555555';

//                echo date('Y-m-d H:i:s');
//                exit();
                if ($autUser['status'] == 1 || $autUser['status'] != '') {
                    $d = $autUser['data'];

                    $sessionArray = array(
                        'id' => $d['id'],
                        'code' => '',
                        'title' => '',
                        'fname' => $d['FirstName'],
                        'lname' => $d['LastName'],
//                        'depid' => $result->PERdepid,
                        'picid' => '',
                        'level' => $d['Position'],
                        'brhid' => $d['BranchID'],
                        'tabid' => '',
                        'deflang' => $lastlang,
                        'token' => $autUser['token'],
                        'isLoggedIn' => TRUE
//                        'lastLogin' => $lastLogin->SLOG1createdDT
                    );

                    $cid = $sessionArray['id'];
                    $this->session->set_userdata($sessionArray);

//*                unset($sessionArray['id'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);
                    unset($sessionArray['id'], $sessionArray['isLoggedIn']);

                    $loginInfo = array(
                        'SLOG1useid' => $cid,
                        'SLOG1tabid' => 'AdminAPI',
                        'SLOG1sesdata' => json_encode($sessionArray),
                        'SLOG1mahip' => $jpubip->geoplugin_request,
                        'SLOG1city' => $jpubip->geoplugin_city,
                        'SLOG1region' => $jpubip->geoplugin_city,
                        'SLOG1country' => $jpubip->geoplugin_countryName,
                        'SLOG1countrycode' => $jpubip->geoplugin_countryCode,
                        'SLOG1uagent' => getBrowserAgent(),
                        'SLOG1uagentstr' => $this->agent->agent_string(),
                        'SLOG1platf' => $this->agent->platform()
                    );
//                    debug($loginInfo);
//                    exit();
                    $this->LoginModel->lastLogin($loginInfo);


                    redirect('/empmain/M0000');
                } else {
                    $this->session->set_flashdata('error', 'Username or password mismatch');
                    // echo 'else';
                    // exit();
                    redirect('/HomeControllers');
                }
            }
        }
    }

}
