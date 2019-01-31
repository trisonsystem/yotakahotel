<?php

class BookingControllers extends CI_Controller{

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

        $this->load->model('PictureModel');
        $this->load->model('BookingusepageModel');
    }

    public function index(){
        $cdata['xurl'] = '';
        $bk['startpage'] = $this->load->view('layout/startpage', '', TRUE);
        $bk['topmenu'] = $this->load->view('layout/topmenu', '', TRUE);

        $bk['content'] = $this->load->view('user/showdatahtml', $cdata, TRUE);

        $bk['footer'] = $this->load->view('layout/footer', '', TRUE);
        $bk['endpage'] = $this->load->view('layout/endpage', '', TRUE);
        $this->load->view('user/booking', $bk);

    }

    // public function ShowBookingByBranch()
    // {
    //     $myapi = 'http://122.155.201.37/adminYotaka/api/rooms/get_roomallroomoption?data=1';
    //     $cdata = cUrlAdmin($myapi);
    //
    //     echo "<pre>";
    //     print_r(json_decode($cdata, true)['data']);
    //     echo "</pre>";
    //
    //     exit();
    // }

    public function ShowAllBookingPageByBranch($mycontent){
      $url = base_url(uri_string());
      $myapib = 'infobranch?param=true';
      $this->load->model('BranchModel');

      switch ($mycontent) {
        case 'Content0':
            $cdata['chk'] = 'Content0';
            $cdata['bcontent'] = $this->BookingusepageModel->ShowAllMyContent();
            break;

        case 'Content1':
          $cdata['chk'] = 'Content1';
          $get = $this->input->get();
          $cdata['bcontent'] = $this->BookingusepageModel->searchBookingPageBy($get['id']);
          break;

        default:
            echo 'Press check your menu number file --> views/layout/emp/menu.php';
            exit();
            break;
      }

      $bk['branch'] = $this->BranchModel->SeInfoBranch();
      // debug($bk['branch']);
      // exit();
      $bk['startpage'] = $this->load->view('layout/startpage', '', TRUE);
      $bk['topmenu'] = $this->load->view('layout/topmenu', '', TRUE);
      $bk['content'] = $this->load->view('user/showdatahtml', $cdata, TRUE);
      $bk['footer'] = $this->load->view('layout/footer', '', TRUE);
      $bk['endpage'] = $this->load->view('layout/endpage', '', TRUE);

      $this->load->view('user/booking', $bk);
    }

    public function ShowAllBookingPageByBranchs($id){
      $this->load->model('BranchModel');
      $cdata['chk'] = 'Content1';
      $cdata['bcontent'] = $this->BookingusepageModel->searchBookingPageBy($id);
      $bk['branch'] = $this->BranchModel->SeInfoBranch();
      $bk['startpage'] = $this->load->view('layout/startpage', '', TRUE);
      $bk['topmenu'] = $this->load->view('layout/topmenu', '', TRUE);
      $bk['content'] = $this->load->view('user/showdatahtml', $cdata, TRUE);
      $bk['footer'] = $this->load->view('layout/footer', '', TRUE);
      $bk['endpage'] = $this->load->view('layout/endpage', '', TRUE);

      $this->load->view('user/booking', $bk);
    }

    public function showDescriptionByBranch($id){
      $get = $this->input->get();
      
      if ($get) {
        if (isset($get['param'])) {
          // $url = base_url(uri_string());
          $this->load->model('BranchModel');
          $this->load->model('MainpageModel');
          // $myapib = 'infobranch?param=true';
          // $bdata = gUrl($myapib, 'showdesbookingbybranch');

          $cdata['chk'] = 'showDescriptionByBranch';
          $cdata['branch'] = $this->BranchModel->SeInfoBranch();
          $myapi3 = $this->config->item('apiSubAndSubtype').$id;

          $cdata['boption'] = $this->MainpageModel->filterRoomByBranch($id);
          // debug($cdata['boption']);
          // exit();
          
          $cdata['bcontent'] = $this->BookingusepageModel->ShowAllMyContentByid($id);

          $this->load->view('user/showdatahtml', $cdata);
        }
      }
    }

    // public function searchBookingPage($id){
    //   // $post = $this->input->post();
    //
    //   // $sd = substr($post['daterange'],0,10);
    //   // $ed = substr($post['daterange'],13,10);
    //   // $data = array(
    //   //   'branchNo' => $post['bbranch'],
    //   //   'startDate' => date("Y-m-d", strtotime($sd)),
    //   //   'endDate' => date("Y-m-d", strtotime($ed)),
    //   //   'people' => $post['bpeople']
    //   // );
    //
    //   return $this->BookingusepageModel->searchBookingPageBy($data);
    // }

    public function viewDetailByidb($id){
      // $url = base_url(uri_string());
      // $myapib = 'infobranch?param=true';
      // $bdata = gUrl($myapib, 'viewde/');
      // $myapi2 = $this->config->item('apiRoomType'); //adminAPI('get_rooms');
      // $cdata['tcontent'] = cUrlAdmin($myapi2);
      // $myapi3 = $this->config->item('apiSubAndSubtype').$id;
      // $cdata['boption'] = cUrlAdmin($myapi3);
      $this->load->model('BranchModel');

      $cdata['chk'] = 'Detail';
      $cdata['bcontent'] = $this->BookingusepageModel->ShowAllMyContentByid($id);

      $bk['branch'] = $this->BranchModel->SeInfoBranch();
      $bk['startpage'] = $this->load->view('layout/startpage', '', TRUE);
      $bk['topmenu'] = $this->load->view('layout/topmenu', '', TRUE);
      $bk['content'] = $this->load->view('user/showdatahtml', $cdata, TRUE);
      $bk['footer'] = $this->load->view('layout/footer', '', TRUE);
      $bk['endpage'] = $this->load->view('layout/endpage', '', TRUE);

      $this->load->view('user/booking', $bk);
    }

    public function bookingFormAPI(){
      $post = $this->input->post();
      $to_remove = array("CBKbrhid", "bdaterange");
      $arrfilter = array_diff_key($post, array_flip($to_remove));
      foreach ($arrfilter as $key => $value) {
        $sb['SubTypeID'][substr($key, 14, 1)] = array(
          'type' => substr($key, 4, 1),
          'subtype' => substr($key, 14, 1),
          'value' => $value
        );
      }
      $sd = substr($post['bdaterange'],0,10);
      $ed = substr($post['bdaterange'],13,10);

      $data = array(
        'BranchID' => $post['CBKbrhid'],
        'datestart' => date("Y-m-d 12:00:00", strtotime($sd)),
        'dateEnd' => date("Y-m-d 11:59:59", strtotime($ed)),
        // 'people' => $post['CBKpeople'],
        'cusid' => $_SESSION['id'],
        'custommeridcard' => $_SESSION['idcard'],
        'firstname' => $_SESSION['fname'],
        'lastname' => $_SESSION['lname'],
        'address' => $_SESSION['adr'],
        'cusemail' => $_SESSION['email'],
        'phone' => $_SESSION['phone'],
        'CreateDate' => date("Y-m-d"),
        'SubTypeID' => http_build_query($sb['SubTypeID']),
        // 'SubTypeID' => $sb['SubTypeID'],
        'lang' => 'en'
      );
      // debug($data);
      // exit();

      // $rapi = adminAPI('savebooking');
      $xdata = cUrlAdmin($this->config->item('apiBooking'), 'post', $data);
      print_r(json_decode($xdata, true));
      if ($xdata) {
        $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
      }else {
        $this->session->set_flashdata('error', 'Please check your email. Can not record your email.');
      }
    }

    public function showbyRoomType($subid){
      // echo $subid;
      $myapi = $this->config->item('apiRoomSubtypeid').$subid; //adminAPI('get_rooms');
      $cdata['bysubtype'] = cUrlAdmin($myapi);
      $cdata['chk'] = 'showbyRoomType';
      $this->load->view('user/showdatahtml', $cdata);
    }

}
