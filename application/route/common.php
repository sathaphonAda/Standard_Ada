<?php defined ('BASEPATH') or exit ( 'No direct script access allowed' );

$route['default_controller']  = 'common/FirstPage/cFistPage/index';

if(file_exists(APPPATH.'route/attendance.php')){
    include(APPPATH.'route/attendance.php');
}
if(file_exists(APPPATH.'route/'.ENVIRONMENT.'/attendance.php')){
    include(APPPATH.'route/'.ENVIRONMENT.'/attendance.php');
}

if(file_exists(APPPATH.'route/register.php')){
    include(APPPATH.'route/register.php');
}
if(file_exists(APPPATH.'route/'.ENVIRONMENT.'/register.php')){
    include(APPPATH.'route/'.ENVIRONMENT.'/register.php');
}

if(file_exists(APPPATH.'route/api.php')){
    include(APPPATH.'route/api.php');
}
if(file_exists(APPPATH.'route/'.ENVIRONMENT.'/api.php')){
    include(APPPATH.'route/'.ENVIRONMENT.'/api.php');
}
