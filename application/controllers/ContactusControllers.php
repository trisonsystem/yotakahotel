<?php

class ContactusControllers extends CI_Controller{
    public function __construct() {
        parent::__construct();

        if(!isset($_COOKIE['lang'])) {
           $lang = 'english';
           setcookie('lang', $lang);
         } else {
             $lang = $_COOKIE['lang'];
         }
         $this->lang->load($lang, $lang);
         $this->load->model('ContactusModel');
    }

    public function index(){
        $cts['startpage'] = $this->load->view('layout/startpage', '', TRUE);
        $cts['topmenu'] = $this->load->view('layout/topmenu', '', TRUE);

        $cts['footer'] = $this->load->view('layout/footer', '', TRUE);
        $cts['endpage'] = $this->load->view('layout/endpage', '', TRUE);
        $this->load->view('user/contactus', $cts);
    }

    public function saveCommentsByCus(){
      $post = $this->input->post();

      if ($this->ContactusModel->saveCommentsByCus($post)) {
        $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
      }else {
        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
      }

      redirect('contactus');

    }

}
