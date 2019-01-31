<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This function is used to print the content of any data
 */
function debug($data, $exit = false) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    if ($exit) {
        exit();
    }
}

/**
 * This function is used to print the content of any data
 */
function debugAPI($data, $exit = false) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    if ($exit) {
        exit();
    }
}

/**
 * This function used to get the CI instance
 */
if (!function_exists('get_instance')) {

    function get_instance() {
        $CI = &get_instance();
    }

}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if (!function_exists('getHashedPassword')) {

    function getHashedPassword($plainPassword) {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }

}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if (!function_exists('verifyHashedPassword')) {

    function verifyHashedPassword($plainPassword, $hashedPassword) {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }

}

/**
 * This method used to get current browser agent
 */
if (!function_exists('getBrowserAgent')) {

    function getBrowserAgent() {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser()) {
            $agent = $CI->agent->browser() . ' ' . $CI->agent->version();
        } else if ($CI->agent->is_robot()) {
            $agent = $CI->agent->robot();
        } else if ($CI->agent->is_mobile()) {
            $agent = $CI->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }

}

if (!function_exists('setProtocol')) {

    function setProtocol() {
        $CI = &get_instance();

        $CI->load->library('email');

        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $CI->email->initialize($config);

        return $CI;
    }

}

if (!function_exists('emailConfig')) {

    function emailConfig() {
        $CI->load->library('email');
        $config['protocol'] = PROTOCOL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailpath'] = MAIL_PATH;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
    }

}

if (!function_exists('resetPasswordEmail')) {

    function resetPasswordEmail($detail) {
        $data["data"] = $detail;
        // pre($detail);
        // die;

        $CI = setProtocol();

        $CI->email->from(EMAIL_FROM, FROM_NAME);
        $CI->email->subject("Reset Password");
        $CI->email->message($CI->load->view('email/resetPassword', $data, TRUE));
        $CI->email->to($detail["email"]);
        $status = $CI->email->send();

        return $status;
    }

}

if (!function_exists('setFlashData')) {

    function setFlashData($status, $flashMsg) {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }

}

if (!function_exists('replaceLink')) {

    function replaceLink($data) {
        $data = preg_replace('/{file:/i', '', $data);

        return $data;
    }

}


if (!function_exists('callArticle')) {

    function callArticle($url) {
        // $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
        $user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13";

        $header = array(
            'X-Forwarded-For: 103.212.181.190:80'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

        $result = curl_exec($ch);
        // $result = file_get_contents($url);
        // echo $result;exit();
        // $start_result = strpos($result,"<center>");
        $start_result = strpos($result, "{file:");
        // $start_result+=1010;
        // $end_result = strpos($result,"</center>",$start_result);
        $end_result = strpos($result, ",label: ", $start_result);

        // $start_result+=500;

        $substring = substr($result, $start_result, $end_result - $start_result);

        curl_close($ch);

        return replaceLink($substring);
    }

}

if (!function_exists('cUrl')) {

//    print_r('curl');
    function cUrl($url = "", $method = "get", $data = "", $ssl = false) {

        if ($method == "post") {
            if ($data == "")
                return false;
        }

        $ch = curl_init();
        if ($method == "get")
            curl_setopt($ch, CURLOPT_URL, $url . ($data != "" ? "?" . $data : ""));
        else if ($method == "post")
            curl_setopt($ch, CURLOPT_URL, $url);

        if ($method == "post") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $ssl);
        //curl_setopt($ch, CURLOPT_TIMEOUT_MS, 200); //Added in cURL 7.16.2. Available since PHP 5.2.3.
        curl_setopt($ch, CURLOPT_TIMEOUT, 200); //20 second (X * 10 second)
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

}

if (!function_exists('cUrlAdmin')) {

    function cUrlAdmin($url = "", $method = "get", $data = "", $ssl = false) {

        if ($method == "post") {
            if ($data == "")
                return false;
        }

        $ch = curl_init();
        if ($method == "get")
            curl_setopt($ch, CURLOPT_URL, $url . ($data != "" ? "?" . $data : ""));
        else if ($method == "post")
            curl_setopt($ch, CURLOPT_URL, $url);

        if ($method == "post") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $ssl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'yotaka-auth-token:' . funToken() . ''
        ));
        curl_setopt($ch, CURLOPT_TIMEOUT, 200); //20 second (X * 10 second)

        $content = curl_exec($ch);
//         print_r($content);
        curl_close($ch);
        return $content;
    }

}

