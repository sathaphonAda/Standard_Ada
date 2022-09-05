<?php defined ('BASEPATH') or exit ( 'No direct script access allowed' );


/// Holiday
$route['attHLDPageList']        = 'attendance/Holiday_controller/index';
$route['attHLDPageAdd']         = 'attendance/Holiday_controller/FCxCHLDPageAdd';
$route['attHLDPageEdit/(:num)']         = 'attendance/Holiday_controller/FCxCHLDEditData/$1';
$route['attHLDEventAdd']                = 'attendance/Holiday_controller/FCxCHLDEventAddData';
$route['attHLDEventEdit']               = 'attendance/Holiday_controller/FCxCHLDEventEditData';
$route['attHLDEventList']               = 'attendance/Holiday_controller/FCxCHLDDataList';
$route['attHLDEventDelete']             = 'attendance/Holiday_controller/FCxCHLDEventDeleteData';


/// attendance
$route['attATDPageList']    = 'attendance/Attendance_controller/index';
$route['attATDEventList']    = 'attendance/Attendance_controller/FSaCATDDataList';
$route['attATDEventSve']    = 'attendance/Attendance_controller/FSaCATDEventSave';
/// Schedule เพิ่มตารางทำงาน
$route['attSCDPageList']    = 'attendance/Schedule_controller/index';
$route['attSCDEventAdd']    = 'attendance/Schedule_controller/FSaCSCDEventAdd';
