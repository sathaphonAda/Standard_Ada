<?php defined ('BASEPATH') or exit ( 'No direct script access allowed' );


$route['api/register']         = 'api/User_controller/register';
$route['api/register_list']         = 'api/User_controller/register_list';
$route['api/register_update/(:num)']  = 'api/User_controller/register_update/$1';
$route['api/register_delete/(:num)']  = 'api/User_controller/register_delete/$1';
