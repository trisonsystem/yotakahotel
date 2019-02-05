<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'HomeControllers/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//  ============== User =================
$route['setlanguage/(:any)'] = 'ssystem/SetLanguage/myLanguage/$1';
$route['setlanguageg'] = 'ssystem/SetLanguage/get';

$route['index'] = 'HomeControllers/index';

$route['contactus'] = 'ContactusControllers';
$route['scomments'] = 'ContactusControllers/saveCommentsByCus';

$route['aboutas'] = 'AboutasControllers';
$route['gallery'] = 'GalleryControllers';
$route['promotions'] = 'PromotionsControllers';

$route['booking'] = 'BookingControllers/ShowAllBookingPageByBranch/Content0';
$route['booking/(:any)'] = 'BookingControllers/ShowAllBookingPageByBranch/$1';
$route['bookings/(:any)'] = 'BookingControllers/ShowAllBookingPageByBranchs/$1';
$route['showdesbookingbybranch/(:any)'] = 'BookingControllers/showDescriptionByBranch/$1';
$route['searchpbooking'] = 'BookingControllers/searchBookingPage';
$route['viewde/(:any)'] = 'BookingControllers/viewDetailByidb/$1';
$route['mybooking'] = 'BookingControllers/bookingFormAPI';

$route['subindex'] = 'HomeControllers/subindex';
$route['sbtypesubtype/(:any)'] = 'HomeControllers/selectBranchBytypeSubtype/$1';

//  ===================================

// ============== Main page =================
$route['sldelete/(:any)'] = 'employee/MainpageController/slDelete/$1';
$route['slundo/(:any)'] = 'employee/MainpageController/slUndo/$1';
$route['slsave'] = 'employee/MainpageController/saveSlideShow';
// ==========================================

// ============== About as page =================
$route['saboutas'] = 'employee/AboutasController/saveAboutas';
$route['dgaboutas'] = 'employee/AboutasController/deleteGroupAboutas';
$route['showaboutasbyid/(:any)'] = 'employee/AboutasController/showbyidAboutas/$1';
$route['eaboutas'] = 'employee/AboutasController/editAboutas';
$route['delaboutas/(:any)'] = 'employee/AboutasController/delbyidAboutas/$1';
$route['daboutas'] = 'employee/AboutasController/deleteAboutas';
// ==============================================

//  ============== Booking page ==============
$route['showbooking'] = 'BookingControllers/ShowBookingByBranch';
$route['showbyroomtype/(:any)'] = 'BookingControllers/showbyRoomType/$1';
$route['showbookingbid/(:any)'] = 'AboutasControllers/showAboutasByID/$1';

$route['showpbookingbyid/(:any)'] = 'employee/BookingusepageController/showbyidPageBooking/$1';
$route['savebookingusepage'] = 'employee/BookingusepageController/saveBookingUsePage';
$route['editbookingusepage'] = 'employee/BookingusepageController/editBookingUsePage';
$route['delbookingusepagebyid/(:any)'] = 'employee/BookingusepageController/delbyidBookingUsePage/$1';
$route['delbookingusepage'] = 'employee/BookingusepageController/deleteBookingUsePage';
$route['dgbookingusepage'] = 'employee/BookingusepageController/deleteGroupBookingUsePage';
//  =====================================

//  ============== Employee ==============
$route['empmain'] = 'employee/EmpmainpageControllers';
//$route['empbranch'] = 'employee/BranchmanagementControllers';

$route['empmain/(:any)'] = 'employee/EmpmainpageControllers/empcontent/$1';
$route['editbranch/(:any)'] = 'employee/EmpmainpageControllers/showBranchByID/$1';
$route['delbranch/(:any)'] = 'employee/EmpmainpageControllers/deleteBranchByID/$1';
//  ===================================

//  ============== Gallery ==============
$route['simggroup'] = 'employee/GalleryController/saveImgGroup';
$route['showgroupbybimg/(:any)'] = 'employee/GalleryController/showGroupByImg/$1';
$route['sbpicgallery'] = 'employee/GalleryController/saveImgToGallery';
$route['dggallery'] = 'employee/GalleryController/deleteGroupGallery';
$route['dgallery/(:any)'] = 'employee/GalleryController/delbyidGallery/$1';
$route['delgallery'] = 'employee/GalleryController/deleteGallery';
$route['showgallerybyid/(:any)'] = 'employee/GalleryController/showbyidGallery/$1';
$route['editgallery'] = 'employee/GalleryController/editGallery';

