<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class SetLanguage extends BaseController {
    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->SystemControl = new SystemControl();
    }

    public function myLanguage($lg){
        // echo $lg;
        delete_cookie("lang");
        // // $this->input->resetCookie('lang');
        switch ($lg) {
            case 0:
                $lang = 'thailand';
                break;
            
            case 1:
                $lang = 'english';
                break;
        }
      
        // $this->load->helper('cookie');

        $name   = 'lang';
        $value  = $lang;
        $expire = time()+2000;
        $path  = '/';
        $secure = TRUE;

        setcookie($name,$value,$expire,$path);
        $this->lang->load($lang, $lang);
        echo $this->input->cookie('lang');
        
    }

   
}