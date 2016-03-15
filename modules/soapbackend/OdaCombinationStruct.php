<?php
class OdaCombinationStruct {
    var $productCode;
    var $colorCode;
    var $colorName;
    var $colorColor;
    var $sizeCode;
    var $sizeName;
    var $stock;
    var $priceDiff;
    var $photo;

    function OdaCombinationStruct(
        $productCode = null, $colorCode = null, $colorName = null, $colorColor = null,
        $sizeCode = null, $sizeName = null, $stock = null, $priceDiff = null, $photo = null)
    {
        $this->productCode = $productCode;
        $this->colorCode = $colorCode;
        $this->colorName = $colorName;
        $this->colorColor = $colorColor;
        $this->sizeCode = $sizeCode;
        $this->sizeName = $sizeName;
        $this->stock = $stock;
        $this->priceDiff = $priceDiff;
        $this->photo = $photo;
    }

    function &__to_soap($name = 'OdaCombinationStruct', $header = false,
                        $mustUnderstand = 0,
                        $actor = 'http://schemas.xmlsoap.org/soap/actor/next')
    {
        $inner = array(
            new SOAP_Value('productCode', 'string', $this->productCode),
            new SOAP_Value('colorCode', 'string', $this->colorCode),
            new SOAP_Value('colorName', 'string', $this->colorName),
            new SOAP_Value('colorColor', 'string', $this->colorColor),
            new SOAP_Value('sizeCode', 'string', $this->sizeCode),
            new SOAP_Value('sizeName', 'string', $this->sizeName),
            new SOAP_Value('stock', 'decimal', $this->stock),
            new SOAP_Value('priceDiff', 'decimal', $this->priceDiff),
            new SOAP_Value('photo', 'string', $this->photo)
        );

        if ($header) {
            $value = new SOAP_Header($name,
                                     '{http://soapinterop.org/xsd}OdaCombinationStruct',
                                     $inner,
                                     $mustUnderstand,
                                     $actor);
        } else {
            $value = new SOAP_Value($name,
                                    '{http://soapinterop.org/xsd}OdaCombinationStruct',
                                    $inner);
        }

        return $value;
    }
}

