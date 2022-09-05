<?php defined ('BASEPATH') or exit ( 'No direct script access allowed' );

// $route['masHLDPage']    = 'attendance/Holiday_controller/index';
$route['lang']           = 'register/Languageswitcher_controller/switchLang/$1';


$route['api/register']          = 'register/Register_controller/register';

$route['api/register']          = 'register/Register_controller/index';



$route['regUSRPageAdd']          = 'register/Register_controller/index';
$route['regUSREventAdd']         = 'register/Register_controller/FSaCREGEventAdd';

$route['regUSRPageList']         = 'register/Register_controller/FSxCREGPageList';
$route['regUSREventList']         = 'register/Register_controller/FSaCREGEventList';
$route['regUSREventEdit']         = 'register/Register_controller/FSaCREGEventEdit';
$route['regUSREventDelete']         = 'register/Register_controller/FSaCREGEventDelete';
$route['regUSRPageEdit/(:num)']         = 'register/Register_controller/FSxCREGEventAdd/$1';






