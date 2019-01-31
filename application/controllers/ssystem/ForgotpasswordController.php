<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class ForgotpasswordController extends BaseController {

  public function __construct(){
    parent::__construct();
    $this->SystemControl = new SystemControl();
    $this->load->model('ForgotpasswordModel');
    $this->load->model('LoginModel');
  }

  public function ForgotPassword()
  {
      $email = $this->input->post('email');
      $findemail = $this->ForgotpasswordModel->ForgotPassword($email);
      if ($findemail) {
          $this->ForgotpasswordModel->sendpassword($findemail);
      } else {
          // echo "<script>alert(' $email not found, please enter correct email id')</script>";
          $this->session->set_flashdata('error', $email . '  not found please enter correct email id');
          redirect('/HomeControllers');
      }
  }

  public function ResetPassword(){
    $post = $this->input->post();
    // $this->session->sess_destroy();

    $oldpass = $this->ForgotpasswordModel->infoPassword($post['cid']);

    if (verifyHashedPassword($post['ocpass'], $oldpass['CUSpawo'])) {
      $update = $this->ForgotpasswordModel->updatePassword($post['cid'], $post['cpass']);
      if ($update == true) {
        $result = $this->ForgotpasswordModel->selectUser($post['cid'], $post['cpass']);
        $jpubip = $this->SystemControl->CheckYourIPapi();
        $lastlang = strtolower($jpubip->geoplugin_countryName);

        if (!empty($result)) {
          $sessionArray = array(
              'id' => $result['CUSid'],
              'code' => $result['CUScode'],
              'idcard' => $result['CUSidc'],
              'title' => $result['CUStitle'],
              'fname' => $result['CUSfname'],
              'lname' => $result['CUSlname'],
              'adr' => $result['CUSadr'],
              'email' => $result['CUSemail'],
              'phone' => $result['CUSnphone'],
              'picid' => '',
              'level' => $result['CUStype'],
              'brhid' => $result['CUSbrhid'],
              'tabid' => $result['TABid'],
              'deflang' => $lastlang,
              'isLoggedIn' => TRUE
          );
        }

        $cid = $sessionArray['id'];
        $this->session->set_userdata($sessionArray);
        unset($sessionArray['id'], $sessionArray['isLoggedIn']);

        $loginInfo = array(
            'SLOG1useid' => $cid,
            'SLOG1tabid' => $result['TABid'],
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
        // redirect('/HomeControllers');
      }
    }else{
      echo "false";
    }

    exit();

  }

}
