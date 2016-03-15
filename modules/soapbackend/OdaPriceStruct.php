<?php
class OdaPriceStruct {
    var $productCode;
    var $price;
    var $reductionFrom;
    var $reductionTo;
    var $reductionPrice;
    var $taxCode;

    function OdaPriceStruct($productCode = null, $price  = null, $reductionFrom = null,
            $reductionTo = null, $reductionPrice = null, $taxCode = null)
    {
        $this->productCode = $productCode;
        $this->price = $price;
        $this->reductionFrom = $reductionFrom;
        $this->reductionTo = $reductionTo;
        $this->reductionPrice = $reductionPrice;
        $this->taxCode = $taxCode;
    }

    function &__to_soap($name = 'OdaPriceStruct', $header = false,
                        $mustUnderstand = 0,
                        $actor = 'http://schemas.xmlsoap.org/soap/actor/next')
    {
        $inner = array(
            new SOAP_Value('productCode', 'string', $this->productCode),
            new SOAP_Value('price', 'decimal', $this->price),
            new SOAP_Value('reductionFrom', 'date', $this->reductionFrom),
            new SOAP_Value('reductionTo', 'date', $this->reductionTo),
            new SOAP_Value('reductionPrice', 'decimal', $this->reductionPrice),
            new SOAP_Value('taxCode', 'string', $this->taxCode)
        );

        if ($header) {
            $value = new SOAP_Header($name,
                                     '{http://soapinterop.org/xsd}OdaPriceStruct',
                                     $inner,
                                     $mustUnderstand,
                                     $actor);
        } else {
            $value = new SOAP_Value($name,
                                    '{http://soapinterop.org/xsd}OdaPriceStruct',
                                    $inner);
        }

        return $value;
    }
}

