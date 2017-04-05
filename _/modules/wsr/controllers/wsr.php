<?php

class wsr extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("Nusoap_lib");
        $this->nusoap_server = new soap_server();
        $this->nusoap_server->configureWSDL("wsr", "urn:wsr");

        $this->nusoap_server->wsdl->addComplexType(
                "MembersRecordset", "complexType", "array", "", "SOAP-ENC:Array", array(
            "setting_id" => array("name" => "setting_id", "type" => "xsd:int"),
            "group" => array("name" => "group", "type" => "xsd:string"),
            "key" => array("name" => "key", "type" => "xsd:string"),
            "value" => array("name" => "value", "type" => "xsd:string")
                )
        );

        $this->nusoap_server->register(
                "selectMembers", array(), array("return" => "tns:MembersRecordset"), "urn:wsr", "urn:wsr#selectMembers", "rpc", "encoded", "Retrieves members' list"
        );
    }

    function index() {
        if ($this->uri->rsegment(3) == "wsdl") {
            $_SERVER['QUERY_STRING'] = "wsdl";
        } else {
            $_SERVER['QUERY_STRING'] = "";
        }

        $this->nusoap_server->service(file_get_contents("php://input"));
    }

    // note the "WS_" prefix (meaning Webservice) in order to distinguish this select_members from the other functions named alike that may occur

    function WS_select_members() {

        function selectMembers() {

            $rows = $this->db->query('select * from setting')->result_array();
            return $rows;
        }

        $this->nusoap_server->service(file_get_contents("php://input"));
    }

}