$route['deleteimggallery/(:any)'] = 'employee/GalleryController/deleteImgGalleryp/$1';
$route['sdeletegroupgallery/(:any)'] = 'employee/GalleryController/showDeletegroupgallery/$1';
$route['dgpgallery'] = 'employee/GalleryController/deleteGroupPicGallery';
//  ======================================

//  ============== Promotion ==============
$route['sapromotion'] = 'employee/PromotionsController/savePromotions';
$route['dgpromotion'] = 'employee/PromotionsController/deleteGroupPromotions';
$route['delpromotionbyid/(:any)'] = 'employee/PromotionsController/delbyidPromotions/$1';
$route['dpromotion'] = 'employee/PromotionsController/deletePromotions';
$route['showpromotionbyid/(:any)'] = 'employee/PromotionsController/showbyidPromotions/$1';
$route['epromotion'] = 'employee/PromotionsController/editPromotions';

$route['showevents/(:any)'] = 'PromotionsControllers/showEvents/$1';
$route['getevent/(:any)'] = 'PromotionsControllers/getEvents/$1';

$route['get_detail_pomotion'] = 'PromotionsControllers/get_detail_pomotion';
//  ======================================

//  ============== Customer ==============
  $route['savecustomer'] = 'employee/EmpmainpageControllers/saveCustomer';
  $route['editcustomer/(:any)'] = 'employee/EmpmainpageControllers/showCustomerByID/$1';
  $route['delcustomer/(:any)'] = 'employee/EmpmainpageControllers/deleteCustomerByID/$1';
//  =====================================

//  ============== Personnel ============
$route['bydepartment/(:any)'] = 'employee/PersonnelController/filterDepartment/$1';
$route['spersonnel'] = 'employee/PersonnelController/savePersonnel';
$route['dgpersonnel'] = 'employee/PersonnelController/deleteGroupPersonnel';
$route['showpersonnelbyid/(:any)'] = 'employee/PersonnelController/showbyidPersonnel/$1';
$route['epersonnel'] = 'employee/PersonnelController/editPersonnel';
$route['delpersonnelbyid/(:any)'] = 'employee/PersonnelController/delbyidPersonnel/$1';
$route['dpersonnel'] = 'employee/PersonnelController/deletePersonnel';
//  =====================================

//  ============== Picture ==============
  $route['infopicture'] = 'employee/PictureController/InfoPictureBranch';
  $route['sbpicture'] = 'employee/PictureController/savePictureBranch';
  $route['showpicbyid/(:any)'] = 'employee/PictureController/showbyidPicture/$1';
  $route['delpicbyid/(:any)'] = 'employee/PictureController/delbyidPicture/$1';
  $route['editpicture'] = 'employee/PictureController/editPicture';
  $route['delpicture'] = 'employee/PictureController/deletePicture';
  $route['dgpicture'] = 'employee/PictureController/deleteGroupPicture';
//  =====================================

//  ============== System ==============
$route['login'] = 'ssystem/LoginController/loginMe';
$route['logout'] = 'ssystem/LoginController/logout';

$route['forgotpassword'] = 'ssystem/ForgotpasswordController/ForgotPassword';
$route['resetpassword'] = 'ssystem/ForgotpasswordController/ResetPassword';
//  ===================================

//  ============== Branch =============================
$route['infobranch'] = 'employee/BranchController/infoBranch';
$route['ebranch'] = 'employee/BranchController/editBranch';
$route['sbranch'] = 'employee/BranchController/saveBranch';
$route['dbranch'] = 'employee/BranchController/deleteBranch';
$route['dgbranch'] = 'employee/BranchController/deleteBranchByGroup';
$route['showbyid/(:any)'] = 'employee/BranchController/showbyidBranch/$1';
//  ===================================================

