<?php

class PromotionsControllers extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('PromotionsModel');
        $this->SystemControl = new SystemControl();
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
        $glr['startpage'] = $this->load->view('layout/startpage', '', TRUE);
        $glr['topmenu'] = $this->load->view('layout/topmenu', '', TRUE);
        // $glr['data'] = $this->PromotionsModel->infoPromotions();
        $glr['footer'] = $this->load->view('layout/footer', '', TRUE);
        $glr['endpage'] = $this->load->view('layout/endpage', '', TRUE);

        $glr['promotions'] = $this->PromotionsModel->infoPromotions();
        $this->load->view('user/promotions', $glr);
//         $this->load->view('user/promotions');
    }

    public function showEvents($code){
        $ev['data'] = $this->PromotionsModel->infoPromotions();
        //0:TH / 1:EN
        $data_events = array();
        foreach($ev['data'] as $key => $value){
            $rand = '#'.str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
            if ($code == 0) {
                $data_events[] = array(
                    "id"=> $value['POMid'],
                    "title" => $value['POMdescTH'],
                    "start" => $value['POMstartDT'],
                    "end" => $value['POMendDT'],
                    "color" => $rand
                );
            }else {
                $data_events[] = array(
                    "id"=> $value['POMid'],
                    "title" => $value['POMdescEN'],
                    "start" => $value['POMstartDT'],
                    "end" => $value['POMendDT'],
                    "color" => $rand
                );
            }            
        }
        echo json_encode($data_events);     
        exit();
    }

    public function getEvents($id){
        $get = $this->input->get();

        if($get){
            if (isset($get['param'])) {
                $showby = $this->PromotionsModel->ShowbyidPromotion($id);
                
                if ($showby) {
                    // $this->load->model('BranchModel');
                    $cdata['mysession'] = $_SESSION;
                    // $cdata['branch'] = $this->BranchModel->SeInfoBranch();
                    $cdata['chk'] = 'getEvents';
                    $cdata['epromotion'] = $showby;

                    $this->load->view('user/showdatahtml', $cdata);
                }
            }
        }
    }

    public function get_detail_pomotion(){
        $showby = $this->PromotionsModel->ShowbyidPromotion($_GET['id']);
        print_r( json_encode( $showby[0]) );
    }
}
