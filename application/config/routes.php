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
$route['default_controller'] = 'c_login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['formlogin'] = 'c_login/login';
$route['validasi'] = 'c_login/validasi';
$route['home'] = 'c_home/index';
$route['signout'] = 'c_login/logout';
$route['profile'] = 'c_profile/index';


/*REGISTRASI TERMINAL*/
$route['registrasi'] = 'c_registrasi/index';
$route['view_terminal'] = 'c_registrasi/view';

/*EMAIL*/
$route['alert_email'] = 'c_alert_email/index';

/*USER*/
$route['add_user'] = 'c_user/add_user';
$route['delete_user'] = 'c_user/delete_user';
$route['user_management'] = 'c_user/user_management';
$route['insertuser'] = 'c_user/insert';
$route['updatepass'] = 'c_user/updatepass';

$route['testconvert'] = 'c_convert/index';
$route['testhasil'] = 'c_convert/tampil';

$route['print']  = 'C_laporan/print_laporan';
$route['print_word'] = 'C_laporan/print_word';
$route['print_preview'] = 'C_laporan/print_preview';
$route['preview_posisi'] = 'C_laporan/preview_posisi';
$route['upload'] ='C_laporan/do_upload';
$route['insert_kapal'] = 'C_laporan/insert_kapal';

$route['loginhp'] = 'C_site/loginhp';
$route['getSite'] = 'C_site/getSite';
$route['submit_laporan'] = 'C_site/submit_laporan';
$route['tes_upload'] = 'C_site/tes_upload';
$route['upload_gambar']= 'C_site/upload_gambar';
$route['getLaporan']= 'C_site/getLaporan';
$route['selectLap']= 'C_site/selectLap';
$route['getNama']= 'C_site/getNama';
$route['getPeta']= 'C_site/getPeta';
