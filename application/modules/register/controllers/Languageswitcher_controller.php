<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Languageswitcher_controller extends MX_Controller {

    public function __construct() {
        parent::__construct (); 
    }

    public function switchLang($language = "") {
        $language = ($language != "") ? $language : "EN";
        $this->session->set_userdata('lang', $language);
        redirect($_SERVER['HTTP_REFERER']);
    }
}



