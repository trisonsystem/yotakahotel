<?php

class AboutasControllers extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('AboutasModel');
        $this->SystemControl = new SystemControl();

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

    public function index(){
        $aba['startpage'] = $this->load->view('layout/startpage', '', TRUE);
        $aba['topmenu'] = $this->load->view('layout/topmenu', '', TRUE);

        $aba['amenu'] = $this->AboutasModel->MenuInAbout();
        $aba['aindex'] = $this->AboutasModel->beginShowAbout();

        $aba['footer'] = $this->load->view('layout/footer', '', TRUE);
        $aba['endpage'] = $this->load->view('layout/endpage', '', TRUE);
        $this->load->view('user/aboutas', $aba);
    }

    public function showAboutasByID($id){
      $aba['startpage'] = $this->load->view('layout/startpage', '', TRUE);
      $aba['topmenu'] = $this->load->view('layout/topmenu', '', TRUE);

      $aba['amenu'] = $this->AboutasModel->MenuInAbout();
      $aba['aindex'] = $this->AboutasModel->beginShowAboutByID($id);

      $aba['footer'] = $this->load->view('layout/footer', '', TRUE);
      $aba['endpage'] = $this->load->view('layout/endpage', '', TRUE);
      $this->load->view('user/aboutas', $aba);
    }


}
