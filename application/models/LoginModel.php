<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoginModel extends CI_Model {

    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($user, $password) {

        $this->db->select('*, 101000 as TABid');
        $this->db->from('CUS');
        $this->db->where('CUSuname', $user);
        $this->db->where('CUSdelete', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $cus = $query->row();
            
            if (!empty($cus)) {
                if (verifyHashedPassword($password, $cus->CUSpawo)) {
                    return $cus;      
                } else {
                    return array();
                }
            } else {
                return array();
            }
        } else {
            $this->db->select('*, 102000 as TABid');
            $this->db->from('PER');
            $this->db->where('PERuname', $user);
            $this->db->where('PERdelete', 0);
            $query = $this->db->get();
                
            $per = $query->row();
            
            if (!empty($per)) {
                if (verifyHashedPassword($password, $per->PERpawo)) {
                    return $per;
                } else {
                    return array();
                }
            } else {
                return array();
            }
        }
    }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email) {
        $this->db->select('userId');
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data) {
        $result = $this->db->insert('tbl_reset_password', $data);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByEmail($email) {
        $this->db->select('userId, email, name');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $email : Email id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($email, $activation_id) {
        $this->db->select('id');
        $this->db->from('tbl_reset_password');
        $this->db->where('email', $email);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // This function used to create new password by reset link
    function createPasswordUser($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', array('password' => getHashedPassword($password)));
        $this->db->delete('tbl_reset_password', array('email' => $email));
    }

    /**
     * This function used to save login information of user
     * @param array $loginInfo : This is users login information
     */
    function lastLogin($loginInfo) {
//        echo '<pre>';
//        print_r($loginInfo);
//        echo '</pre>';
//        exit();
        $this->db->trans_start();
        $this->db->insert('SLOG1', $loginInfo);
        $this->db->trans_complete();
    }

    /**
     * This function is used to get last login info by user id
     * @param number $userId : This is user id
     * @return number $result : This is query result
     */
    function lastLoginInfo($userId) {
//        echo $userId;
//        exit();
        $this->db->select('BaseTbl.SLOG1createdDT');
        $this->db->where('BaseTbl.SLOG1useid', $userId);
        $this->db->order_by('BaseTbl.SLOG1id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('SLOG1 as BaseTbl');
//        echo '<pre>';
//        print_r($query);
//        echo '</pre>';
//        exit();
        return $query->row();
    }

}
