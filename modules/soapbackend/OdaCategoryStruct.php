<?php
class OdaCategoryStruct {
    var $parentCode;
    var $categoryCode;
    var $categoryName;

    function OdaCategoryStruct($parentCode = null, $categoryCode = null, $categoryName = null)
    {
        $this->parentCode = $parentCode;
        $this->categoryCode = $categoryCode;
        $this->categoryName = $categoryName;
    }

    function &__to_soap($name = 'OdaCategoryStruct', $header = false,
                        $mustUnderstand = 0,
                        $actor = 'http://schemas.xmlsoap.org/soap/actor/next')
    {
        $inner = array(
            new SOAP_Value('parentCode', 'string', $this->parentCode),
            new SOAP_Value('categoryCode', 'string', $this->categoryCode),
            new SOAP_Value('categoryName', 'string', $this->categoryName)
        );

        if ($header) {
            $value = new SOAP_Header($name,
                                     '{http://soapinterop.org/xsd}OdaCategoryStruct',
                                     $inner,
                                     $mustUnderstand,
                                     $actor);
        } else {
            $value = new SOAP_Value($name,
                                    '{http://soapinterop.org/xsd}OdaCategoryStruct',
                                    $inner);
        }

        return $value;
    }
}

