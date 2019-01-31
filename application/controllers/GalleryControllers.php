<?php

class GalleryControllers extends CI_Controller{
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

        $this->load->model('GalleryModel');
    }

    public function index(){
      $url = base_url(uri_string());
      $myapib = 'infobranch?param=true';
      $bdata = gUrl($myapib, 'gallery');

      $glr['startpage'] = $this->load->view('layout/startpage', '', TRUE);
      $glr['topmenu'] = $this->load->view('layout/topmenu', '', TRUE);

      // $glr['branch'] = cUrl($bdata, 'get');
      $glr['xdata'] = $this->GalleryModel->showGalleryByBranch();

      $glr['footer'] = $this->load->view('layout/footer', '', TRUE);
      $glr['endpage'] = $this->load->view('layout/endpage', '', TRUE);
      $this->load->view('user/gallery', $glr);
    }

}
