<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ForgotpasswordModel extends CI_Model {

  /**
   * This function used to check the email before
   * @param string $email : This is email of the user
   */
  public function ForgotPassword($email)
  {
      $this->db->select('*, 101000 as TABid');
      $this->db->from('CUS');
      $this->db->where('CUSemail', $email);
      $query=$this->db->get();
      return $query->row_array();
  }

  public function sendpassword($data)
  {
      $email = $data['CUSemail'];
      // $query1=$this->db->query("SELECT *  from CUS where CUSemail = '".$email."' ");
      // $row=$query1->result_array();
      // debug($data);
      // exit();
      if (isset($data))
      {
        $passwordplain = "";
        $passwordplain  = rand(1000000000, mt_getrandmax());

        $newpass['CUSfawo'] = md5($passwordplain);
        $this->db->where('CUSemail', $email);
        $this->db->update('CUS', $newpass);
        $mail_message='Dear '.$data['CUSfname'] . '  ' . $data['CUSlname'].','. "\r\n";
        $mail_message.='Thanks for contacting regarding to forgot password,<br> Your forgot password <b>Password</b> is <b>'.$passwordplain.'</b>'."\r\n";
        $mail_message.='<br>Please Update your password.';
        $mail_message.='<br>Thanks & Regards';
        $mail_message.='<br>Your company name';
        debug($mail_message);
        exit();
        require 'PHPMailerAutoload.php';
        require 'class.phpmailer.php';
        $mail = new PHPMailer;
        $mail->IsSendmail();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "hostname";
        $subject = 'Testing Email';
        $mail->AddAddress($email);
        $mail->IsMail();
        $mail->From = 'admin@***.com';
        $mail->FromName = 'admin';
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $mail_message;
        $mail->Send();

        if (!$mail->send()) {

            echo "<script>alert('msg','Failed to send password, please try again!')</script>";
        } else {

            echo "<script>alert('msg','Password sent to your email!')</script>";
        }
        redirect(base_url().'Jobseeker/index','refresh');
        }
        else
        {

            echo "<script>alert('msg','Email not found try again!')</script>";
            redirect(base_url().'Jobseeker/index','refresh');
        }
  }

  function selectUser($id, $password){
    $this->db->select('*, 101000 as TABid');
    $this->db->from('CUS');
    $this->db->where('CUSid', $id);
    $this->db->where('CUSdelete', 0);
    $query = $this->db->get();

    $row = $query->row_array();

    return $row;
  }

  function infoPassword($id){
    $this->db->select('CUSpawo');
    $this->db->from('CUS');
    $this->db->where('CUSid', $id);
    $this->db->where('CUSdelete', 0);
    $query = $this->db->get();

    $row = $query->row_array();

    return $row;
  }

  function updatePassword($id, $npass){
    $data = array(
      'CUSpawo' => getHashedPassword($npass),
    );

    $this->db->where('CUSid', $id);
    $this->db->update('CUS', $data);
    return true;
  }

}
