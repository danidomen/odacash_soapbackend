<?php
include 'PearWI/wiIncludeBase.php';
//include 'PearWI/wiIncludeMDB2.php';
include 'PearWI/wiIncludeSoapServer.php';
include('../../config/config.inc.php');
include('../../images.inc.php');
include('soapbackend.php');

function raiseFault($error, $description) {
    header('Content-type: text/xml');
    echo "
<SOAP-ENV:Envelope
     xmlns:SOAP-ENV=\"http://schemas.xmlsoap.org/soap/envelope/\"
     xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\"
     xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
     xmlns:SOAP-ENC=\"http://schemas.xmlsoap.org/soap/encoding/\"
     SOAP-ENV:encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\">
    <SOAP-ENV:Body>
        <SOAP-ENV:Fault>
            <faultcode xsi:type=\"xsd:QName\">SOAP-ENV:{$error}</faultcode>
            <faultstring xsi:type=\"xsd:string\">{$description}</faultstring>
            <faultactor xsi:type=\"xsd:anyURI\"></faultactor>
            <detail xsi:type=\"xsd:string\"></detail>
        </SOAP-ENV:Fault>
    </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
";
exit;
}

$module = new SoapBackend();

if (!$module->installed()) {
    raiseFault('MODULE_NOT_INSTALLED', 'Klever Software SoapBackend module is not installed.');
} else if (!$module->enabled()) {
    raiseFault('MODULE_DISABLED', 'Klever Software SoapBackend module is disabled.');
//Para hacer esto debería tener un htaccess y la url tendría el key
/*} else if (!isset($_REQUEST['key'])) {
    raiseFault('KEY_REQUIRED', 'Key is required.');
} else if ($_REQUEST['key'] != $module->wskey()) {
    raiseFault('KEY_INVALID', 'Key is not valid.');
*/} else {
    $server = new SOAP_Server;
    $server->_auto_translation = true;
    require_once dirname(__FILE__) . '/SoapBackendService.php';
    $soapclass = new SoapBackendService($module);
    $server->addObjectMap($soapclass, 'urn:SoapBackendService');
    if (isset($_REQUEST['test'])) {
        ini_set('display_errors','on');
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $server->service('
<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
    <s:Body s:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xmlns:xsd="http://www.w3.org/2001/XMLSchema">
        <!-- -->
        <q1:oda_update_stocks xmlns:q1="urn:SoapBackendService">
            <key>90HBNC7MWEQ0F1UKGHM0WITFM2DLP3CA</key>
            <OdaStockStructArray xsi:type="SOAP-ENC:Array" SOAP-ENC:arrayType="SOAP-ENC:Struct[1]">
                <item>
                    <productCode xsi:type="xsd:string">BOTASPRUEBA</productCode>
                    <colorCode xsi:type="xsd:string">GREEN</colorCode>
                    <sizeCode xsi:type="xsd:string">SMALL</sizeCode>
                    <stock xsi:type="xsd:string">10</stock>
                </item>
            </OdaStockStructArray>
        </q1:oda_update_stocks>
        <!-- -->
        <!-- 
        <q1:divide xmlns:q1="urn:SoapBackendService">
            <dividend xsi:type="xsd:int">30</dividend>
            <divisor xsi:type="xsd:int">0</divisor>
        </q1:divide>
        -->
    </s:Body>
</s:Envelope>
');
    } else if (isset($_SERVER['REQUEST_METHOD']) &&
        $_SERVER['REQUEST_METHOD'] == 'POST') {
        $server->service($HTTP_RAW_POST_DATA);
    } else {
        $disco = new SOAP_DISCO_Server($server, 'ServerOdacash');
        header('Content-type: text/xml');
        if (isset($_SERVER['QUERY_STRING']) &&
            strpos($_SERVER['QUERY_STRING'], 'wsdl') !== false) {
            echo $disco->getWSDL();
        } else {
            //echo $disco->getDISCO("&amp;key={$_REQUEST['key']}");
            echo $disco->getDISCO();
        }
    }
}

