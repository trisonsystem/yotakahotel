<?php

class HomeControllers extends CI_Controller {

    public function __construct() {
      parent::__construct();

      $this->SystemControl = new SystemControl();

      $this->load->model('SystemModel');
      $this->load->model('MainpageModel');
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

    public function index() {
        // $MyLang = $this->SystemControl->CheckYourIPapi();
        // $country = strtolower($MyLang->geoplugin_countryName);
        // if (!isset($_COOKIE['lang'])) {
        //     if ($country == 'thailand') {
        //         $lang = 'thailand';
        //     } else {
        //         $lang = 'english';
        //     }
        //     setcookie('lang', $lang);
        // } else {
        //     $lang = $_COOKIE['lang'];
        // }

//        redirect('subindex', 'auto');

        // $this->lang->load($lang, $lang);
        $this->load->model('BranchModel');

        $xdata['title'] = $this->SystemModel->Usecase('13');
        // $xdata['lang'] = $lang;
        // $xdata['mysession'] = $_SESSION;

        $ydata['slpic'] = $this->MainpageModel->showSlide();
        $ydata['branch'] = $this->BranchModel->SeInfoBranch();     
        // $zdata['boption'] = $this->MainpageModel->filterRoomByBranch();

        $mp['startpage'] = $this->load->view('layout/startpage', '', TRUE);
        $mp['topmenu'] = $this->load->view('layout/topmenu', $xdata, TRUE);
        $mp['slideshow'] = $this->load->view('layout/slideshow', $ydata, TRUE);
        $mp['navbar'] = $this->load->view('layout/navbar', '', TRUE);
        $mp['footer'] = $this->load->view('layout/footer', $ydata, TRUE);
        $mp['endpage'] = $this->load->view('layout/endpage', '', TRUE);

        $this->load->view('user/mainpage', $mp);
    }

    public function selectBranchBytypeSubtype($id){
      $get = $this->input->get();

      if ($get['param'] == TRUE) {
        $cdata['chk'] = 'selectBranchBytypeSubtype';
        // $myapi3 = $this->config->item('apiSubAndSubtype').$id;
        $cdata['boption'] = $this->MainpageModel->filterRoomByBranch($id);
        
        $this->load->view('user/showdatahtml', $cdata);
      }

    }

    // public function subindex() {
    //
    //     $lang = $_COOKIE['lang'];
    //     $this->lang->load($lang, $lang);
    //
    //     $xdata['title'] = $this->SystemModel->Usecase('13');
    //
    //     // $mp['startpage'] = $this->load->view('layout/startpage', '', TRUE);
    //     // $mp['topmenu'] = $this->load->view('layout/topmenu', $xdata, TRUE);
    //     // $mp['slideshow'] = $this->load->view('layout/slideshow', '', TRUE);
    //     // $mp['navbar'] = $this->load->view('layout/navbar', '', TRUE);
    //     // $mp['footer'] = $this->load->view('layout/footer', '', TRUE);
    //     // $mp['endpage'] = $this->load->view('layout/endpage', '', TRUE);
    //
    //     $this->load->view('user/mainpage', $mp);
    // }

}
