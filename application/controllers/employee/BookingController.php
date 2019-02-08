<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class BookingController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('BookingModel');
        $this->load->model('SystemModel');
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

        // $this->load->library('Myfpdf');
        // $this->pdf->fontpath = 'fonts/';
    }

    public function getRoomByCustomer($id)
    {
        $cdata['croom'] = $this->BookingModel->getBookingByCustomerID($id);
        if (count($cdata['croom']) > 0) {
            $cdata['mysession'] = $_SESSION;
            $cdata['chk'] = 'getRoomByCustomer';
            $cdata['bookingstatus'] = $this->SystemModel->Usecase('19');
            $this->load->view('employee/showdatahtml', $cdata);
        } else {
            echo ("<h1>No data accessories fom room</h1>");
        }
    }

    public function getRoomByID($id)
    {
        $cdata['room'] = $this->BookingModel->GetRoomByID($id);
        if (count($cdata['room']) > 0) {
            $cdata['mysession'] = $_SESSION;
            $cdata['bookingfrom'] = $this->SystemModel->Usecase('16');
            $cdata['chk'] = 'getRoomByID';
            $this->load->view('employee/showdatahtml', $cdata);
        } else {
            echo ("<h1>No data accessories fom room</h1>");
        }
    }

    public function searchidcbyCustomer($idc)
    {
        $count = $this->BookingModel->SearchidcbyCustomer($idc);

        print_r($count['COUNTidc']);
        return $count['COUNTidc'];
    }

    public function showbyidCustomer($idc)
    {
        $get = $this->input->get();

        if ($get) {
            if (isset($get['param'])) {
                $showby = $this->BookingModel->ShowbyidCustomer($idc);
                if ($showby) {
                    $this->load->model('SystemModel');

                    $cdata['titlename'] = $this->SystemModel->Usecase('13');
                    $cdata['mysession'] = $_SESSION;
                    $cdata['chk'] = 'showbyidCustomer';
                    $cdata['bycusid'] = $showby;

                    $this->load->view('employee/showdatahtml', $cdata);
                }
            }
        }
    }

    public function editCustomer()
    {
        $post = $this->input->post();

        if ($post) {
            if ($this->BookingModel->EditCustomer($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            } else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        } else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    public function saveBookingFrontOffice()
    {
        $post = $this->input->post();

        if ($post) {
            if ($this->BookingModel->SaveBookingFrontOffice($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            } else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        } else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    public function saveBookingFrontOfficeSta0()
    {
        $post = $this->input->post();

        if ($post) {
            if ($this->BookingModel->SaveBookingFrontOfficeSta0($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            } else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        } else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    public function getRoomToCheckout($id)
    {
        $cdata['cout'] = $this->BookingModel->getRoomToCheckout($id);

        if (count($cdata['cout']) > 0) {
            $cdata['mysession'] = $_SESSION;
            $cdata['chk'] = 'getRoomToCheckout';
            $cdata['bookingstatus'] = $this->SystemModel->Usecase('19');
            $this->load->view('employee/showdatahtml', $cdata);
        } else {
            echo ("<h1>No data accessories fom room</h1>");
        }
    }

    public function showShowhardware($id)
    {
        $bok = $this->BookingModel->getBookingByBookingID($id);
        $cdata['mysession'] = $_SESSION;

        if ($bok[0]['BOKhard'] == 0) {
            $cdata['bok'] = $bok;
            $cdata['c'] = 0;
        } else {
            $cdata['bok'] = $this->BookingModel->getBookingByBookingID2($id);
            $cdata['c'] = 1;
        }

        $cdata['chk'] = 'showShowhardware';
        $this->load->view('employee/showdatahtml', $cdata);
    }

    public function saveEquipment()
    {
        $post = $this->input->post();

        $to_remove = array("RADbokid");
        $arrfilter = array_diff_key($post, array_flip($to_remove));
        $chk = $this->BookingModel->checkEquipment($post['RADbokid']);

        foreach ($arrfilter as $key => $value) {
            $getras = $this->BookingModel->accessories(substr($key, 5));
            if (substr($key, 0, 5) == 'RADid') {
                $data = array(
                    'RADbokid' => $post['RADbokid'],
                    'RADromrisid' => substr($key, 5),
                    'RADromrisqty' => $value,
                    'RADromrisprice' => $getras[0]['RASprice'],
                    'RADromristot' => $getras[0]['RASprice'] * $value,
                    'RADdelete' => 0,
                    'RADdeleteBy' => '',
                    'RADdeleteDT' => date('Y-m-d H:i:s')
                );

                if ($data['RADromrisqty'] > 0) {
                    if ($this->BookingModel->SaveEquipment($data)) {
                        $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
                    } else {
                        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
                    }
                }
            }
        }
    }

    public function showMinibar($id)
    {
        $bok = $this->BookingModel->getBookingByBookingID($id);
        $cdata['mysession'] = $_SESSION;
        $cdata['bok'] = $bok;

        if ($bok[0]['BOKmini'] == 0) {
            $cdata['item'] = $this->BookingModel->getItemMiniBar($bok[0]['BOKromid']);
            $cdata['c'] = 0;
        } else {
            $cdata['item'] = $this->BookingModel->getItemMiniBar2($bok[0]['BOKromid'], $bok[0]['BOKid']);
            // $cdata['qty'] = $this->BookingModel->getSellQuotation($bok[0]['BOKid'], $value['item'][0]['STKid']);

            $cdata['c'] = 1;
        }

        $cdata['chk'] = 'showMinibar';
        $this->load->view('employee/showdatahtml', $cdata);
    }

    public function saveMinibar()
    {
        $post = $this->input->post();

        $to_remove = array("RADbokid", "BOKromid", 'PERid');
        $arrfilter = array_diff_key($post, array_flip($to_remove));
        $chk = $this->BookingModel->checkMinibar($post['RADbokid']);

        foreach ($arrfilter as $key => $value) {

            $getmnb = $this->BookingModel->getItemByMNBid($post['BOKromid'], substr($key, 5));

            if (substr($key, 0, 5) == 'STKid') {
                $data = array(
                    'MNSbokid' => $post['RADbokid'],
                    'MNSstkid' => substr($key, 5),
                    'MNSromrisqty' => $value,
                    'MNSromrisprice' => $getmnb[0]['MNBprice'],
                    'MNSromristot' => $getmnb[0]['MNBprice'] * $value,
                    'MNSdelete' => 0,
                    'MNSdeleteBy' => $post['PERid'],
                    'MNSdeleteDT' => date('Y-m-d H:i:s')
                );

                $data2 = array(
                    'MNBromid' => $post['BOKromid'],
                    'MNBstkid' => $data['MNSstkid'],
                    'MNBqty' => $data['MNSromrisqty'],
                    'MNBprice' => $data['MNSromrisprice'],
                    'MNBtotal' => $data['MNSromristot'],
                    'MNBisinout' => 1,
                    'MNBnote' => '',
                    'MNBdelete' => 0,
                    'MNBdeleteBy' => $post['PERid'],
                    'MNBdeleteDT' => date('Y-m-d H:i:s')
                );

                if ($data['MNSromrisqty'] > 0) {
                    if ($this->BookingModel->SaveMiniBar($data)) {
                        $this->BookingModel->SaveMiniBarWayOut($data2);
                        $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
                    } else {
                        $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
                    }
                }

            }
        }

    }

    public function saveBookingFrontOfficeSta1()
    {
        $post = $this->input->post();

        if ($post) {
            if ($c = $this->BookingModel->SaveBookingFrontOfficeSta01($post)) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
                echo $c;
            } else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        } else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    public function saveBookingFrontOfficeSta2($id)
    {
        if ($id) {
            if ($this->BookingModel->SaveBookingFrontOfficeSta02($id, $_SESSION['id'])) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
            } else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }

        }
    }

    public function showBillCheckOut($cid)
    {
        $cdata['mysession'] = $_SESSION;
        $cdata['booking'] = $this->BookingModel->getBookingShowOnBill($cid);
        $cdata['customer'] = $this->BookingModel->Customer($cid);
        // $cdata['chkintot'] = round(abs(strtotime($cdata['booking'][0]['BOKstartDT']) - strtotime($cdata['booking'][0]['BOKendDT']))/60/60/24);
        // $cdata['list'] = $this->BookingModel->getListBill($cdata['booking'][0]['BOKid']);
        $cdata['chk'] = 'showBillCheckOut';

        $this->load->view('employee/showdatahtml', $cdata);
    }

    public function getDetailRoomBill()
    {
        $get = $this->input->get();
        // debug($get);
        // exit();
        if ($get) {
            $showby = $this->BookingModel->getListBill($get['bokid']); 
            // debug($showby);
            // exit();
            if ($showby) {
                $cdata['mysession'] = $_SESSION;
                $cdata['chk'] = 'getDetailRoomBill';
                $cdata['bycusid'] = $showby;
                $cdata['POMdis'] = $get['POMdis'];
                $cdata['VAT'] = $get['VAT'];

                $this->load->view('employee/showdatahtml', $cdata);
            }
        }
    }

    public function chkPromotion()
    {
        $get = $this->input->get();

        if ($get) {
            $chk = $this->BookingModel->searchFromPromotionCode($get);

            $data = array(
                'POMid' => $chk[0]['POMid'],
                'POMdis' => $chk[0]['POMdis']
            );
            echo json_encode($data);
        }
    }

    public function printBookingPDF($id)
    {
        $get = $this->input->get();
        $cdata['vs'] = $this->BookingModel->loadVoucherReceipt($id);
        // debug($cdata['vs']);
        // exit();
        $arr = implode(" ", $get) . ',';
        $cdata['chk'] = 'printBookingPDF';
        $cdata['settingp'] = explode(',', $arr, -1);
        
        // debug($arr);
        // debug($cdata['settingp']);

        $this->load->library('Pdf');

        // สร้าง object สำหรับใช้สร้าง pdf 
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
         
        // กำหนดรายละเอียดของ pdf
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle($cdata['vs'][0]['VOCcode']);
        $pdf->SetPrintHeader(false);
        // $pdf->SetSubject('TCPDF Tutorial');
        // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
         
        // กำหนดข้อมูลที่จะแสดงในส่วนของ header และ footer
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
         
        // กำหนดรูปแบบของฟอนท์และขนาดฟอนท์ที่ใช้ใน header และ footer
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
         
        // กำหนดค่าเริ่มต้นของฟอนท์แบบ monospaced 
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
         
        // กำหนด margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
         
        // กำหนดการแบ่งหน้าอัตโนมัติ
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
         
        // กำหนดรูปแบบการปรับขนาดของรูปภาพ 
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
         
        // ---------------------------------------------------------
         
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
         
        // กำหนดฟอนท์ 
        // ฟอนท์ freeserif รองรับภาษาไทย
        $pdf->SetFont('freeserif', '', 10, '', true);
         
    
        // เพิ่มหน้า pdf
        // การกำหนดในส่วนนี้ สามารถปรับรูปแบบต่างๆ ได้ ดูวิธีใช้งานที่คู่มือของ tcpdf เพิ่มเติม
        $pdf->AddPage();
         
        // กำหนดเงาของข้อความ 
        // $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
 
        // กำหนดเนื้อหาข้อมูลที่จะสร้าง pdf ในที่นี้เราจะกำหนดเป็นแบบ html โปรดระวัง EOD; โค้ดสุดท้ายต้องชิดซ้ายไม่เว้นวรรค
        $html = $this->load->view('employee/showdatapdf', $cdata, true);

        // สร้างข้อเนื้อหา pdf ด้วยคำสั่ง writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        // จบการทำงานและแสดงไฟล์ pdf
        // การกำหนดในส่วนนี้ สามารถปรับรูปแบบต่างๆ ได้ เช่นให้บันทึกเป้นไฟล์ หรือให้แสดง pdf เลย ดูวิธีใช้งานที่คู่มือของ tcpdf เพิ่มเติม
        $pdf->Output($cdata['vs'][0]['VOCcode'] . '.pdf', 'I');
    }

    public function saveVoucherBooking()
    {
        $post = $this->input->post();
        // debug($post);
        // exit();
        if ($post) {
            $re = $this->BookingModel->SaveVoucherBooking($post);
            if ($re) {
                $this->session->set_flashdata('success', 'All the data is correct. Data is complete.');
                echo $re;
            } else {
                $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
            }
        } else {
            $this->session->set_flashdata('error', 'Please check your data. Can not record your data.');
        }
    }

    public function saveBookingByCustomer()
    {
        $get = $this->input->get();

        $sd = substr($get['CBKbdaterange'], 0, 10);
        $ed = substr($get['CBKbdaterange'], 13, 10);

        $room = $this->BookingModel->selectRoom($get['CBKbrhid'], $get['CBKromtype']);
        // debug($_SESSION);
        // exit();

        $data = array(
            'BOKfrom' => 0,
            'BOKpomid' => $get['CBKpomid'],
            'BOKromid' => $room[0]['ROMid'],
            'BOKcusid' => $_SESSION['id'],
            'BOKnote' => $get['CBKnote'],
            'BOKstartDT' => date("Y-m-d 12:00:00", strtotime($sd)),
            'BOKendDT' => date("Y-m-d 11:59:59", strtotime($ed)),
            'BOKsta' => 0,
            'BOKbrhid' => $get['CBKbrhid'],
            'BOKcreatedDT' => date('Y-m-d H:i:s'),
            'BOKcreatedBy' => '',
            'BOKeditedDT' => date('Y-m-d H:i:s'),
            'BOKeditBy' => '',
            'BOKdelete' => 0,
            'BOKdeleteBy' => '',
            'BOKdeleteDT' => date('Y-m-d H:i:s'),
        );
        // debug($data);
        $bokid = $this->BookingModel->SaveBookingByCustomer($data);
        echo $bokid;
    }

    public function printBookingCUSPDF($id)
    {
        // debug($id);
        $cdata['chk'] = 'printBookingCUSPDF';
        $cdata['vs'] = $this->BookingModel->getBookingByBookingID3($id);
        // debug($cdata['vs'][0]['Room'][0]['ROMno']);
        // exit();
        $this->load->library('Pdf');

        // สร้าง object สำหรับใช้สร้าง pdf 
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
         
        // กำหนดรายละเอียดของ pdf
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle($cdata['vs'][0]['Room'][0]['ROMno']);
        $pdf->SetPrintHeader(false);
        // $pdf->SetSubject('TCPDF Tutorial');
        // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
         
        // กำหนดข้อมูลที่จะแสดงในส่วนของ header และ footer
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
         
        // กำหนดรูปแบบของฟอนท์และขนาดฟอนท์ที่ใช้ใน header และ footer
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
         
        // กำหนดค่าเริ่มต้นของฟอนท์แบบ monospaced 
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
         
        // กำหนด margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
         
        // กำหนดการแบ่งหน้าอัตโนมัติ
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
         
        // กำหนดรูปแบบการปรับขนาดของรูปภาพ 
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
         
        // ---------------------------------------------------------
         
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
         
        // กำหนดฟอนท์ 
        // ฟอนท์ freeserif รองรับภาษาไทย
        $pdf->SetFont('freeserif', '', 10, '', true);
         
    
        // เพิ่มหน้า pdf
        // การกำหนดในส่วนนี้ สามารถปรับรูปแบบต่างๆ ได้ ดูวิธีใช้งานที่คู่มือของ tcpdf เพิ่มเติม
        $pdf->AddPage();
         
        // กำหนดเงาของข้อความ 
        // $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
 
        // กำหนดเนื้อหาข้อมูลที่จะสร้าง pdf ในที่นี้เราจะกำหนดเป็นแบบ html โปรดระวัง EOD; โค้ดสุดท้ายต้องชิดซ้ายไม่เว้นวรรค
        $html = $this->load->view('user/showdatapdf', $cdata, true);

        // สร้างข้อเนื้อหา pdf ด้วยคำสั่ง writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        // จบการทำงานและแสดงไฟล์ pdf
        // การกำหนดในส่วนนี้ สามารถปรับรูปแบบต่างๆ ได้ เช่นให้บันทึกเป้นไฟล์ หรือให้แสดง pdf เลย ดูวิธีใช้งานที่คู่มือของ tcpdf เพิ่มเติม
        $pdf->Output($cdata['vs'][0]['Room'][0]['ROMno'] . '.pdf', 'I');
    }

    public function moveRoom($id)
    {
        $get = $this->input->get();
    }

}