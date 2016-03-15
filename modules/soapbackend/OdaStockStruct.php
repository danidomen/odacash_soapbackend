<?php
class OdaStockStruct {
    var $productCode;
    var $colorCode;
    var $sizeCode;
    var $stock;

    function OdaStockStruct(
        $productCode = null, $colorCode = null, $sizeCode = null, $stock = null)
    {
        $this->productCode = $productCode;
        $this->colorCode = $colorCode;
        $this->sizeCode = $sizeCode;
        $this->stock = $stock;
    }

    function &__to_soap($name = 'OdaStockStruct', $header = false,
                        $mustUnderstand = 0,
                        $actor = 'http://schemas.xmlsoap.org/soap/actor/next')
    {
        $inner = array(
            new SOAP_Value('productCode', 'string', $this->productCode),
            new SOAP_Value('colorCode', 'string', $this->colorCode),
            new SOAP_Value('sizeCode', 'string', $this->sizeCode),
            new SOAP_Value('stock', 'decimal', $this->stock)
        );

        if ($header) {
            $value = new SOAP_Header($name,
                                     '{http://soapinterop.org/xsd}OdaStockStruct',
                                     $inner,
                                     $mustUnderstand,
                                     $actor);
        } else {
            $value = new SOAP_Value($name,
                                    '{http://soapinterop.org/xsd}OdaStockStruct',
                                    $inner);
        }

        return $value;
    }
}

