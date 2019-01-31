<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class SystemController extends BaseController{

    public function __construct(){
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
    }

}

 ?>
