<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class BranchmanagementControllers extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->SystemControl = new SystemControl();

        $this->load->model('SystemModel');
        $this->load->helper('cookie');
    }

    public function index() {
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

        $this->yourView();
    }

    public function yourView() {
        $mp['startpage'] = $this->load->view('layout/emp/startpage', '', TRUE);
        $mp['menu'] = $this->load->view('layout/emp/menu', '', TRUE);
        $mp['footer'] = $this->load->view('layout/emp/footer', '', TRUE);
        $mp['endpage'] = $this->load->view('layout/emp/endpage', '', TRUE);
        $this->load->view('employee/branchmanagement', $mp);
    }

}
