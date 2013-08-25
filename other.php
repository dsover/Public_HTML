<?php
// Need to declare these settings here because our php.ini has alternate
// settings due to global purposes for other PHP scripts
ini_set("soap.wsdl_cache_enabled", "0");
ini_set("soap.wsdl_cache", "0");
ini_set("display_errors","On");
ini_set("track_errors","On");

// FedEx web services URL, note the HTTPS
$path_to_wsdl = 'http://192.168.56.101/ce-soap60/services/DiscussionApp?wsdl';

$soap_args = array(
    'exceptions'=>true,
    'cache_wsdl'=>WSDL_CACHE_NONE,
    'trace'=>1)
;

try {
    $client = new SoapClient($path_to_wsdl,$soap_args);
} catch (SoapFault $e) {
    var_dump(libxml_get_last_error());
    echo "<BR><BR>";
    var_dump($e);
}
var_dump($client->__getFunctions());
