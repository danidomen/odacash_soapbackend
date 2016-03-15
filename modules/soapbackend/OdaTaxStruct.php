<?php
class OdaTaxStruct {
    var $taxCode;
    var $taxName;
    var $taxRate;

    function OdaTaxStruct($taxCode = null, $taxName = null, $taxRate = null)
    {
        $this->taxCode = $taxCode;
        $this->taxName = $taxName;
        $this->taxRate = $taxRate;
    }

    function &__to_soap($name = 'OdaTaxStruct', $header = false,
                        $mustUnderstand = 0,
                        $actor = 'http://schemas.xmlsoap.org/soap/actor/next')
    {
        $inner = array(
            new SOAP_Value('taxCode', 'string', $this->taxCode),
            new SOAP_Value('taxName', 'string', $this->taxName),
            new SOAP_Value('taxRate', 'decimal', $this->taxRate)
        );

        if ($header) {
            $value = new SOAP_Header($name,
                                     '{http://soapinterop.org/xsd}OdaTaxStruct',
                                     $inner,
                                     $mustUnderstand,
                                     $actor);
        } else {
            $value = new SOAP_Value($name,
                                    '{http://soapinterop.org/xsd}OdaTaxStruct',
                                    $inner);
        }

        return $value;
    }
}