//  ============== Branch =============================
$route['cusregister'] = 'employee/CustomerController/RegisterCustomer';
$route['infocustomer'] = 'employee/CustomerController/infoCustomer';
$route['scustomer'] = 'employee/CustomerController/saveCustomer';
$route['ecustomer'] = 'employee/CustomerController/editCustomer';
$route['dcustomer'] = 'employee/CustomerController/deleteCustomer';
$route['dgcustomer'] = 'employee/CustomerController/deleteCustomerByGroup';
$route['showcusbyid/(:any)'] = 'employee/CustomerController/showbyidCustomer/$1';
$route['showcusbyidc/(:any)'] = 'employee/CustomerController/showbyIDC/$1';
//  ===================================================

//  ============== Branch =============================
$route['infocomment'] = 'employee/CommentController/infoComment';
$route['sentcomment/(:any)'] = 'employee/CommentController/sentCommentToCustomer/$1';
$route['savecomment'] = 'employee/CommentController/saveToCustomer';
//  ===================================================

//  ============== Room =============================
$route['roombybranch/(:any)'] = 'employee/EmpmainpageControllers/roomByData/$1';
$route['getaccessories/(:any)'] = 'employee/RoomsController/getAccessories/$1';
$route['sarooms'] = 'employee/RoomsController/saveRooms';
$route['showroombyid/(:any)'] = 'employee/RoomsController/showbyidRooms/$1';
$route['eroom'] = 'employee/RoomsController/editRoom';
$route['delroombyid/(:any)'] = 'employee/RoomsController/delbyidRoom/$1';
$route['droom'] = 'employee/RoomsController/deleteRoom';
//  =================================================

//  ============== Accessories ======================
$route['saccessories'] = 'employee/AccessoriesController/saveAccessories';
$route['dgaccessories'] = 'employee/AccessoriesController/deleteGroupAccessories';
$route['delaccessoriesbyid/(:any)'] = 'employee/AccessoriesController/delbyidAccessories/$1';
$route['daccessories'] = 'employee/AccessoriesController/deleteAccessories';
$route['showaccessoriesbyid/(:any)'] = 'employee/AccessoriesController/showbyidAccessories/$1';
$route['eaccessories'] = 'employee/AccessoriesController/editAccessories';
//  =================================================

//  ================== Booking ======================
$route['getroomsbycus/(:any)'] = 'employee/BookingController/getRoomByCustomer/$1';
$route['getroomsbyid/(:any)'] = 'employee/BookingController/getRoomByID/$1';
$route['searchidc/(:any)'] = 'employee/BookingController/searchidcbyCustomer/$1';
$route['showcusidc/(:any)'] = 'employee/BookingController/showbyidCustomer/$1';
$route['ecusbybooking'] = 'employee/BookingController/editCustomer';
$route['sbooking'] = 'employee/BookingController/saveBookingFrontOffice';
$route['scheckin'] = 'employee/BookingController/saveBookingFrontOfficeSta0';
$route['getroomtocheckout/(:any)'] = 'employee/BookingController/getRoomToCheckout/$1';
$route['showhardware/(:any)'] = 'employee/BookingController/showShowhardware/$1';
$route['sequipment'] = 'employee/BookingController/saveEquipment';
$route['showminibar/(:any)'] = 'employee/BookingController/showMinibar/$1';
$route['sminibar'] = 'employee/BookingController/saveMinibar';
$route['scheckout'] = 'employee/BookingController/saveBookingFrontOfficeSta1';
$route['scleaned/(:any)'] = 'employee/BookingController/saveBookingFrontOfficeSta2/$1';
$route['showbillcheckout/(:any)'] = 'employee/BookingController/showBillCheckOut/$1';
$route['getdetailroomb'] = 'employee/BookingController/getDetailRoomBill';
$route['chkpromotion'] = 'employee/BookingController/chkPromotion';
$route['svoucherbk'] = 'employee/BookingController/saveVoucherBooking';
$route['printbokpdf/(:any)'] = 'employee/BookingController/printBookingPDF/$1';
$route['sbookingbycus'] = 'employee/BookingController/saveBookingByCustomer';
$route['sbookingbycuspdf/(:any)'] = 'employee/BookingController/printBookingCUSPDF/$1';
$route['moveroom/(:any)'] = 'employee/BookingController/moveRoom/$1';

$route['pdf'] = 'employee/BookingController/testpdf';
$route['pdf2'] = 'employee/BookingController/testpdf2';
//  =================================================

$route['usecase/(:any)'] = 'yotakaapi/UsecaseController/SelectUsecase/$1';
$route['myapi'] = 'yotakaapi/MyuserguideController/index';

