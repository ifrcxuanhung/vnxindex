<?php

class test extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Nusoap_lib');
    }

    function index() {

    }

    // note the "CTRL_" prefix (meaning CONTROLLER) in order to distinguish this select_members from the other functions named alike that may occur

    function CTRL_select_members() {
        $this->soapclient = new nusoap_client('http://localhost/ims/wsr/WS_select_members?wsdl');
        $members_list = $this->soapclient->call(
                'selectMembers', array(), 'urn:wsr', 'urn:wsr#selectMembers'
        );
        print_r($members_list);
    }

}

?>