if (!function_exists('gUrl')) {

    function gUrl($rout, $subUrl) {
        $url = base_url(uri_string());
        $str = substr($url, 0, strpos($url, $subUrl));
        $rapi = $str . $rout;

        return $rapi;
    }

}

if (!function_exists('pUrl')) {

    function pUrl($rout, $subUrl, $part) {
        $url = base_url(uri_string());
        $str = substr($url, 0, strpos($url, $subUrl));
        $rapi = $str . $part;

        return $rapi;
    }

}

if (!function_exists('adminAPI')) {

    function adminAPI($strapi) {
        switch ($strapi) {
            case 'get_rooms':
                $str = 'http://122.155.201.37/adminYotaka/api/rooms/get_rooms';
                break;

            case 'getRoomsBy':
//                    http://122.155.201.37/adminYotaka/api/rooms/get_room_by_data?barnchID=1&typeID=1&subtypeID=1
                $str = 'http://122.155.201.37/adminYotaka/api/rooms/get_room_by_data';
                break;

            case 'login':
                $str = 'http://122.155.201.37/adminYotaka/api/auth/checkpassword';
                break;

            case 'savebooking':
                // $str = 'http://122.155.201.37/adminYotaka/api/booking/save_booking';
                // $str = 'https://admin.yotakagroup.com/api/booking/save_cus_booking';
              break;

            case 'mEmail':
              $str = 'logic_of_life@hotmail.com';
              break;

            default:
                break;
        }

        return $str;
    }

}

if (!function_exists('funToken')) {

    function funToken() {
        return JWT::encode('{
        "auth": {
            "username": "admin",
            "password": 1234
        },
        "token":"YWRtaW46MTIzNA==",
        "Yotaka-API-KEY": "Pa$$w0rd",
        "time":"' . time() . '"
    }', 'Pa$$w0rd');
    }

}

if (!function_exists('sentEmailToCustomer')) {

  function sentEmailToCustomer($sendTo, $Titel, $form, $cc, $conten){
    $surl = 'https://admin.yotakagroup.com/api/email?sendTo=' . $sendTo . '&Titel='. $Titel . '&form=' . $form . '&cc=' . $cc . '&conten=' . $conten;

    return $surl;
  }

}

if(!function_exists('bahtText')){
    function bahtText(float $amount): string
    {
        [$integer, $fraction] = explode('.', number_format(abs($amount), 2, '.', ''));
    
        $baht = convert($integer);
        $satang = convert($fraction);
    
        $output = $amount < 0 ? 'ลบ' : '';
        $output .= $baht ? $baht.'บาท' : '';
        $output .= $satang ? $satang.'สตางค์' : 'ถ้วน';
    
        return $baht.$satang === '' ? 'ศูนย์บาทถ้วน' : $output;
    }
}

if(!function_exists('convert')){
    function convert(string $number): string
    {
        $values = ['', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า'];
        $places = ['', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน'];
        $exceptions = ['หนึ่งสิบ' => 'สิบ', 'สองสิบ' => 'ยี่สิบ', 'สิบหนึ่ง' => 'สิบเอ็ด'];

        $output = '';

        foreach (str_split(strrev($number)) as $place => $value) {
            if ($place % 6 === 0 && $place > 0) {
                $output = $places[6].$output;
            }

            if ($value !== '0') {
                $output = $values[$value].$places[$place % 6].$output;
            }
        }

        foreach ($exceptions as $search => $replace) {
            $output = str_replace($search, $replace, $output);
        }

        return $output;
    }
}
?>
